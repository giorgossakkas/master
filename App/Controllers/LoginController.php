<?php


namespace App\Controllers;

use Core\View;
use App\Models\User;

class LoginController {

    public function index()
    {
        View::render("login.view.php");
    }

    public function login()
    {
      if(session_status() !== PHP_SESSION_ACTIVE)
          session_start();

      if(count($_POST)>0)
      {
         $sqlParams['user_name']=$_POST["user_name"];
         $sqlParams['password']=$_POST["password"];

         $users = User::getDB()->read(User::getTableName(),$sqlParams,User::class);

         if (count($users) == 1)
         {
             $user = $users[0];
             $_SESSION["id"] = $user->getId();
             $_SESSION["user_name"] = $user->getUserName();

             header('Location: /index');
         }
         else
         {
            $message[0] = "Invalid Username or Password!";
            return View::render("login.view.php", ["messages" => $message]);
         }
      }

    }
    public function logout()
    {
        session_start();

        unset($_SESSION["id"]);
        unset($_SESSION["name"]);

        header('Location: /');
    }

}
