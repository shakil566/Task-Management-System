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

class TaskInfoController extends Controller
{
    private $controller = "TaskInfo";

    public function __construct()
    {
        $this->middleware('teammate');
    }

    public function index()
    {
        $assignTaskInfo = AssignTask::join('projects', 'projects.id', '=', 'assign_task.project_id')
            ->join('tasks', 'tasks.id', '=', 'assign_task.task_id')
            ->join('users', 'users.id', '=', 'assign_task.user_id')
            ->where('assign_task.user_id', Auth::user()->id)
            // ->where('assign_task.id', $request->task_id)->where('assign_task.project_id', $request->project_id)
            ->select(
                'assign_task.task_id as task_id',
                'assign_task.project_id as project_id',
                'tasks.name as task_name',
                'projects.name as project_name',
                'users.name as user_name',
                'assign_task.status as status',
                'tasks.description as description'
            )
            ->orderBy('task_id', 'desc')
            ->get()
            ->groupBy('project_id');

        $taskList = Task::pluck('name', 'id')->toArray();
        $projectList = Project::pluck('name', 'id')->toArray();

        // load the view and pass the nerds
        return view('admin.taskInfo.index')->with(compact('assignTaskInfo', 'taskList', 'projectList'));
    }


    //Change Task Status
    public function changeTaskStatus(Request $request)
    {
        $taskStatus = AssignTask::where('task_id', $request->task_id)
            ->where('project_id', $request->project_id)->where('user_id', Auth::user()->id);
        if ($request->status == 2) {
            $taskStatus = $taskStatus->update(['status' => '2']);
        }
        if ($request->status == 3) {
            $taskStatus = $taskStatus->update(['status' => '3']);
        }

        if ($taskStatus) {
            return Response::json(['success' => true, 'message' => 'Successfully Change Task Status'], 200);
        } else {
            return Response::json(array('success' => false, 'message' => 'Could not Change Task Status'), 401);
        }
    }
}
