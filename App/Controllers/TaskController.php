<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\Task;
use Core\SessionHandler;
use App\Repositories\DB\TaskRepository;
use App\Repositories\DB\UserRepository;

class TaskController {

  public function index()
  {
      $taskRepository = new TaskRepository();
      $tasks= $taskRepository->findTasksBelongsToLoggedInUser();

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
          $taskRepository = new TaskRepository();
          $task= $taskRepository->find($id);

          View::render("tasks/edit.view.php",["task" => $task]);
      }
  }

  public function assign($id)
  {
      if (isset($id))
      {
          $taskRepository = new TaskRepository();
          $task= $taskRepository->find($id);

          $userRepository = new UserRepository();
          $users= $userRepository->findAllBy('team_leader_id',SessionHandler::getLoggedInUserId());

          View::render("tasks/assign.view.php",["task" => $task,"users" => $users]);
      }
  }

  public function store()
  {
      $task = new Task();
      if (isset($_POST['name']))
      {
          $task->setName($_POST['name']);
      }
      if (isset($_POST['description']))
      {
          $task->setDescription($_POST['description']);
      }
      $task->setStatus("PENDING");

      $messages = $task->validate();
      if (count($messages) > 0)
      {
          return View::render("tasks/create.view.php", ["messages" => $messages]);
      }

      $taskRepository = new TaskRepository();
      $taskRepository->create($task);

      header('Location: /tasks/index');
  }

  public function update($id)
  {

    if (isset($id))
    {
        $taskRepository = new TaskRepository();
        $task= $taskRepository->find($id);

        if (isset($_POST['name']))
        {
            $task->setName($_POST['name']);
        }
        if (isset($_POST['description']))
        {
            $task->setDescription($_POST['description']);
        }

        $messages = $task->validate();
        if (count($messages) > 0)
        {
            return View::render("tasks/edit.view.php", ["messages" => $messages,"task" => $task]);
        }

        $taskRepository = new TaskRepository();
        $taskRepository->update($task);

        header('Location: /tasks/index');
      }

  }

  public function complete($id)
  {
    if (isset($id))
    {
        $taskRepository = new TaskRepository();
        $task= $taskRepository->find($id);

        $task->setStatus("COMPLETED");

        $taskRepository = new TaskRepository();
        $taskRepository->update($task);

        header('Location: /index');
      }
  }

  public function unassign($id)
  {
    if (isset($id))
    {
        $taskRepository = new TaskRepository();
        $task= $taskRepository->find($id);

        $task->setUserId(null);

        $taskRepository = new TaskRepository();
        $taskRepository->update($task);

        header('Location: /tasks/index');
      }
  }

  public function storeAssignTask($id)
  {
    if (isset($id))
    {
        $taskRepository = new TaskRepository();
        $task= $taskRepository->find($id);

        if (isset($_POST['user_id']))
        {
            $task->setUserId($_POST['user_id']);

            $taskRepository = new TaskRepository();
            $taskRepository->update($task);
        }

        header('Location: /tasks/index');
    }
  }

  public function delete($id)
  {
    if (isset($id))
    {
        $taskRepository = new TaskRepository();
        $task= $taskRepository->delete($id);

        header('Location: /tasks/index');
      }
  }

}
