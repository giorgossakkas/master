<?php

$router->get('','LoginController@index','');
$router->get('index','IndexController@index','');

$router->get('users/create','UserController@create','MANAGE_USERS');
$router->get('users/index','UserController@index','MANAGE_USERS');
$router->get('users/register','UserController@register','');
$router->get('users/{id}/edit','UserController@edit','MANAGE_USERS');
$router->get('users/{id}/delete','UserController@delete','MANAGE_USERS');
$router->get('users/{id}/tasks','UserController@showUserTasks','');
$router->post('users/created','UserController@store','MANAGE_USERS');
$router->post('users/{id}/update','UserController@update','MANAGE_USERS');
$router->post('users/registered','UserController@createRegister','');

$router->get('tasks/create','TaskController@create','MANAGE_TASKS');
$router->get('tasks/index','TaskController@index','MANAGE_TASKS');
$router->get('tasks/{id}/edit','TaskController@edit','MANAGE_TASKS');
$router->get('tasks/{id}/delete','TaskController@delete','MANAGE_TASKS');
$router->get('tasks/{id}/complete','TaskController@complete','COMPLETE_TASKS');
$router->get('tasks/{id}/assign','TaskController@assign','MANAGE_TASKS');
$router->get('tasks/{id}/unassign','TaskController@unassign','MANAGE_TASKS');
$router->post('tasks/created','TaskController@store','MANAGE_TASKS');
$router->post('tasks/{id}/update','TaskController@update','MANAGE_TASKS');
$router->post('tasks/{id}/assigned','TaskController@storeAssignTask','MANAGE_TASKS');

$router->get('roles/index','RoleController@index','MANAGE_ROLES');
$router->get('roles/create','RoleController@create','MANAGE_ROLES');
$router->get('roles/{id}/edit','RoleController@edit','MANAGE_ROLES');
$router->get('roles/{id}/delete','RoleController@delete','MANAGE_ROLES');
$router->post('roles/created','RoleController@store','MANAGE_ROLES');
$router->post('roles/{id}/update','RoleController@update','MANAGE_ROLES');

$router->get('leaders/index','TeamLeaderController@index','MANAGE_TEAM_LEADERS');
$router->get('leaders/create','TeamLeaderController@create','MANAGE_TEAM_LEADERS');
$router->get('leaders/{id}/edit','TeamLeaderController@edit','MANAGE_TEAM_LEADERS');
$router->get('leaders/{id}/team','TeamLeaderController@viewTeamMembers','');
$router->get('leaders/{id}/delete','TeamLeaderController@delete','MANAGE_TEAM_LEADERS');
$router->post('leaders/created','TeamLeaderController@store','MANAGE_TEAM_LEADERS');
$router->post('leaders/{id}/update','TeamLeaderController@update','MANAGE_TEAM_LEADERS');

$router->post('login','LoginController@login','');
$router->get('logout','LoginController@logout','');
$router->get('forbidden','ForbiddenController@forbidden','');
