<?php

namespace App\Models;

use Core\Connection;
use Core\QueryBuilder;

abstract class Model {

		abstract public function getTableName();
		abstract public function validate();
		abstract public function toArray();

		public static function getDB()
    {
        static $query = null;

        if ($query === null)
				{

						$pdo = Connection::make();

						$query = new QueryBuilder($pdo);
        }

        return $query;
    }

		public function create(){
				self::getDB()->create($this::getTableName(),$this->toArray());
		}

		public function update(){
				self::getDB()->update($this::getTableName(),$this->getId(),$this->toArray());
		}

}
