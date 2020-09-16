<?php

namespace App\Repositories\DB;

use App\Repositories\Interfaces\iGenericInterface;
use App\Models\Permission;
use Core\QueryBuilder;

class PermissionRepository extends AbstractDBRepository implements iGenericInterface
{

    public function getAll($exclude_admin = false)
    {
        return self::getDB()->readAll(Permission::getTableName(),Permission::class);
    }

    public function find($id)
    {
        return self::getDB()->readById(Permission::getTableName(),$id,Permission::class);
    }

    public function findBy($field_name, $field_value)
    {
      $sqlParams[$field_name]=$field_value;
      $permissions = self::getDB()->read(Permission::getTableName(),$sqlParams,Permission::class);
      if (count($permissions) == 1)
      {
          return $permissions[0];
      }
    }

    public function findAllBy($field_name, $field_value)
    {
      $sqlParams[$field_name]=$field_value;
      return self::getDB()->read(Permission::getTableName(),$sqlParams,Permission::class);
    }

    public function create($permission)
    {
        self::getDB()->create(Permission::getTableName(),$permission->toArray());
    }

    public function update($permission)
    {
        self::getDB()->update(Permission::getTableName(),$permission->getId(),$permission->toArray());
    }

    public function delete($id)
    {
        self::getDB()->delete(Permission::getTableName(),$id);
    }

}
