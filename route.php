<?php

$route->get('/', 'PageController@index');

$route->get('object/{id}', 'ObjectController@show');
$route->get('objects', 'ObjectController@index');
$route->get('objects/add', 'ObjectController@add');
$route->get('objects/add/select-row', 'ObjectController@getSelectRow');
$route->post('objects/add', 'ObjectController@create');
$route->get('objects/search', 'ObjectController@getSearch');
$route->post('objects/search', 'ObjectController@search');
$route->get('download/{id}', 'ObjectController@download');

$route->get('author/{id}', 'AuthorController@show');
$route->get('authors', 'AuthorController@index');
$route->get('authors/add', 'AuthorController@add');
$route->post('authors/add', 'AuthorController@create');
$route->get('authors/search', 'AuthorController@getSearch');
$route->post('authors/search', 'AuthorController@search');

$route->get('roles', 'RoleController@index');
$route->get('roles/add', 'RoleController@add');
$route->post('roles/add', 'RoleController@create');
$route->post('role/{id}/delete', 'RoleController@delete');

$route->get('users', 'UserController@index');
$route->get('profile/{id}', 'UserController@show');

$route->get('login', 'AuthController@getLogin');
$route->post('login', 'AuthController@login');
$route->get('logout', 'AuthController@getLogout');
$route->get('registration', 'AuthController@getRegistration');
$route->post('registration', 'AuthController@registration');