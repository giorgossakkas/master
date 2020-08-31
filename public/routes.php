<?php

$router->get('','LoginController@index');
$router->get('index','IndexController@index');
$router->get('users/create','UserController@create');
$router->get('users/register','UserController@register');
$router->get('users/{id}/edit','UserController@edit');
$router->get('users/{id}/delete','UserController@delete');
$router->get('users/{id}/tasks','UserController@showUserTasks');
$router->post('users/created','UserController@store');
$router->post('users/{id}/update','UserController@update');
$router->post('users/registered','UserController@createRegister');

$router->get('tasks/create','TaskController@create');
$router->get('tasks/{id}/edit','TaskController@edit');
$router->get('tasks/{id}/delete','TaskController@delete');
$router->get('tasks/{id}/complete','TaskController@complete');
$router->get('tasks/{id}/assign','TaskController@assign');
$router->post('tasks/created','TaskController@store');
$router->post('tasks/{id}/update','TaskController@update');
$router->post('tasks/{id}/assigned','TaskController@storeAssignTask');

$router->post('login','LoginController@login');
$router->get('logout','LoginController@logout');
