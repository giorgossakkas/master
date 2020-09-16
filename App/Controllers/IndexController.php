<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\Task;
use Core\SessionHandler;
use App\Repositories\DB\TaskRepository;
use App\Repositories\DB\UserRepository;

class IndexController {

    public function index()
    {
        $tasks=[];
        $teamMembers=[];
        $loggedInUserId = SessionHandler::getLoggedInUserId();

        $taskRepository = new TaskRepository();
        $tasks= $taskRepository->findAllBy('user_id',$loggedInUserId);

        $userRepository = new UserRepository();
        $user = $userRepository->find($loggedInUserId);

        $teamMembers=[];
        if ($user->isTeamLeader())
        {
            $teamMembers= $userRepository->findAllBy('team_leader_id',$loggedInUserId);
        }

        View::render("index.view.php",["tasks" => $tasks,"teamMembers" => $teamMembers]);
    }

}
