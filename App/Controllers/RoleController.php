<?php

namespace App\Controllers;

use Core\View;
use App\Models\Role;
use App\Models\Permission;
use App\Enum\UserPermissionsEnum;
use App\Repositories\DB\RoleRepository;
use App\Repositories\DB\PermissionRepository;

class RoleController {

  public function index()
  {
      $roleRepository = new RoleRepository();
      $roles= $roleRepository->getAll();

      View::render("roles/index.view.php",["roles" => $roles]);
  }

  public function create()
  {
      $allPermissions = UserPermissionsEnum::getAllPermissions();
      View::render("roles/create.view.php",["allPermissions" => $allPermissions]);
  }

  public function edit($id)
  {
      if (isset($id))
      {
          $allPermissions = UserPermissionsEnum::getAllPermissions();
          $roleRepository = new RoleRepository();
          $role = $roleRepository->find($id);

          $permissionRepository = new PermissionRepository();
          $permissions= $permissionRepository->findAllBy('role_id',$id);

          $permissionsArray=[];
          if (count($permissions)>0)
          {
              foreach ($permissions as $permission)
              {
                  $permissionsArray[$permission->getType()] = true;
              }
          }
          View::render("roles/edit.view.php",["role" => $role,"permissions" => $permissionsArray,"allPermissions" => $allPermissions]);
      }
  }

  public function store()
  {
      $role = new Role();
      if (isset($_POST['name']))
      {
          $role->setName($_POST['name']);
      }
      $permissions =[];
      $allPermissions = UserPermissionsEnum::getAllPermissions();
      foreach($_POST as $permission => $value)
      {
          if(in_array($permission, $allPermissions))
          {
              $permissions[count($permissions)] = $this->addNewPermision($permission);
          }
      }
      $role->setPermissions($permissions);
      $messages = $role->validate();
      if (count($messages) > 0)
      {
          $allPermissions = UserPermissionsEnum::getAllPermissions();
          return View::render("roles/create.view.php", ["messages" => $messages,"allPermissions" => $allPermissions]);
      }
      $roleRepository = new RoleRepository();
      $roleRepository->create($role);
      header('Location: /roles/index');
  }

  private function addNewPermision($type)
  {
      $permission = new Permission();
      $permission->setType($type);

      return $permission;
  }

  public function update($id)
  {

    if (isset($id))
    {
        $roleRepository = new RoleRepository();
        $role = $roleRepository->find($id);
        if (isset($_POST['name']))
        {
            $role->setName($_POST['name']);
        }

        $messages = $role->validate();
        if (count($messages) > 0)
        {
            $allPermissions = UserPermissionsEnum::getAllPermissions();
            return View::render("roles/edit.view.php", ["messages" => $messages,"role" => $role,"allPermissions" => $allPermissions]);
        }

        $permissionRepository = new PermissionRepository();
        $permissions= $permissionRepository->findAllBy('role_id',$id);

        $permissionsToRemove=[];
        $permissionsToCreate=[];

        $allPermissions = UserPermissionsEnum::getAllPermissions();
        foreach($_POST as $permission => $value)
        {
           if(in_array($permission, $allPermissions) && $this->getPermission($permissions,$permission) == null )
           {
                $permissionsToCreate[count($permissionsToCreate)] = $this->addNewPermision($permission);
           }
        }

        if (count($permissions)>0)
        {
            foreach ($permissions as $permission)
            {
              if (! isset($_POST[$permission->getType()]))
              {
                  $permissionsToRemove[count($permissionsToRemove)] =$permission;
              }
            }
        }

        $role->setPermissions($permissionsToCreate);
        $role->setPermissionsToRemove($permissionsToRemove);

        $roleRepository = new RoleRepository();
        $roleRepository->update($role);

        header('Location: /roles/index');
      }

  }

  private function getPermission($permissions,$type)
  {
      if (count($permissions)>0)
      {
        foreach ($permissions as $permission)
        {
            if ($permission->getType() == $type)
            {
                return $permission;
            }
        }
      }
      return null;
  }

  public function delete($id)
  {
    if (isset($id))
    {
        $roleRepository = new RoleRepository();
        $roleRepository->delete($id);

        $permissionRepository = new PermissionRepository();
        $permissions= $permissionRepository->findAllBy('role_id',$id);

        if (count($permissions)>0)
        {
            foreach ($permissions as $permission)
            {
                $permissionRepository->delete($permission->getId());
            }
        }

        header('Location: /roles/index');
      }
  }

}
