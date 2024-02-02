<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use URL;
use Redirect;
use Helper;
use Validator;
use Response;
use Session;
use App\Models\Project;

class ProjectController extends Controller
{
    private $controller = "Project";

    public function __construct()
    {
        $this->middleware('manager');
    }

    public function index()
    {
        $projectArr = Project::orderBy('id', 'desc')->get();
        // load the view and pass the nerds
        return view('admin.project.index')->with(compact('projectArr'));
    }

    public function create(Request $request)
    {
        return view('admin.project.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'code' => 'required|Unique:projects',
        );

        $message = array(
            'name.required' => 'Please give the project name!',
            'code.unique' => 'That project is already taken',
        );

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return Redirect::to('admin/project/create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $project = new Project();
        $project->name = $request->name;
        $project->code =  $request->code;
        $project->status =  $request->status;
        if ($project->save()) {
            Session::flash('success',  $request->name . trans('english.HAS_BEEN_CREATED_SUCCESSFULLY'));
            return Redirect::to('admin/project');
        } else {
            Session::flash('error',  $request->name . trans('english.COULD_NOT_BE_CREATED_SUCCESSFULLY'));
            return Redirect::to('admin/project/create');
        }
    }

    public function edit($id)
    {
        // get the project
        $project = Project::find($id);

        // show the edit form and pass the project
        return view('admin.project.edit')->with(compact('project'));
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required',
            'code' => 'required|unique:projects,code,' . $id,
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('admin/project/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput($request->all());
        } else {
            // store
            $project = Project::find($id);

            $project->name = $request->name;
            $project->code =  $request->code;
            $project->status =  $request->status;
            $result = $project->save();

            // redirect
            if ($result === TRUE) {
                Session::flash('success', $request->name . trans('english.HAS_BEEN_UPDATED_SUCCESSFULLY'));
                return Redirect::to('admin/project');
            } else {
                Session::flash('error', $request->name . trans('english.COULD_NOT_BE_UPDATED'));
                return Redirect::to('admin/project/' . $id . '/edit');
            }
        }
    }

    public function destroy(Request $request, $id)
    {

        $project = Project::find($id);

        //Check Dependency before deletion

        $dependencyArr = ['Task' => 'project_id'];


        foreach ($dependencyArr as $model => $key) {
            $namespacedModel = '\\App\\Models\\' . $model;
            $dependentData = $namespacedModel::where($key, $id)->first();
            if (!empty($dependentData)) {
                Session::flash('error', __('english.COULD_NOT_DELETE_DATA_HAS_RELATION_WITH_MODEL') . $model);
                return redirect('admin/project');
            }
        }


        if ($project->delete()) {
            Session::flash('error', $project->name . trans('english.HAS_BEEN_DELETED_SUCCESSFULLY'));
            return Redirect::to('admin/project');
        } else {
            Session::flash('error', $project->name . trans('english.COULD_NOT_BE_DELETED'));
            return Redirect::to('admin/project');
        }
    }
}
