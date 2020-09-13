<?php

namespace App\Controllers;

use Core\View;
use App\Models\Role;
use App\Models\Permission;

class RoleController {

  public function index()
  {
      $query = Role::getDB();
      $roles = $query->readAll(Role::getTableName(),Role::class);

      View::render("roles/index.view.php",["roles" => $roles]);
  }

  public function create()
  {
      View::render("roles/create.view.php");
  }

  public function edit($id)
  {
      if (isset($id))
      {
          $role = Role::getDB()->readById(Role::getTableName(),$id,Role::class);
          $sqlParams['role_id']=$id;
          $permissions = Permission::getDB()->read(Permission::getTableName(),$sqlParams,Permission::class);

          $permissionsArray=[];
          if (count($permissions)>0)
          {
              foreach ($permissions as $permission)
              {
                  $permissionsArray[$permission->getType()] = true;
              }
          }
          View::render("roles/edit.view.php",["role" => $role,"permissions" => $permissionsArray]);
      }
  }

  public function store()
  {
      $role = new Role();
      $role->setName($_POST['name']);

      $permissions =[];
      if (isset($_POST['MANAGE_ROLES']))
      {
          $permissions[count($permissions)] = $this->addNewPermision('MANAGE_ROLES');
      }
      if (isset($_POST['MANAGE_TEAM_LEADERS']))
      {
          $permissions[count($permissions)] = $this->addNewPermision('MANAGE_TEAM_LEADERS');
      }
      if (isset($_POST['MANAGE_USERS']))
      {
          $permissions[count($permissions)] = $this->addNewPermision('MANAGE_USERS');
      }
      if (isset($_POST['MANAGE_TASKS']))
      {
          $permissions[count($permissions)] = $this->addNewPermision('MANAGE_TASKS');
      }
      if (isset($_POST['COMPLETE_TASKS']))
      {
          $permissions[count($permissions)] = $this->addNewPermision('COMPLETE_TASKS');
      }
      $role->setPermissions($permissions);
      $messages = $role->validate();
      if (count($messages) > 0)
      {
          return View::render("roles/create.view.php", ["messages" => $messages]);
      }

      $role->create();
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
        $role = Role::getDB()->readById(Role::getTableName(),$id,Role::class);
        $role->setName($_POST['name']);

        $messages = $role->validate();
        if (count($messages) > 0)
        {
            return View::render("roles/edit.view.php", ["messages" => $messages,"role" => $role]);
        }

        $sqlParams['role_id']=$id;
        $permissions = Permission::getDB()->read(Permission::getTableName(),$sqlParams,Permission::class);

        $permissionsToRemove=[];
        $permissionsToCreate=[];

        if (isset($_POST['MANAGE_ROLES']) && $this->getPermission($permissions,'MANAGE_ROLES') == null)
        {
            $permissionsToCreate[count($permissionsToCreate)] = $this->addNewPermision('MANAGE_ROLES');
        }
        if (isset($_POST['MANAGE_TEAM_LEADERS']) && $this->getPermission($permissions,'MANAGE_TEAM_LEADERS') == null)
        {
            $permissionsToCreate[count($permissionsToCreate)] = $this->addNewPermision('MANAGE_TEAM_LEADERS');
        }
        if (isset($_POST['MANAGE_USERS']) && $this->getPermission($permissions,'MANAGE_USERS') == null)
        {
            $permissionsToCreate[count($permissionsToCreate)] = $this->addNewPermision('MANAGE_USERS');
        }
        if (isset($_POST['MANAGE_TASKS']) && $this->getPermission($permissions,'MANAGE_TASKS') == null)
        {
            $permissionsToCreate[count($permissionsToCreate)] = $this->addNewPermision('MANAGE_TASKS');
        }
        if (isset($_POST['COMPLETE_TASKS']) && $this->getPermission($permissions,'COMPLETE_TASKS') == null)
        {
            $permissionsToCreate[count($permissionsToCreate)] = $this->addNewPermision('COMPLETE_TASKS');
        }

        if (count($permissions)>0)
        {
            foreach ($permissions as $permission)
            {
              if (! isset($_POST['MANAGE_ROLES']) && $permission->getType() == 'MANAGE_ROLES')
              {
                  $permissionsToRemove[count($permissionsToRemove)] =$permission;
              }
              if (! isset($_POST['MANAGE_TEAM_LEADERS']) && $permission->getType() == 'MANAGE_TEAM_LEADERS')
              {
                  $permissionsToRemove[count($permissionsToRemove)] =$permission;
              }
              if (! isset($_POST['MANAGE_USERS']) && $permission->getType() == 'MANAGE_USERS')
              {
                  $permissionsToRemove[count($permissionsToRemove)] =$permission;
              }
              if (! isset($_POST['MANAGE_TASKS']) && $permission->getType() == 'MANAGE_TASKS')
              {
                  $permissionsToRemove[count($permissionsToRemove)] =$permission;
              }
              if (! isset($_POST['COMPLETE_TASKS']) && $permission->getType() == 'COMPLETE_TASKS')
              {
                  $permissionsToRemove[count($permissionsToRemove)] =$permission;
              }
            }
        }

        $role->setPermissions($permissionsToCreate);
        $role->setPermissionsToRemove($permissionsToRemove);
        $role->update();
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
        Role::getDB()->delete(Role::getTableName(),$id);

        $sqlParams['role_id']=$id;
        $permissions = Permission::getDB()->read(Permission::getTableName(),$sqlParams,Permission::class);

        if (count($permissions)>0)
        {
            foreach ($permissions as $permission)
            {
                Permission::getDB()->delete(Permission::getTableName(),$permission->getId());
            }
        }

        header('Location: /roles/index');
      }
  }

}
