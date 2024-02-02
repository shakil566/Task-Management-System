<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AssignTask;
use App\Models\Project;
use Illuminate\Http\Request;
use Auth;
use DB;
use URL;
use Redirect;
use Helper;
use Validator;
use Response;
use Session;
use App\Models\Task;
use App\Models\User;

class AssignedTaskController extends Controller
{
    private $controller = "AssignedTask";

    public function __construct()
    {
        $this->middleware('manager');
    }

    public function index()
    {
        $assignTaskInfo = AssignTask::join('projects', 'projects.id', '=', 'assign_task.project_id')
            ->join('tasks', 'tasks.id', '=', 'assign_task.task_id')
            ->join('users', 'users.id', '=', 'assign_task.user_id')
            // ->where('assign_task.id', $request->task_id)->where('assign_task.project_id', $request->project_id)
            ->select('assign_task.task_id as task_id', 'assign_task.project_id as project_id', 'tasks.name as task_name'
            , 'projects.name as project_name', 'users.name as user_name', 'assign_task.status as status'
            , 'tasks.description as description')
            ->get()
            ->groupBy('task_id');

            $taskList = Task::pluck('name', 'id')->toArray();
            $projectList = Project::pluck('name', 'id')->toArray();

            // echo '<pre>';
            // print_r($assignTaskInfo);
            // exit;
        // return $assignTaskInfo;
        // load the view and pass the nerds
        return view('admin.assignedTask.index')->with(compact('assignTaskInfo', 'taskList', 'projectList'));
    }

}
