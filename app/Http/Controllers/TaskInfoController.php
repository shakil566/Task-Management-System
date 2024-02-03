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

    public function index(Request $request)
    {
        $assignTaskInfo = AssignTask::join('projects', 'projects.id', '=', 'assign_task.project_id')
            ->join('tasks', 'tasks.id', '=', 'assign_task.task_id')
            ->join('users', 'users.id', '=', 'assign_task.user_id')
            ->where('assign_task.user_id', Auth::user()->id);

        //begin filtering
        $searchText = $request->search_text;

        if (!empty($searchText)) {
            $assignTaskInfo->where(function ($query) use ($searchText) {
                $query->orWhere('projects.name', 'LIKE', '%' . $searchText . '%');
                $query->orWhere('tasks.name', 'LIKE', '%' . $searchText . '%');
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
            ->orderBy('task_id', 'desc')
            ->get()
            ->groupBy('project_id');

        $taskList = Task::pluck('name', 'id')->toArray();
        $projectList = Project::pluck('name', 'id')->toArray();
        $statusList = ['' => __('english.SELECT_STATUS'), '1' => __('english.PENDING'), '2' => __('english.WORKING'), '3' => __('english.DONE')];
        $taskFilterList = ['' => __('english.SELECT_TASK')] + $taskList;
        $projectFilterList = ['' => __('english.SELECT_PROJECT')] + $projectList;

        // load the view and pass the value
        return view('admin.taskInfo.index')->with(compact('assignTaskInfo', 'taskList', 'projectList', 'statusList', 'taskFilterList', 'projectFilterList'));
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



    public function filter(Request $request)
    {
        $url = 'search_text=' . $request->search_text . '&project_id=' . $request->project_id . '&task_id='
            . $request->task_id . '&status=' . $request->status;
        return Redirect::to('admin/taskInfo?' . $url);
    }
}
