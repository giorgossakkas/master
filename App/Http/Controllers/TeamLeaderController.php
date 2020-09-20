<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\RoleRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TeamLeaderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $userRepository = new UserRepository();
        $users= $userRepository->findAllBy('is_team_leader','1');

        return view('teamleaders.index',compact("users"));
    }

    public function create()
    {
        $roleRepository = new RoleRepository();
        $roles= $roleRepository->getAll();
        return view('teamleaders.create',compact("roles"));
    }

    public function edit($id)
    {

        $userRepository = new UserRepository();
        $user = $userRepository->find($id);

        $roleRepository = new RoleRepository();
        $roles= $roleRepository->getAll();
        return view('teamleaders.edit',compact("user","roles"));
    }

    public function viewTeam($id)
    {

        $userRepository = new UserRepository();
        $user = $userRepository->find($id);

        $users= $userRepository->findAllBy('team_leader_id',$id);
        return view('teamleaders.team',compact("user","users"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required','unique:users'],
            'email' => ['required','unique:users','email'],
            'role_id' => ['required'],
            'password' => ['required']
        ]);

        $request['password']=Hash::make($request['password']);
        $user = new User($request->all());
        $user->is_team_leader =1;

        $userRepository = new UserRepository();
        $user = $userRepository->create($user);

        return redirect('/teamleaders/index');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'role_id' => ['required']
        ]);

        $userRepository = new UserRepository();

        $user = $userRepository->find($id);

        $user->name =  $request->get('name');
        $user->email =  $request->get('email');
        $user->role_id =  $request->get('role_id');

        $user = $userRepository->update($user);

        return redirect('/teamleaders/index');
    }

    public function delete($id)
    {
        $userRepository = new UserRepository();
        $userRepository->delete($id);

        return redirect('/teamleaders/index');
    }



}
