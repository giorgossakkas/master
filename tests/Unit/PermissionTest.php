<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Enums\UserPermissionsEnum;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class PermissionTest extends TestCase
{

    public function testManageRolePermission()
    {
      $user = new User();
      $role = new Role();
      $user->role = $role;

      $response = $this->actingAs($user)->get('roles/index');
      $response->assertStatus(403);

      $permission = new Permission();
      $permission->type = UserPermissionsEnum::MANAGE_ROLES;
      $permissions[] = $permission;

      $role->permissions = $permissions;

      $response = $this->actingAs($user)->get('roles/index');
      $response->assertStatus(200);

    }

}
