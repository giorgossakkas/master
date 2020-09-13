<?php


namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\Permission;

class LoginController {

    public function index()
    {
        $users = User::getDB()->readAll(User::getTableName(),User::class);
        $userExists = false;
        if (count($users) > 0)
        {
            $userExists = true;
        }
        View::render("login.view.php",["userExists" => $userExists]);
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

             $sqlParams= [];
             $sqlParams['role_id']=$user->getRoleId();
             $permissions = Permission::getDB()->read(Permission::getTableName(),$sqlParams,Permission::class);

             $_SESSION["id"] = $user->getId();
             $_SESSION["user_name"] = $user->getUserName();

             if (count($permissions) > 0)
             {
                  foreach ($permissions as $permission)
                  {
                      $_SESSION[$permission->getType()] = true;
                  }
             }

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
        if(session_status() !== PHP_SESSION_ACTIVE)
            session_start();

        unset($_SESSION["id"]);
        unset($_SESSION["user_name"]);
        unset($_SESSION["MANAGE_ROLES"]);
        unset($_SESSION["MANAGE_TEAM_LEADERS"]);
        unset($_SESSION["MANAGE_USERS"]);
        unset($_SESSION["MANAGE_TASKS"]);
        unset($_SESSION["COMPLETE_TASKS"]);

        header('Location: /');
    }

}
