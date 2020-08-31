<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\Task;

class UserController {

  public function create()
  {
      View::render("users/create.view.php");
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

          View::render("users/edit.view.php",["user" => $user]);
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

      $messages = $user->validate();
      if (count($messages) > 0)
      {
          return View::render("users/create.view.php", ["messages" => $messages]);
      }

      $user->create();
      header('Location: /index');
  }

  public function createRegister()
  {
      $user = new User();
      $user->setUserName($_POST['user_name']);
      $user->setEmail($_POST['email']);
      $user->setPassword($_POST['password']);

      $messages = $user->validate();
      if (count($messages) > 0)
      {
          return View::render("users/create.view.php", ["messages" => $messages]);
      }

      $user->create();

      if(session_status() !== PHP_SESSION_ACTIVE)
          session_start();

      //reload user to get the id
      $sqlParams['user_name']=$user->getUserName();
      $users = User::getDB()->read(User::getTableName(),$sqlParams,User::class);
      $user = $users[0];
      $_SESSION["id"] = $user->getId();
      $_SESSION["user_name"] = $user->getUserName();
      header('Location: /index');
  }

  public function update($id)
  {
    if (isset($id))
    {
        $user = User::getDB()->readById(User::getTableName(),$id,User::class);

        $user->setUserName($_POST['user_name']);
        $user->setEmail($_POST['email']);

        $messages = $user->validate();
        if (count($messages) > 0)
        {
            return View::render("users/edit.view.php", ["messages" => $messages,"user" => $user]);
        }

        $user->update();
        header('Location: /index');
      }
  }

  public function delete($id)
  {
    if (isset($id))
    {
        User::getDB()->delete(User::getTableName(),$id);
        header('Location: /index');
    }
  }

}
