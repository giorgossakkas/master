<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\Task;

class IndexController {

    public function index()
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
            session_start();

        $tasks=[];
        $teamMembers=[];
        if (isset($_SESSION["id"]))
        {
            $sqlParams['user_id']=$_SESSION["id"];
            $tasks = Task::getDB()->read(Task::getTableName(),$sqlParams,Task::class);

            $user = User::getDB()->readById(User::getTableName(),$_SESSION["id"],User::class);
            $teamMembers=[];
            if ($user->isTeamLeader())
            {
                $sqlParams=[];
                $sqlParams['team_leader_id']=$_SESSION["id"];
                $teamMembers = User::getDB()->read(User::getTableName(),$sqlParams,User::class);
            }
        }

        View::render("index.view.php",["tasks" => $tasks,"teamMembers" => $teamMembers]);
    }

}
