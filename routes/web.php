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

Route::get('roles/index', 'App\Http\Controllers\RoleController@index');
Route::get('roles/create', 'App\Http\Controllers\RoleController@create');
Route::get('roles/{id}/edit', 'App\Http\Controllers\RoleController@edit');
Route::delete('roles/{id}', 'App\Http\Controllers\RoleController@delete');
Route::post('roles/store', 'App\Http\Controllers\RoleController@store');
Route::post('roles/{id}/update', 'App\Http\Controllers\RoleController@update');

Route::get('teamleaders/index', 'App\Http\Controllers\TeamLeaderController@index');
Route::get('teamleaders/create', 'App\Http\Controllers\TeamLeaderController@create');
Route::get('teamleaders/{id}/edit', 'App\Http\Controllers\TeamLeaderController@edit');
Route::get('teamleaders/{id}/team', 'App\Http\Controllers\TeamLeaderController@viewTeam');
Route::delete('teamleaders/{id}', 'App\Http\Controllers\TeamLeaderController@delete');
Route::post('teamleaders/store', 'App\Http\Controllers\TeamLeaderController@store');
Route::post('teamleaders/{id}/update', 'App\Http\Controllers\TeamLeaderController@update');

Route::get('users/index', 'App\Http\Controllers\UserController@index');
Route::get('users/create', 'App\Http\Controllers\UserController@create');
Route::get('users/{id}/edit', 'App\Http\Controllers\UserController@edit');
Route::get('users/{id}/tasks', 'App\Http\Controllers\UserController@showUserTasks');
Route::delete('users/{id}', 'App\Http\Controllers\UserController@delete');
Route::post('users/store', 'App\Http\Controllers\UserController@store');
Route::post('users/{id}/update', 'App\Http\Controllers\UserController@update');

Route::get('tasks/index', 'App\Http\Controllers\TaskController@index');
Route::get('tasks/create', 'App\Http\Controllers\TaskController@create');
Route::get('tasks/{id}/edit', 'App\Http\Controllers\TaskController@edit');
Route::get('tasks/{id}/assign', 'App\Http\Controllers\TaskController@onAssign');
Route::delete('tasks/{id}', 'App\Http\Controllers\TaskController@delete');
Route::post('tasks/store', 'App\Http\Controllers\TaskController@store');
Route::post('tasks/{id}/update', 'App\Http\Controllers\TaskController@update');
Route::post('tasks/{id}/assign', 'App\Http\Controllers\TaskController@assign');
Route::post('tasks/{id}/unassign', 'App\Http\Controllers\TaskController@unassign');
Route::post('tasks/{id}/complete', 'App\Http\Controllers\TaskController@complete');
