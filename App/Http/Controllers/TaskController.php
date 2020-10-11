<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\TaskRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Enums\TaskStatusEnum;


class TaskController extends Controller
{
    private $taskRepository;
    private $userRepository;

    public function __construct()
    {
        $this->taskRepository = app(TaskRepository::class);
        $this->userRepository = app(UserRepository::class);
    }


    public function index()
    {
        $user = Auth::user();
        $tasks= $this->taskRepository->findAllBy('owner_user_id',$user->id);

        return view('tasks.index',compact("tasks"));
    }

    public function onAssign($id)
    {
         $task= $this->taskRepository->find($id);

         if ($task!=null)
         {
             $user = Auth::user();
             $users= $this->userRepository->findAllBy('team_leader_id',$user->id);

             return view('tasks.assign',compact("task","users"));
          }
          else
          {
              return redirect()->route('task_index')->withErrors("Task with id ". $id ." not found");
          }
     }

     public function assign(Request $request,$id)
     {
         $this->validate($request, [
             'assign_to_user_id' => ['required']
         ]);


         $task = $this->taskRepository->find($id);

         if ($task!=null)
         {
             $task->assign_to_user_id =  $request->get('assign_to_user_id');

             $task = $this->taskRepository->update($task);

             return redirect('/tasks/index');
         }
         else
         {
             return redirect()->route('task_index')->withErrors("Task with id ". $id ." not found");
         }
    }

    public function unassign($id)
    {
        $task = $this->taskRepository->find($id);

        if ($task!=null)
        {
            $task->assign_to_user_id =  null;

            $task = $this->taskRepository->update($task);

            return redirect()->route('task_index');
        }
        else
        {
            return redirect()->route('task_index')->withErrors("Task with id ". $id ." not found");
        }
    }

    public function complete($id)
    {
        $task = $this->taskRepository->find($id);
        if ($task!=null)
        {
            $task->status = TaskStatusEnum::COMPLETED;

            $task = $this->taskRepository->update($task);

            return redirect()->route('home');
        }
        else
        {
            return redirect()->route('home')->withErrors("Task with id ". $id ." not found");
        }
    }
    public function create()
    {
        return view('tasks.create');
    }

    public function edit($id)
    {
        $task = $this->taskRepository->find($id);
        if ($task!=null)
        {
            return view('tasks.edit',compact("task"));
        }
        else
        {
            return redirect()->route('task_index')->withErrors("Task with id ". $id ." not found");
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required']
        ]);

        $task = new Task($request->all());
        $task->status = TaskStatusEnum::PENDING;
        $user = Auth::user();
        $task->owner_user_id = $user->id;

        $task = $this->taskRepository->create($task);

        return redirect()->route('task_index');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required']
        ]);

        $task = $this->taskRepository->find($id);
        if ($task!=null)
        {
            $task->name =  $request->get('name');
            $task->description =  $request->get('description');

            $task = $this->taskRepository->update($task);

            return redirect()->route('task_index');
        }
        else
        {
            return redirect()->route('task_index')->withErrors("Task with id ". $id ." not found");
        }
    }

    public function delete($id)
    {
        $this->taskRepository->delete($id);

        return redirect()->route('task_index');
    }

}
