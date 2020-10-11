<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\RoleRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TeamLeaderController extends Controller
{
    private $roleRepository;
    private $userRepository;

    public function __construct()
    {
        $this->roleRepository = app(RoleRepository::class);
        $this->userRepository = app(UserRepository::class);
    }


    public function index()
    {
        $users= $this->userRepository->findAllBy('is_team_leader','1');

        return view('teamleaders.index',compact("users"));
    }

    public function create()
    {
        $roles= $this->roleRepository->getAll();
        return view('teamleaders.create',compact("roles"));
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        if ($user!=null)
        {
            $roles= $this->roleRepository->getAll();
            return view('teamleaders.edit',compact("user","roles"));
        }
        else
        {
            return redirect()->route('teamleader_index')->withErrors("Team leader with id ". $id ." not found");
        }
    }

    public function viewTeam($id)
    {
        $user = $this->userRepository->find($id);
        if ($user!=null)
        {
            $users= $this->userRepository->findAllBy('team_leader_id',$id);
            return view('teamleaders.team',compact("user","users"));
        }
        else
        {
            return redirect()->route('teamleader_index')->withErrors("Team leader with id ". $id ." not found");
        }
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

        $user = $this->userRepository->create($user);

        return redirect()->route('teamleader_index');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'role_id' => ['required']
        ]);

        $user = $this->userRepository->find($id);
        if ($user!=null)
        {
            $user->name =  $request->get('name');
            $user->email =  $request->get('email');
            $user->role_id =  $request->get('role_id');

            $user = $this->userRepository->update($user);

            return redirect()->route('teamleader_index');
        }
        else
        {
            return redirect()->route('teamleader_index')->withErrors("Team leader with id ". $id ." not found");
        }
    }

    public function delete($id)
    {
        $this->userRepository->delete($id);

        return redirect()->route('teamleader_index');
    }



}
