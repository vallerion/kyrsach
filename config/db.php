<?php

return [

    'guest' => [
        'mode' => 'write|read',
        'driver' => 'pgsql',
        'host' => 'localhost',
        'port' => '5432',
        'database' => 'vallerion',
        'username' => 'guest',
        'password' => '123',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
    ],

    'admin' => [
        'mode' => 'write|read',
        'driver' => 'pgsql',
        'host' => 'localhost',
        'port' => '5432',
        'database' => 'vallerion',
        'username' => 'admin',
        'password' => '123',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
    ],

    'user' => [
        'mode' => 'write|read',
        'driver' => 'pgsql',
        'host' => 'localhost',
        'port' => '5432',
        'database' => 'vallerion',
        'username' => 'user',
        'password' => '123',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
    ],

    
];
