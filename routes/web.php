<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  Route::get('roles/index',[ 'middleware' => 'role:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@index'])->name('role_index');
  Route::get('roles/create',[ 'middleware' => 'role:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@create'])->name('role_create');
  Route::get('roles/{id}/edit',[ 'middleware' => 'role:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@edit'],function ($id) {})->name('role_edit');
  Route::delete('roles/{id}',[ 'middleware' => 'role:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@delete'],function ($id) {})->name('role_delete');
  Route::post('roles/store',[ 'middleware' => 'role:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@store'])->name('role_store');
  Route::post('roles/{id}/update',[ 'middleware' => 'role:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@update'],function ($id) {})->name('role_update');

  Route::get('teamleaders/index',[ 'middleware' => 'role:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@index'])->name('teamleader_index');
  Route::get('teamleaders/create',[ 'middleware' => 'role:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@create'])->name('teamleader_create');
  Route::get('teamleaders/{id}/edit',[ 'middleware' => 'role:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@edit'],function ($id) {})->name('teamleader_edit');
  Route::get('teamleaders/{id}/team',[ 'middleware' => 'role:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@viewTeam'],function ($id) {})->name('teamleader_view_team');
  Route::delete('teamleaders/{id}',[ 'middleware' => 'role:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@delete'],function ($id) {})->name('teamleader_delete');
  Route::post('teamleaders/store',[ 'middleware' => 'role:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@store'])->name('teamleader_store');
  Route::post('teamleaders/{id}/update',[ 'middleware' => 'role:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@update'],function ($id) {})->name('teamleader_update');

  Route::get('users/index',[ 'middleware' => 'role:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@index'])->name('user_index');
  Route::get('users/create',[ 'middleware' => 'role:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@create'])->name('user_create');
  Route::get('users/{id}/edit',[ 'middleware' => 'role:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@edit'],function ($id) {})->name('user_edit');
  Route::get('users/{id}/tasks',[ 'middleware' => 'role:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@showUserTasks',function ($id) {}])->name('user_show_user_tasks');
  Route::delete('users/{id}',[ 'middleware' => 'role:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@delete'],function ($id) {})->name('user_delete');
  Route::post('users/store',[ 'middleware' => 'role:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@store'])->name('user_store');
  Route::post('users/{id}/update',[ 'middleware' => 'role:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@update'],function ($id) {})->name('user_update');

  Route::get('tasks/index',[ 'middleware' => 'role:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@index'])->name('task_index');
  Route::get('tasks/create',[ 'middleware' => 'role:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@create'])->name('task_create');
  Route::get('tasks/{id}/edit',[ 'middleware' => 'role:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@edit'],function ($id) {})->name('task_edit');
  Route::get('tasks/{id}/assign',[ 'middleware' => 'role:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@onAssign'],function ($id) {})->name('task_on_assign');
  Route::delete('tasks/{id}',[ 'middleware' => 'role:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@delete'],function ($id) {})->name('task_delete');
  Route::post('tasks/store',[ 'middleware' => 'role:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@store'])->name('task_store');
  Route::post('tasks/{id}/update',[ 'middleware' => 'role:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@update'],function ($id) {})->name('task_update');
  Route::post('tasks/{id}/assign',[ 'middleware' => 'role:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@assign'],function ($id) {})->name('task_assign');
  Route::post('tasks/{id}/unassign',[ 'middleware' => 'role:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@unassign'],function ($id) {})->name('task_unassign');
  Route::post('tasks/{id}/complete',[ 'middleware' => 'role:COMPLETE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@complete'],function ($id) {})->name('task_complete');
});
