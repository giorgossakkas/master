<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use App\Models\Role;
use App\Models\Permission;
use Core\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class RoleRepository implements EloquentRepositoryInterface
{
    public function getBasicQuery() : Builder
    {
        return Role::query();
    }
    public function getAll($exclude_admin = false)
    {
        return $this->getBasicQuery()->get();
    }

    public function find($id)
    {
        $role = $this->getBasicQuery()->find($id);
        return $role;
    }

    public function findBy($field_name, $field_value)
    {
        return  $this->getBasicQuery()->where($field_name, $field_value)->first();
    }

    public function findAllBy($field_name, $field_value)
    {
        return  $this->getBasicQuery()->where($field_name, $field_value)->get();
    }

    public function create($role)
    {
        $role->save();

        if (count($role->getPermissionsToCreate()) > 0)
        {
            $role->permissions()->saveMany($role->getPermissionsToCreate());
        }

        return $role;
    }

    public function update($role)
    {
        $role->update();

        if (count($role->getPermissionsToCreate()) > 0)
        {
            $role->permissions()->saveMany($role->getPermissionsToCreate());
        }

        if (count($role->getPermissionsToRemove()) > 0)
        {
            foreach ($role->getPermissionsToRemove() as $permission)
            {
                $permission->delete();
            }
        }

        return $role;
    }

    public function delete($id)
    {
        $role = $this->find($id);
        $role->delete();

    }

}
