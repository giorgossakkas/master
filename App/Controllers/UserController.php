<?php

namespace App\Controllers;

use Core\View;
use Core\SessionHandler;
use App\Models\User;
use App\Models\Task;
use App\Models\Role;
use App\Models\Permission;
use App\Enum\UserPermissionsEnum;
use App\Repositories\DB\UserRepository;
use App\Repositories\DB\RoleRepository;
use App\Repositories\DB\TaskRepository;

class UserController {

  public function index()
  {
      $userRepository = new UserRepository();
      $users= $userRepository->findAllBy('is_team_leader',0);

      View::render("users/index.view.php",["users" => $users]);
  }

  public function viewTeamLeaders()
  {
      $userRepository = new UserRepository();
      $users= $userRepository->findAllBy('is_team_leader',1);

      View::render("users/leaders.view.php",["users" => $users]);
  }

  public function create()
  {
      $roleRepository = new RoleRepository();
      $roles= $roleRepository->getAll();
      $userRepository = new UserRepository();
      $users= $userRepository->findAllBy('is_team_leader',1);
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
          $userRepository = new UserRepository();
          $user = $userRepository->find($id);
          $users= $userRepository->findAllBy('is_team_leader',1);

          $roleRepository = new RoleRepository();
          $roles= $roleRepository->getAll();

          View::render("users/edit.view.php",["user" => $user, "roles" => $roles, "users" => $users]);
      }
  }

  public function showUserTasks($id)
  {
      if (isset($id))
      {
          $userRepository = new UserRepository();
          $user = $userRepository->find($id);

          $taskRepository = new TaskRepository();
          $tasks= $taskRepository->findAllBy('user_id',$user->getId());

          View::render("users/tasks.view.php",["user" => $user,"tasks" => $tasks]);
      }
  }

  public function store()
  {
      $user = new User();

      if (isset($_POST['role_id']))
      {
          $user->setUserName($_POST['user_name']);
      }
      if (isset($_POST['email']))
      {
          $user->setEmail($_POST['email']);
      }
      if (isset($_POST['password']))
      {
          $user->setPassword($_POST['password']);
      }
      if (isset($_POST['role_id']))
      {
          $user->setRoleId($_POST['role_id']);
      }
      if (isset($_POST['team_leader_id']))
      {
          $user->setTeamLeaderId($_POST['team_leader_id']);
      }
      $user->setIsTeamLeader(0);

      $messages = $user->validate();
      if (count($messages) > 0)
      {
          $roleRepository = new RoleRepository();
          $roles= $roleRepository->getAll();
          $userRepository = new UserRepository();
          $users= $userRepository->findAllBy('is_team_leader',1);
          return View::render("users/create.view.php",["messages" => $messages,"roles" => $roles,"users" => $users]);
      }

      $userRepository = new UserRepository();
      $userRepository->create($user);

      $this->setTeamLeader($user);

      header('Location: /users/index');
  }

  private function setTeamLeader($user)
  {
      if ($user->getTeamLeaderId()!=null)
      {
          $userRepository = new UserRepository();
          $teamLeader = $userRepository->find($user->getTeamLeaderId());

          if (! $teamLeader->isTeamLeader())
          {
              $teamLeader->setIsTeamLeader(1);

              $userRepository->update($teamLeader);
          }
      }
  }

  public function createRegister()
  {
      $user = new User();
      if (isset($_POST['user_name']))
      {
          $user->setUserName($_POST['user_name']);
      }
      if (isset($_POST['email']))
      {
          $user->setEmail($_POST['email']);
      }
      if (isset($_POST['password']))
      {
          $user->setPassword($_POST['password']);
      }
      $messages = $user->validateRegistration();

      if (count($messages) > 0)
      {
          return View::render("users/register.view.php", ["messages" => $messages]);
      }

      $role = new Role();
      $role->setName('Superadmin');

      $permissions =[];
      $allPermissions = UserPermissionsEnum::getAllPermissions();
      foreach($allPermissions as $permission)
      {
          $permissions[count($permissions)] = $this->addNewPermision($permission);
      }
      $role->setPermissions($permissions);

      $roleRepository = new RoleRepository();
      $roleRepository->create($role);

      $roleRepository = new RoleRepository();
      $roles= $roleRepository->findAllBy('name','Superadmin');

      $user->setRoleId($roles[0]->getId());

      $userRepository = new UserRepository();
      $userRepository->create($user);

      $userRepository = new UserRepository();
      $user= $userRepository->findBy('user_name',$user->getUserName());

      SessionHandler::create($user,$permissions);

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
        $userRepository = new UserRepository();
        $user = $userRepository->find($id);

        if (isset($_POST['user_name']))
        {
            $user->setUserName($_POST['user_name']);
        }
        if (isset($_POST['email']))
        {
            $user->setEmail($_POST['email']);
        }
        if (isset($_POST['role_id']))
        {
            $user->setRoleId($_POST['role_id']);
        }
        if (isset($_POST['team_leader_id']))
        {
            $user->setTeamLeaderId($_POST['team_leader_id']);
        }

        $messages = $user->validate();
        if (count($messages) > 0)
        {
            $users= $userRepository->findAllBy('is_team_leader',1);

            $roleRepository = new RoleRepository();
            $roles= $roleRepository->getAll();

            return View::render("users/edit.view.php", ["messages" => $messages,"user" => $user,"roles" => $roles,"users" => $users]);
        }

        $userRepository = new UserRepository();
        $userRepository->update($user);

        $this->setTeamLeader($user);

        header('Location: /users/index');
      }
  }

  public function delete($id)
  {
    if (isset($id))
    {
        $userRepository = new UserRepository();
        $userRepository->delete($id);
        header('Location: /users/index');
    }
  }

}
