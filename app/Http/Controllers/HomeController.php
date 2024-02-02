<?php

namespace App\Http\Controllers;

use App\Models\AssignTask;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
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
        $totalTaskC = $pendingTaskC = $workingTaskC = $taskDoneC = $teammatesCount = $projectCount = $taskCount = 0;
        $teammatesCount = User::where('user_group_id', '2')->where('status', '1')->count();
        $projectCount = Project::where('status', '1')->count();
        $taskCount = Task::where('status', '1')->count();

        if (Auth::user()->user_group_id == 2) {
            $totalTaskC = AssignTask::where('user_id', Auth::user()->id)->count();
            $pendingTaskC = AssignTask::where('user_id', Auth::user()->id)->where('status', '1')->count();
            $workingTaskC = AssignTask::where('user_id', Auth::user()->id)->where('status', '2')->count();
            $taskDoneC = AssignTask::where('user_id', Auth::user()->id)->where('status', '3')->count();
        }
        return view('admin.dashboard')->with(compact('teammatesCount', 'projectCount', 'taskCount', 'totalTaskC', 'pendingTaskC', 'workingTaskC', 'taskDoneC'));
    }
}
