<?php

namespace App\Controllers;

use App\Models\User;
use Framework\App\Auth;
use Framework\Controller\Controller;

class AuthController extends Controller {

    protected $user;

    protected $auth;

    public function __construct()
    {
        parent::__construct();

        $this->user = new User();
        $this->auth = Auth::getInstance();
    }

    public function getLogin() {
        return $this->response->view('login');
    }

    public function login() {
        $user = $this->auth->login(
            $this->request->email,
            $this->request->password
        );
        ddumper($this->request);
    }


}