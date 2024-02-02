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

class TaskController extends Controller
{
    private $controller = "Task";

    public function __construct()
    {
        $this->middleware('manager');
    }

    public function index()
    {
        $taskArr = Task::with(array('Project'));
        $taskArr = $taskArr->orderBy('tasks.id', 'desc')->get();
        // load the view and pass the nerds
        return view('admin.task.index')->with(compact('taskArr'));
    }

    public function create(Request $request)
    {

        //get project list
        $projectList = Project::orderBy('id')->where('status', '=', 1)->pluck('name', 'id')->toArray();
        $projectList = array('' => '--Select Project--') + $projectList;

        return view('admin.task.create')->with(compact('projectList'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'project_id' => 'required|not_in:0',
        );

        $message = array(
            'name.required' => 'Please give the task name!',
            'description.required' => 'Please give the task description!',
            'project_id.required' => 'Please select project!',
        );

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return Redirect::to('admin/task/create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $task = new Task();
        $task->name = $request->name;
        $task->project_id = $request->project_id;
        $task->description =  $request->description;
        $task->status =  $request->status;
        if ($task->save()) {
            Session::flash('success',  $request->name . trans('english.HAS_BEEN_CREATED_SUCCESSFULLY'));
            return Redirect::to('admin/task');
        } else {
            Session::flash('error',  $request->name . trans('english.COULD_NOT_BE_CREATED_SUCCESSFULLY'));
            return Redirect::to('admin/task/create');
        }
    }

    public function edit($id)
    {
        $task = Task::find($id);

        //get project list
        $projectList = Project::orderBy('id')->where('status', '=', 1)->pluck('name', 'id')->toArray();
        $projectList = array('' => '--Select Project--') + $projectList;

        // show the edit form and pass the task
        return view('admin.task.edit')->with(compact('task', 'projectList'));
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'project_id' => 'required|not_in:0',
        );

        $message = array(
            'name.required' => 'Please give the task name!',
            'description.required' => 'Please give the task description!',
            'project_id.required' => 'Please select project!',
        );

        $validator = Validator::make($request->all(), $rules, $message);


        if ($validator->fails()) {

            return Redirect::to('admin/task/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput($request->all());
        } else {
            // store
            $task = Task::find($id);

            $task->name = $request->name;
            $task->project_id = $request->project_id;
            $task->description =  $request->description;
            $task->status =  $request->status;
            $result = $task->save();

            // redirect
            if ($result === TRUE) {
                Session::flash('success', $request->name . trans('english.HAS_BEEN_UPDATED_SUCCESSFULLY'));
                return Redirect::to('admin/task');
            } else {
                Session::flash('error', $request->name . trans('english.COULD_NOT_BE_UPDATED'));
                return Redirect::to('admin/task/' . $id . '/edit');
            }
        }
    }

    public function destroy(Request $request, $id)
    {

        $task = Task::find($id);

        if ($task->delete()) {
            Session::flash('error', $task->name . trans('english.HAS_BEEN_DELETED_SUCCESSFULLY'));
            return Redirect::to('admin/task');
        } else {
            Session::flash('error', $task->name . trans('english.COULD_NOT_BE_DELETED'));
            return Redirect::to('admin/task');
        }
    }


    public function assignTask(Request $request)
    {
        // dd($request->all());
        $taskInfo = Task::join('projects', 'projects.id', '=', 'tasks.project_id')
            ->where('tasks.id', $request->task_id)->where('tasks.project_id', $request->project_id)
            ->select('tasks.id', 'tasks.project_id', 'tasks.name as task_name', 'projects.name as project_name', 'projects.code as project_code')
            ->first();
        $assignedTaskInfo = AssignTask::where('task_id', $request->task_id)->where('project_id', $request->project_id)->pluck('user_id')->toArray();

        $userList = User::where('status', '1')->where('user_group_id', '2')->pluck('name', 'id')->toArray();
        // dd($assignedTaskInfo);
        $view = view('admin.task.assignTask', compact('taskInfo', 'userList', 'assignedTaskInfo'))->render();
        return response()->json(['html' => $view]);
    }
    public function saveAssigntask(Request $request)
    {
        // dd($request->all());

        $rules = [];
        // $rules['user_id'] = 'required';
        $message = array(
            // 'user_id.required' => 'Please select teammates!',
        );
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return Response::json(array('success' => false, 'heading' => 'Validation Error', 'message' => $validator->errors()), 400);
        }



        try {
            DB::beginTransaction();

            $prevInfo = AssignTask::where('task_id', $request->task_id)->where('project_id', $request->project_id)->get();
            if (!$prevInfo->isEmpty()) {
                AssignTask::where('task_id', $request->task_id)->where('project_id', $request->project_id)->delete();
                // dd($deletePrevInfo);
            }

            //task assign
            $i = 1;
            $data = [];
            if (!empty($request->user_id)) {
                foreach ($request->user_id as $userId) {
                    $target = new AssignTask;
                    $data[$i]['project_id'] = $request->project_id;
                    $data[$i]['task_id'] = $request->task_id;
                    $data[$i]['user_id'] = $userId;
                    $data[$i]['created_by'] = Auth::user()->id ?? 1;
                    $i++;
                }
                $target->insert($data);
            }

            // Commit the transaction

            DB::commit();
            return Response::json(['success' => true, 'message' => 'Successfully Task Assigned'], 200);
        } catch (\Exception $e) {

            // An error occured; cancel the transaction...
            throw $e;
            DB::rollback();
            // and throw the error again.
            return Response::json(array('success' => false, 'message' => 'Could not Task Assigned'), 401);
        }
    }
}
