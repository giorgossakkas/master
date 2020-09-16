<?php

namespace App\Repositories\DB;

use App\Repositories\Interfaces\iGenericInterface;
use App\Models\User;
use Core\QueryBuilder;

class UserRepository extends AbstractDBRepository implements iGenericInterface
{

    public function getAll($exclude_admin = false)
    {
        return self::getDB()->readAll(User::getTableName(),User::class);
    }

    public function find($id)
    {
        return self::getDB()->readById(User::getTableName(),$id,User::class);
    }

    public function findBy($field_name, $field_value)
    {
      $sqlParams[$field_name]=$field_value;
      $users = self::getDB()->read(User::getTableName(),$sqlParams,User::class);
      if (count($users) == 1)
      {
          return $users[0];
      }
    }

    public function findAllBy($field_name, $field_value)
    {
      $sqlParams[$field_name]=$field_value;
      return self::getDB()->read(User::getTableName(),$sqlParams,User::class);
    }

    public function create($user)
    {
        self::getDB()->create(User::getTableName(),$user->toArray());
    }

    public function update($user)
    {
        self::getDB()->update(User::getTableName(),$user->getId(),$user->toArray());
    }

    public function delete($id)
    {
        self::getDB()->delete(User::getTableName(),$id);
    }

}
