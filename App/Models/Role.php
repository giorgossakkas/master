<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    private $permissionsToCreate;
    private $permissionsToRemove;

    protected $fillable = [
        'name'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function setPermissionsToCreate($permissionsToCreate)
    {
        $this->permissionsToCreate =$permissionsToCreate;
    }

    public function getPermissionsToCreate()
    {
        return $this->permissionsToCreate;
    }

    public function setPermissionsToRemove($permissionsToRemove)
    {
        $this->permissionsToRemove =$permissionsToRemove;
    }

    public function getPermissionsToRemove()
    {
        return $this->permissionsToRemove;
    }

    public function isPermissionEnable($permissionType)
    {
        foreach ($this->permissions as $permission)
        {
            if ($permission->type == $permissionType)
            {
                  return true;
            }
        }

        return false;

    }

}
