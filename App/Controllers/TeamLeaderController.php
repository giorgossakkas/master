<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\Task;
use App\Models\Role;
use App\Models\Permission;
use App\Repositories\DB\UserRepository;
use App\Repositories\DB\RoleRepository;

class TeamLeaderController {

  public function index()
  {
      $userRepository = new UserRepository();
      $users= $userRepository->findAllBy('is_team_leader',1);

      View::render("leaders/index.view.php",["users" => $users]);
  }


  public function create()
  {
      $roleRepository = new RoleRepository();
      $roles= $roleRepository->getAll();

      View::render("leaders/create.view.php",["roles" => $roles]);
  }

  public function edit($id)
  {
      if (isset($id))
      {
          $userRepository = new UserRepository();
          $user = $userRepository->find($id);

          $roleRepository = new RoleRepository();
          $roles= $roleRepository->getAll();

          View::render("leaders/edit.view.php",["user" => $user, "roles" => $roles]);
      }
  }

  public function viewTeamMembers($id)
  {
      if (isset($id))
      {
          $userRepository = new UserRepository();
          $teamLeader = $userRepository->find($id);

          $teamMembers= $userRepository->findAllBy('team_leader_id',$id);

          View::render("leaders/team.view.php",["teamLeader" => $teamLeader, "teamMembers" => $teamMembers]);
      }
  }

  public function store()
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
      if (isset($_POST['role_id']))
      {
          $user->setRoleId($_POST['role_id']);
      }

      $user->setIsTeamLeader(1);

      $messages = $user->validate();
      if (count($messages) > 0)
      {
          $roleRepository = new RoleRepository();
          $roles= $roleRepository->getAll();
          return View::render("leaders/create.view.php", ["messages" => $messages,"roles" => $roles]);
      }

      $userRepository = new UserRepository();
      $userRepository->create($user);

      header('Location: /leaders/index');
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

        $messages = $user->validate();
        if (count($messages) > 0)
        {
            $roleRepository = new RoleRepository();
            $roles= $roleRepository->getAll();
            return View::render("leaders/edit.view.php", ["messages" => $messages,"user" => $user,"roles" => $roles]);
        }

        $userRepository = new UserRepository();
        $userRepository->update($user);

        header('Location: /leaders/index');
      }
  }

  public function delete($id)
  {
    if (isset($id))
    {
        $userRepository = new UserRepository();
        $userRepository->delete($id);

        header('Location: /leaders/index');
    }
  }

}
