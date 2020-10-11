<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\TaskRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private $taskRepository;
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->taskRepository = app(TaskRepository::class);
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();

        $tasks= $this->taskRepository->findAllBy('assign_to_user_id',$user->id);
        $teamMembers= $this->userRepository->findAllBy('team_leader_id',$user->id);

        return view('home',compact("tasks","teamMembers"));
    }
}
