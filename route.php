<?php

$route->get('/', 'PageController@index');

$route->get('object/{id}', 'ObjectController@show');
$route->get('objects', 'ObjectController@index');
$route->get('download/{id}', 'ObjectController@download');
$route->get('login', 'AuthController@getLogin');
$route->post('login', 'AuthController@login');