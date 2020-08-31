<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\Task;

class IndexController {

    public function index()
    {
        $query = User::getDB();
        $users = $query->readAll(User::getTableName(),User::class);
        $tasks = $query->readAll(Task::getTableName(),Task::class);

        View::render("index.view.php",["users" => $users,"tasks" => $tasks]);
    }

}
