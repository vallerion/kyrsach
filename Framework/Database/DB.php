<?php


namespace Framework\Database;

use Framework\Database\Connection\Connection;
use Framework\Traits\Singleton;
use Framework\Database\Connection\ConnectionPool;

class DB {

    use Singleton;

    protected static $connectionPool;

    protected static $currentConnection;

    protected function __construct() {
        static::$connectionPool = ConnectionPool::getInstance();
    }


    public static function pushConnection($nameConnection, $driver, $host, $port, $database, $user, $write = true, $read = true) {

        list($user, $password) = explode(':', $user);

        static::$connectionPool[$nameConnection] = new Database(
            $driver,
            $host,
            $port,
            $database,
            $user,
            $password
        );

        static::connection($nameConnection);
    }

    public static function connection($name = null) {
        if( ! is_null($name) && isset(static::$connectionPool[$name]))
            static::$currentConnection = static::$connectionPool[$name];

        return static::$instance;
    }

    public static function query($query, $class = null) {
        return static::$currentConnection->raw($query)->all($class);
    }


}