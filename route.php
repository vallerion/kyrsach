<?php

$route->get('/', 'PageController@index');

$route->get('object/{id}', 'ObjectController@show');
$route->get('objects', 'ObjectController@index');
$route->get('download/{id}', 'ObjectController@download');

$route->get('login', 'AuthController@getLogin');
$route->post('login', 'AuthController@login');
$route->get('logout', 'AuthController@getLogout');
$route->get('registration', 'AuthController@getRegistration');
$route->post('registration', 'AuthController@registration');