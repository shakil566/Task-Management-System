<?php

use App\Http\Controllers\AssignedTaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskInfoController;
use App\Http\Controllers\TeammatesController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Teammate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'perform'])->name('logout.perform');

Auth::routes();


Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // :::::::: Start User Route ::::::::::::::

    Route::get('admin/users/profile/', function () {
        return View::make('admin/users/user_profile');
    });
    Route::post('admin/users/editProfile/', [UsersController::class, 'editProfile']);
    Route::resource('admin/users', UsersController::class, ['except' => ['show']]);
    Route::get('admin/users/activate/{id}/{param?}', [UsersController::class, 'active']);

    // :::::::: End User Route ::::::::::::::


    // :::::::: Start Teammates Route ::::::::::::::

    Route::resource('admin/teammates', TeammatesController::class, ['except' => ['show']]);
    Route::get('admin/teammates/activate/{id}/{param?}', [TeammatesController::class, 'active']);

    // :::::::: End Teammates Route ::::::::::::::


    
    // UserGroupController all routes
    Route::post('admin/userGroup/filter/', [UserGroupController::class, 'filter']);
    Route::get('admin/userGroup', [UserGroupController::class, 'index'])->name('userGroup.index');
    Route::get('admin/userGroup/create', [UserGroupController::class, 'create'])->name('userGroup.create');
    Route::post('admin/userGroup', [UserGroupController::class, 'store'])->name('userGroup.store');
    Route::get('admin/userGroup/{id}/edit', [UserGroupController::class, 'edit'])->name('userGroup.edit');
    Route::patch('admin/userGroup/{id}', [UserGroupController::class, 'update'])->name('userGroup.update');
    Route::delete('admin/userGroup/{id}', [UserGroupController::class, 'destroy'])->name('userGroup.destroy');

    // ProjectController all routes
    Route::post('admin/project/filter/', [ProjectController::class, 'filter']);
    Route::get('admin/project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('admin/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('admin/project', [ProjectController::class, 'store'])->name('project.store');
    Route::get('admin/project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::patch('admin/project/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('admin/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');

    // TaskController all routes
    Route::get('admin/task', [TaskController::class, 'index'])->name('task.index');
    Route::get('admin/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('admin/task', [TaskController::class, 'store'])->name('task.store');
    Route::get('admin/task/{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::patch('admin/task/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('admin/task/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::post('admin/task/assigntask', [TaskController::class, 'assignTask'])->name('task.assignTask');
    Route::post('admin/task/saveAssigntask', [TaskController::class, 'saveAssigntask'])->name('task.saveAssigntask');
    Route::post('admin/task/filter/', [TaskController::class, 'filter']);

    Route::post('admin/assignedTask/filter/', [AssignedTaskController::class, 'filter']);
    Route::get('admin/assignedTask', [AssignedTaskController::class, 'index'])->name('assignedTask.index');

    Route::post('admin/taskInfo/filter/', [TaskInfoController::class, 'filter']);
    Route::get('admin/taskInfo', [TaskInfoController::class, 'index'])->name('taskInfo.index');
    Route::post('admin/taskinfo/changeStatus', [TaskInfoController::class, 'changeTaskStatus'])->name('taskInfo.changeTaskStatus');

});

Route::get('/{pathMatch}', function(){
    return redirect('/login');
})->where('pathMatch', ".*");
