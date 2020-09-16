<?php

namespace App\Repositories\DB;

use App\Repositories\Interfaces\iGenericInterface;
use App\Models\Role;
use Core\QueryBuilder;

class RoleRepository extends AbstractDBRepository implements iGenericInterface
{

    public function getAll()
    {
        return self::getDB()->readAll(Role::getTableName(),Role::class);
    }

    public function find($id)
    {
        return self::getDB()->readById(Role::getTableName(),$id,Role::class);
    }

    public function findBy($field_name, $field_value)
    {
      $sqlParams[$field_name]=$field_value;
      $roles = self::getDB()->read(Role::getTableName(),$sqlParams,Role::class);
      if (count($roles) == 1)
      {
          return $roles[0];
      }
    }

    public function findAllBy($field_name, $field_value)
    {
      $sqlParams[$field_name]=$field_value;
      return self::getDB()->read(Role::getTableName(),$sqlParams,Role::class);
    }

    public function create($role)
    {
        self::getDB()->create(Role::getTableName(),$role->toArray());

        if (count($role->getPermissions())>0)
        {
            //reload role to get the id
            $storeRole= $this->findBy('name',$role->getName());

            $permissionRepository = new PermissionRepository();
            foreach ($role->getPermissions() as $permission)
            {
                $permission->setRoleId($storeRole->getId());

                $permissionRepository->create($permission);
            }
        }
    }

    public function update($role)
    {
        self::getDB()->update(Role::getTableName(),$role->getId(),$role->toArray());

        $permissionRepository = new PermissionRepository();
        if (count($role->getPermissions())>0)
        {
            foreach ($role->getPermissions() as $permission)
            {
                $permission->setRoleId($role->getId());

                $permissionRepository->create($permission);
            }
        }

        if (count($role->getPermissionsToRemove())>0)
        {
            foreach ($role->getPermissionsToRemove() as $permission)
            {
                $permissionRepository->delete($permission->getId());
            }
        }
    }

    public function delete($id)
    {
        self::getDB()->delete(Role::getTableName(),$id);
    }

}
