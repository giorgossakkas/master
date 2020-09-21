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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('roles/index',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@index']);
Route::get('roles/create',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@create']);
Route::get('roles/{id}/edit',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@edit']);
Route::delete('roles/{id}',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@delete']);
Route::post('roles/store',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@store']);
Route::post('roles/{id}/update',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_ROLES', 'uses' => 'App\Http\Controllers\RoleController@update']);

Route::get('teamleaders/index',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@index']);
Route::get('teamleaders/create',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@create']);
Route::get('teamleaders/{id}/edit',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@edit']);
Route::get('teamleaders/{id}/team',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@viewTeam']);
Route::delete('teamleaders/{id}',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@delete']);
Route::post('teamleaders/store',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@store']);
Route::post('teamleaders/{id}/update',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TEAM_LEADERS', 'uses' => 'App\Http\Controllers\TeamLeaderController@update']);

Route::get('users/index',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@index']);
Route::get('users/create',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@create']);
Route::get('users/{id}/edit',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@edit']);
Route::get('users/{id}/tasks',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@showUserTasks']);
Route::delete('users/{id}',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@delete']);
Route::post('users/store',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@store']);
Route::post('users/{id}/update',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_USERS', 'uses' => 'App\Http\Controllers\UserController@update']);

Route::get('tasks/index',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@index']);
Route::get('tasks/create',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@create']);
Route::get('tasks/{id}/edit',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@edit']);
Route::get('tasks/{id}/assign',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@onAssign']);
Route::delete('tasks/{id}',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@delete']);
Route::post('tasks/store',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@store']);
Route::post('tasks/{id}/update',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@update']);
Route::post('tasks/{id}/assign',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@assign']);
Route::post('tasks/{id}/unassign',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:MANAGE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@unassign']);
Route::post('tasks/{id}/complete',[ 'middleware' => 'App\Http\Middleware\RoleMiddleware:COMPLETE_TASKS', 'uses' => 'App\Http\Controllers\TaskController@complete']);
