<?php

namespace App\Repositories\DB;

use App\Repositories\Interfaces\iGenericInterface;
use App\Models\Task;
use Core\QueryBuilder;
use Core\SessionHandler;

class TaskRepository extends AbstractDBRepository implements iGenericInterface
{

    public function getAll($exclude_admin = false)
    {
        return self::getDB()->readAll(Task::getTableName(),Task::class);
    }

    public function find($id)
    {
        return self::getDB()->readById(Task::getTableName(),$id,Task::class);
    }

    public function findBy($field_name, $field_value)
    {
      $sqlParams[$field_name]=$field_value;
      $tasks = self::getDB()->read(Task::getTableName(),$sqlParams,Task::class);
      if (count($tasks) == 1)
      {
          return $tasks[0];
      }
    }

    public function findAllBy($field_name, $field_value)
    {
      $sqlParams[$field_name]=$field_value;
      return self::getDB()->read(Task::getTableName(),$sqlParams,Task::class);
    }

    public function create($task)
    {
        self::getDB()->create(Task::getTableName(),$task->toArray());
    }

    public function update($task)
    {
        self::getDB()->update(Task::getTableName(),$task->getId(),$task->toArray());
    }

    public function delete($id)
    {
        self::getDB()->delete(Task::getTableName(),$id);
    }

    public function findTasksBelongsToLoggedInUser()
    {
        $sqlParams['teamleaderid']=SessionHandler::getLoggedInUserId();
        $sql = "SELECT * FROM TASKS WHERE USER_ID IS NULL UNION SELECT * FROM TASKS WHERE USER_ID IN (SELECT ID FROM USERS WHERE TEAM_LEADER_ID =:teamleaderid)";
        return self::getDB()->execute($sql,$sqlParams,Task::class);
    }

}
