<?php

namespace Framework\App;

use Framework\Http\Request;
use Framework\Traits\Singleton;
use Framework\Database\DB;
use Framework\Database\Table;
use Framework\Model\Auth as AuthModel;

class Auth {

    use Singleton;

    protected static $user = null;

    protected static $auth;

    protected function __construct($sessionName) {
        session_start();

        static::$auth = new AuthModel();
    }

    public static function login($email, $password) {
        if(static::check())
            return static::user();

        $user = static::$auth->login($email, $password);
        if(is_null($user))
            return null;

        static::$user = $user;
        $session = md5($user->id . time());
        static::$auth->saveHash($user->id, $session);
        setcookie('onion_id', $session, time() + 7776000, '/');

        return static::user();
    }

    public static function user() {
        return static::$user;
    }

    public static function logout() {
        setcookie('onion_id', '', time() - 3600, '/');
    }

    public static function check() {
        if( ! is_null(static::$user))
            return true;

        $session = isset($_COOKIE['onion_id']) && ! empty($_COOKIE['onion_id']) ?
                    $_COOKIE['onion_id'] : 
                    false;

        if( ! $session)
            return false;
        
        $user = static::$auth->loginByHash($session);

        if( ! is_null($user)) {
            static::$user = $user;
            return true;
        }
        else
            return false;
    }





}