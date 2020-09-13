<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\Task;
use App\Models\Role;
use App\Models\Permission;

class TeamLeaderController {

  public function index()
  {
      $sqlParams['is_team_leader']=1;
      $users = User::getDB()->read(User::getTableName(),$sqlParams,User::class);

      View::render("leaders/index.view.php",["users" => $users]);
  }


  public function create()
  {
      $roles = Role::getDB()->readAll(Role::getTableName(),Role::class);
      View::render("leaders/create.view.php",["roles" => $roles]);
  }

  public function edit($id)
  {
      if (isset($id))
      {
          $user = User::getDB()->readById(User::getTableName(),$id,User::class);
          $roles = Role::getDB()->readAll(Role::getTableName(),Role::class);

          View::render("leaders/edit.view.php",["user" => $user, "roles" => $roles]);
      }
  }

  public function viewTeamMembers($id)
  {
      if (isset($id))
      {
          $teamLeader = User::getDB()->readById(User::getTableName(),$id,User::class);
          $sqlParams['team_leader_id']=$id;
          $teamMembers = User::getDB()->read(User::getTableName(),$sqlParams,User::class);

          View::render("leaders/team.view.php",["teamLeader" => $teamLeader, "teamMembers" => $teamMembers]);
      }
  }

  public function store()
  {
      $user = new User();
      $user->setUserName($_POST['user_name']);
      $user->setEmail($_POST['email']);
      $user->setPassword($_POST['password']);
      $user->setRoleId($_POST['role_id']);
      $user->setIsTeamLeader(1);

      $messages = $user->validate();
      if (count($messages) > 0)
      {
          $roles = Role::getDB()->readAll(Role::getTableName(),Role::class);
          return View::render("leaders/create.view.php", ["messages" => $messages,"roles" => $roles]);
      }

      $user->create();

      header('Location: /leaders/index');
  }

  public function update($id)
  {
    if (isset($id))
    {
        $user = User::getDB()->readById(User::getTableName(),$id,User::class);

        $user->setUserName($_POST['user_name']);
        $user->setEmail($_POST['email']);
        $user->setRoleId($_POST['role_id']);

        $messages = $user->validate();
        if (count($messages) > 0)
        {
            $roles = Role::getDB()->readAll(Role::getTableName(),Role::class);
            return View::render("leaders/edit.view.php", ["messages" => $messages,"user" => $user,"roles" => $roles]);
        }

        $user->update();

        header('Location: /leaders/index');
      }
  }

  public function delete($id)
  {
    if (isset($id))
    {
        User::getDB()->delete(User::getTableName(),$id);
        header('Location: /leaders/index');
    }
  }

}
