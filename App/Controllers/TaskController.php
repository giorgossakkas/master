<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\Task;

class TaskController {

  public function index()
  {
      if(session_status() !== PHP_SESSION_ACTIVE)
          session_start();

      $sqlParams['teamleaderid']=$_SESSION["id"];
      $sql = "SELECT * FROM TASKS WHERE USER_ID IS NULL UNION SELECT * FROM TASKS WHERE USER_ID IN (SELECT ID FROM USERS WHERE TEAM_LEADER_ID =:teamleaderid)";
      $tasks = Task::getDB()->execute($sql,$sqlParams,Task::class);

      View::render("tasks/index.view.php",["tasks" => $tasks]);
  }
  public function create()
  {
      View::render("tasks/create.view.php");
  }

  public function edit($id)
  {
      if (isset($id))
      {
          $task = Task::getDB()->readById(Task::getTableName(),$id,Task::class);

          View::render("tasks/edit.view.php",["task" => $task]);
      }
  }

  public function assign($id)
  {
      if (isset($id))
      {
          $task = Task::getDB()->readById(Task::getTableName(),$id,Task::class);
          if(session_status() !== PHP_SESSION_ACTIVE)
              session_start();
          $sqlParams['team_leader_id']=$_SESSION["id"];
          $users = User::getDB()->read(User::getTableName(),$sqlParams,User::class);

          View::render("tasks/assign.view.php",["task" => $task,"users" => $users]);
      }
  }

  public function store()
  {
      $task = new Task();
      $task->setName($_POST['name']);
      $task->setDescription($_POST['description']);
      $task->setStatus("PENDING");

      $messages = $task->validate();
      if (count($messages) > 0)
      {
          return View::render("tasks/create.view.php", ["messages" => $messages]);
      }

      $task->create();
      header('Location: /tasks/index');
  }

  public function update($id)
  {

    if (isset($id))
    {
        $task = Task::getDB()->readById(Task::getTableName(),$id,Task::class);

        $task->setName($_POST['name']);
        $task->setDescription($_POST['description']);

        $messages = $task->validate();
        if (count($messages) > 0)
        {
            return View::render("tasks/edit.view.php", ["messages" => $messages,"task" => $task]);
        }

        $task->update();
        header('Location: /tasks/index');
      }

  }

  public function complete($id)
  {
    if (isset($id))
    {
        $task = Task::getDB()->readById(Task::getTableName(),$id,Task::class);
        $task->setStatus("COMPLETED");
        $task->update();
        header('Location: /index');
      }
  }

  public function unassign($id)
  {
    if (isset($id))
    {
        $task = Task::getDB()->readById(Task::getTableName(),$id,Task::class);
        $task->setUserId(null);
        $task->update();
        header('Location: /tasks/index');
      }
  }

  public function storeAssignTask($id)
  {
    if (isset($id))
    {
        $task = Task::getDB()->readById(Task::getTableName(),$id,Task::class);
        $task->setUserId($_POST['user_id']);
        $task->update();
        header('Location: /tasks/index');
      }
  }

  public function delete($id)
  {
    if (isset($id))
    {
        Task::getDB()->delete(Task::getTableName(),$id);
        header('Location: /tasks/index');
      }
  }

}
