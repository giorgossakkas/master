<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\TaskRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    private $roleRepository;
    private $userRepository;
    private $taskRepository;

    public function __construct()
    {
        $this->taskRepository = app(TaskRepository::class);
        $this->userRepository = app(UserRepository::class);
        $this->roleRepository = app(RoleRepository::class);
    }


    public function index()
    {
        $users= $this->userRepository->findAllBy('is_team_leader','0');

        return view('users.index',compact("users"));
    }

    public function create()
    {
        $roles= $this->roleRepository->getAll();

        $teamLeaders= $this->userRepository->findAllBy('is_team_leader','1');

        return view('users.create',compact("roles","teamLeaders"));
    }

    public function edit($id)
    {

        $user = $this->userRepository->find($id);
        if ($user!=null)
        {
            $roles= $this->roleRepository->getAll();

            $teamLeaders= $this->userRepository->findAllBy('is_team_leader','1');

            return view('users.edit',compact("user","roles","teamLeaders"));
        }
        else
        {
            return redirect()->route('user_index')->withErrors("User with id ". $id ." not found");
        }
    }

    public function showUserTasks($id)
    {
        $user = $this->userRepository->find($id);
        if ($user!=null)
        {
            $tasks= $this->taskRepository->findAllBy('assign_to_user_id',$user->id);

            return view('users.tasks',compact("user","tasks"));
        }
        else
        {
            return redirect()->route('home')->withErrors("User with id ". $id ." not found");
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required','unique:users'],
            'email' => ['required','unique:users','email'],
            'role_id' => ['required'],
            'team_leader_id' => ['required'],
            'password' => ['required']
        ]);

        $request['password']=Hash::make($request['password']);
        $user = new User($request->all());
        $user->is_team_leader =0;

        $user = $this->userRepository->create($user);

        return redirect()->route('user_index');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'team_leader_id' => ['required'],
            'role_id' => ['required']
        ]);

        $user = $this->userRepository->find($id);
        if ($user!=null)
        {
            $user->name =  $request->get('name');
            $user->email =  $request->get('email');
            $user->role_id =  $request->get('role_id');
            $user->team_leader_id =  $request->get('team_leader_id');

            $user = $this->userRepository->update($user);

            return redirect()->route('user_index');
        }
        else
        {
            return redirect()->route('user_index')->withErrors("User with id ". $id ." not found");
        }
    }

    public function delete($id)
    {
        $this->userRepository->delete($id);

        return redirect()->route('user_index');
    }



}
