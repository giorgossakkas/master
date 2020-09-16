<?php


namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\Permission;
use Core\SessionHandler;
use App\Repositories\DB\UserRepository;
use App\Repositories\DB\PermissionRepository;

class LoginController {

    public function index()
    {
        $userRepository = new UserRepository();
        $users= $userRepository->getAll();

        $userExists = false;
        if (count($users) > 0)
        {
            $userExists = true;
        }
        View::render("login.view.php",["userExists" => $userExists]);
    }

    public function login()
    {

      if(count($_POST)>0)
      {

         $userRepository = new UserRepository();
         $user= $userRepository->findBy('user_name',$_POST["user_name"]);

         if (! empty($user) && $user->getPassword() == $_POST["password"])
         {
             $permissionRepository = new PermissionRepository();
             $permissions= $permissionRepository->findAllBy('role_id',$user->getRoleId());

             SessionHandler::create($user,$permissions);

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
        SessionHandler::destroy();

        header('Location: /');
    }

}
