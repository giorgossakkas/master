<?php

namespace Core;

class QueryBuilder {

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function read($table, $params,$intoClass)
    {
        $columns = array_keys($params);
        $sql = "SELECT * FROM $table WHERE";

        $numOfPararms = 0;
        foreach ($params as $key => $value)
        {
            if ($numOfPararms == 0)
            {
                $sql = $sql . ' ' . $key . '=:' . $key;
            }
            else
            {
                $sql = $sql . ' and ' . $key . '=:' . $key;
            }
            $numOfPararms++;
        }

        $statement = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $statement->bindValue(':'.$key, $value);
        }
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS,$intoClass);

    }

    public function readById($table, $id, $intoClass){
        $statement = $this->pdo->prepare('SELECT * FROM '.$table.' WHERE `id` = :id');
        $statement->setFetchMode( \PDO::FETCH_CLASS, $intoClass);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_CLASS);
    }

    public function readAll($table, $intoClass){
        $statement = $this->pdo->prepare("SELECT * FROM {$table}");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, $intoClass);
    }

    public function create($table, $data) {
        $columns = array_keys($data);
        $columnSql = implode(',', $columns);
        $bindingSql = ':'.implode(',:', $columns);
        $sql = "INSERT INTO $table ($columnSql) VALUES ($bindingSql)";
        $statement = $this->pdo->prepare($sql);
        foreach ($data as $key => $value) {
            $statement->bindValue(':'.$key, $value);
        }
        $statement->execute();
    }

    public function update($table, $id, $data) {
        if (isset($data['id']))
            unset($data['id']);
        $columns = array_keys($data);
        $columns = array_map(function($item){
            return $item.'=:'.$item;
        }, $columns);
        $bindingSql = implode(',', $columns);
        $sql = "UPDATE $table SET $bindingSql WHERE `id` = :id";
        $statement = $this->pdo->prepare($sql);
        $data['id'] = $id;
        foreach ($data as $key => $value){
            $statement->bindValue(':'.$key, $value);
        }
        $statement->execute();
    }

    public function delete($table, $id)
    {
        $statement = $this->pdo->prepare('DELETE FROM '.$table.' WHERE id = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
    }
}
