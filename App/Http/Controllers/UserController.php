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

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $userRepository = new UserRepository();
        $users= $userRepository->findAllBy('is_team_leader','0');

        return view('users.index',compact("users"));
    }

    public function create()
    {
        $roleRepository = new RoleRepository();
        $roles= $roleRepository->getAll();

        $userRepository = new UserRepository();
        $teamLeaders= $userRepository->findAllBy('is_team_leader','1');

        return view('users.create',compact("roles","teamLeaders"));
    }

    public function edit($id)
    {

        $userRepository = new UserRepository();
        $user = $userRepository->find($id);

        $roleRepository = new RoleRepository();
        $roles= $roleRepository->getAll();

        $userRepository = new UserRepository();
        $teamLeaders= $userRepository->findAllBy('is_team_leader','1');

        return view('users.edit',compact("user","roles","teamLeaders"));
    }

    public function showUserTasks($id)
    {
        $userRepository = new UserRepository();
        $user = $userRepository->find($id);

        $taskRepository = new TaskRepository();
        $tasks= $taskRepository->findAllBy('assign_to_user_id',$user->id);

        return view('users.tasks',compact("user","tasks"));
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

        $userRepository = new UserRepository();
        $user = $userRepository->create($user);

        return redirect('/users/index');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'team_leader_id' => ['required'],
            'role_id' => ['required']
        ]);

        $userRepository = new UserRepository();

        $user = $userRepository->find($id);

        $user->name =  $request->get('name');
        $user->email =  $request->get('email');
        $user->role_id =  $request->get('role_id');
        $user->team_leader_id =  $request->get('team_leader_id');

        $user = $userRepository->update($user);

        return redirect('/users/index');
    }

    public function delete($id)
    {
        $userRepository = new UserRepository();
        $userRepository->delete($id);

        return redirect('/users/index');
    }



}
