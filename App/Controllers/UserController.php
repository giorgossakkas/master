<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\Task;
use App\Models\Role;
use App\Models\Permission;

class UserController {

  public function index()
  {
      $sqlParams['is_team_leader']=0;
      $users = User::getDB()->read(User::getTableName(),$sqlParams,User::class);

      View::render("users/index.view.php",["users" => $users]);
  }

  public function viewTeamLeaders()
  {
      $sqlParams['is_team_leader']=1;
      $users = User::getDB()->read(User::getTableName(),$sqlParams,User::class);

      View::render("users/leaders.view.php",["users" => $users]);
  }

  public function create()
  {
      $roles = Role::getDB()->readAll(Role::getTableName(),Role::class);
      $users = User::getDB()->readAll(User::getTableName(),User::class);
      View::render("users/create.view.php",["roles" => $roles,"users" => $users]);
  }

  public function register()
  {
      View::render("users/register.view.php");
  }

  public function edit($id)
  {
      if (isset($id))
      {
          $user = User::getDB()->readById(User::getTableName(),$id,User::class);
          $roles = Role::getDB()->readAll(Role::getTableName(),Role::class);
          $users = User::getDB()->readAll(User::getTableName(),User::class);

          View::render("users/edit.view.php",["user" => $user, "roles" => $roles, "users" => $users]);
      }
  }

  public function showUserTasks($id)
  {
      if (isset($id))
      {
          $query = User::getDB();
          $user = $query->readById(User::getTableName(),$id,User::class);

          $sqlParams['user_id']=$user->getId();
          $tasks = $query->read(Task::getTableName(),$sqlParams,Task::class);

          View::render("users/tasks.view.php",["user" => $user,"tasks" => $tasks]);
      }
  }

  public function store()
  {
      $user = new User();
      $user->setUserName($_POST['user_name']);
      $user->setEmail($_POST['email']);
      $user->setPassword($_POST['password']);
      $user->setRoleId($_POST['role_id']);
      $user->setTeamLeaderId($_POST['team_leader_id']);
      $user->setIsTeamLeader(0);

      $messages = $user->validate();
      if (count($messages) > 0)
      {
          $roles = Role::getDB()->readAll(Role::getTableName(),Role::class);
          $users = User::getDB()->readAll(User::getTableName(),User::class);
          return View::render("users/create.view.php",["messages" => $messages,"roles" => $roles,"users" => $users]);
      }

      $user->create();

      $this->setTeamLeader($user);

      header('Location: /users/index');
  }

  private function setTeamLeader($user)
  {
      if ($user->getTeamLeaderId()!=null)
      {
          $teamLeader = User::getDB()->readById(User::getTableName(),$user->getTeamLeaderId(),User::class);
          if (! $teamLeader->isTeamLeader())
          {
              $teamLeader->setIsTeamLeader(1);
              $teamLeader->update();
          }
      }
  }

  public function createRegister()
  {
      $user = new User();
      $user->setUserName($_POST['user_name']);
      $user->setEmail($_POST['email']);
      $user->setPassword($_POST['password']);

      $messages = $user->validateRegistration();

      if (count($messages) > 0)
      {
          return View::render("users/register.view.php", ["messages" => $messages]);
      }

      $role = new Role();
      $role->setName('Superadmin');

      $permissions =[];
      $permissions[count($permissions)] = $this->addNewPermision('MANAGE_ROLES');
      $permissions[count($permissions)] = $this->addNewPermision('MANAGE_TEAM_LEADERS');
      $permissions[count($permissions)] = $this->addNewPermision('MANAGE_USERS');
      $permissions[count($permissions)] = $this->addNewPermision('MANAGE_TASKS');
      $permissions[count($permissions)] = $this->addNewPermision('COMPLETE_TASKS');
      $role->setPermissions($permissions);

      $role->create();

      $sqlParams= [];
      $sqlParams['name']='Superadmin';
      $roles = Role::getDB()->read(Role::getTableName(),$sqlParams,Role::class);


      $user->setRoleId($roles[0]->getId());

      $user->create();

      if(session_status() !== PHP_SESSION_ACTIVE)
          session_start();

      //reload user to get the id
      $sqlParams= [];
      $sqlParams['user_name']=$user->getUserName();
      $users = User::getDB()->read(User::getTableName(),$sqlParams,User::class);
      $user = $users[0];
      $_SESSION["id"] = $user->getId();
      $_SESSION["user_name"] = $user->getUserName();
      foreach ($permissions as $permission)
      {
          $_SESSION[$permission->getType()] = true;
      }
      header('Location: /index');
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
        $user = User::getDB()->readById(User::getTableName(),$id,User::class);

        $user->setUserName($_POST['user_name']);
        $user->setEmail($_POST['email']);
        $user->setRoleId($_POST['role_id']);
        $user->setTeamLeaderId($_POST['team_leader_id']);

        $messages = $user->validate();
        if (count($messages) > 0)
        {
            $roles = Role::getDB()->readAll(Role::getTableName(),Role::class);
            $users = User::getDB()->readAll(User::getTableName(),User::class);
            return View::render("users/edit.view.php", ["messages" => $messages,"user" => $user,"roles" => $roles,"users" => $users]);
        }

        $user->update();

        $this->setTeamLeader($user);

        header('Location: /users/index');
      }
  }

  public function delete($id)
  {
    if (isset($id))
    {
        User::getDB()->delete(User::getTableName(),$id);
        header('Location: /users/index');
    }
  }

}
