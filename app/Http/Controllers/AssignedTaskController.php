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

    public function index(Request $request)
    {
        $assignTaskInfo = AssignTask::join('projects', 'projects.id', '=', 'assign_task.project_id')
            ->join('tasks', 'tasks.id', '=', 'assign_task.task_id')
            ->join('users', 'users.id', '=', 'assign_task.user_id');


        //begin filtering
        $searchText = $request->search_text;

        if (!empty($searchText)) {
            $assignTaskInfo->where(function ($query) use ($searchText) {
                $query->where('users.name', 'LIKE', '%' . $searchText . '%');
            });
        }

        if (!empty($request->project_id)) {
            $assignTaskInfo = $assignTaskInfo->where('assign_task.project_id', $request->project_id);
        }
        if (!empty($request->task_id)) {
            $assignTaskInfo = $assignTaskInfo->where('assign_task.task_id', $request->task_id);
        }
        if (!empty($request->status)) {
            $assignTaskInfo = $assignTaskInfo->where('assign_task.status', $request->status);
        }
        //end filtering

        $assignTaskInfo = $assignTaskInfo->select(
            'assign_task.task_id as task_id',
            'assign_task.project_id as project_id',
            'tasks.name as task_name',
            'projects.name as project_name',
            'users.name as user_name',
            'assign_task.status as status',
            'tasks.description as description'
        )
            ->get()
            ->groupBy('task_id');

        $taskList = Task::pluck('name', 'id')->toArray();
        $projectList = Project::pluck('name', 'id')->toArray();
        $statusList = ['' => __('english.SELECT_STATUS'), '1' => __('english.PENDING'), '2' => __('english.WORKING'), '3' => __('english.DONE')];
        $taskFilterList = ['' => __('english.SELECT_TASK')] + $taskList;
        $projectFilterList = ['' => __('english.SELECT_PROJECT')] + $projectList;

        // load the view and pass the value
        $taskFilterList = ['' => __('english.SELECT_TASK')] + $taskList;
        return view('admin.assignedTask.index')->with(compact('assignTaskInfo', 'taskList', 'projectList', 'statusList', 'taskFilterList', 'projectFilterList'));
    }


    public function filter(Request $request)
    {
        $url = 'search_text=' . $request->search_text . '&project_id=' . $request->project_id . '&task_id='
            . $request->task_id . '&status=' . $request->status;
        return Redirect::to('admin/assignedTask?' . $url);
    }
}
