<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\TaskRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }


  public function index()
  {
      $taskRepository = new TaskRepository();
      $user = Auth::user();
      $tasks= $taskRepository->findAllBy('owner_user_id',$user->id);

      return view('tasks.index',compact("tasks"));
  }

  public function onAssign($id)
  {
       $taskRepository = new TaskRepository();
       $task= $taskRepository->find($id);

       $userRepository = new UserRepository();
       $user = Auth::user();
       $users= $userRepository->findAllBy('team_leader_id',$user->id);

       return view('tasks.assign',compact("task","users"));
   }

   public function assign(Request $request,$id)
   {
       $this->validate($request, [
           'assign_to_user_id' => ['required']
       ]);

       $taskRepository = new TaskRepository();

       $task = $taskRepository->find($id);

       $task->assign_to_user_id =  $request->get('assign_to_user_id');

       $task = $taskRepository->update($task);

       return redirect('/tasks/index');
  }

  public function unassign($id)
  {
      $taskRepository = new TaskRepository();

      $task = $taskRepository->find($id);

      $task->assign_to_user_id =  null;

      $task = $taskRepository->update($task);

      return redirect('/tasks/index');
  }

  public function complete($id)
  {
      $taskRepository = new TaskRepository();

      $task = $taskRepository->find($id);

      $task->status = 'COMPLETED';

      $task = $taskRepository->update($task);

      return redirect('/home');
  }
  public function create()
  {
      return view('tasks.create');
  }

  public function edit($id)
  {

      $taskRepository = new TaskRepository();
      $task = $taskRepository->find($id);

      return view('tasks.edit',compact("task"));
  }

  public function store(Request $request)
  {
      $this->validate($request, [
          'name' => ['required'],
          'description' => ['required']
      ]);

      $task = new Task($request->all());
      $task->status = "PENDING";
      $user = Auth::user();
      $task->owner_user_id = $user->id;

      $taskRepository = new TaskRepository();
      $task = $taskRepository->create($task);

      return redirect('/tasks/index');
  }

  public function update(Request $request,$id)
  {
      $this->validate($request, [
          'name' => ['required'],
          'description' => ['required']
      ]);

      $taskRepository = new TaskRepository();

      $task = $taskRepository->find($id);

      $task->name =  $request->get('name');
      $task->description =  $request->get('description');

      $task = $taskRepository->update($task);

      return redirect('/tasks/index');
  }

  public function delete($id)
  {
      $taskRepository = new TaskRepository();
      $taskRepository->delete($id);

      return redirect('/tasks/index');
  }

}
