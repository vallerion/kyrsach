<?php

$route->get('/', 'PageController@index');

$route->get('object/{id}', 'ObjectController@show');
$route->get('objects', 'ObjectController@index');
$route->get('objects/add', 'ObjectController@add');
$route->get('objects/add/select-row', 'ObjectController@getSelectRow');
$route->post('objects/add', 'ObjectController@create');
$route->get('download/{id}', 'ObjectController@download');

$route->get('author/{id}', 'AuthorController@show');

$route->get('login', 'AuthController@getLogin');
$route->post('login', 'AuthController@login');
$route->get('logout', 'AuthController@getLogout');
$route->get('registration', 'AuthController@getRegistration');
$route->post('registration', 'AuthController@registration');