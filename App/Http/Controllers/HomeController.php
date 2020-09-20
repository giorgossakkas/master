<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\TaskRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $taskRepository = new TaskRepository();
        $user = Auth::user();
        $tasks= $taskRepository->findAllBy('assign_to_user_id',$user->id);

        $userRepository = new UserRepository();
        $teamMembers= $userRepository->findAllBy('team_leader_id',$user->id);

        return view('home',compact("tasks","teamMembers"));
    }
}
