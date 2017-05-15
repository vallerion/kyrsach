<?php

namespace App\Controllers;

use App\Models\User;
use Framework\App\Auth;
use Framework\Controller\Controller;

class UserController extends Controller {

    protected $user;

    public function __construct()
    {
        parent::__construct();

        $this->user = new User();
    }

    public function show($id) {

        if(Auth::check() && Auth::user()->id == $id)
            $user = Auth::user();
        else
            $user = $this->user->find($id);

        if(is_null($user))
            return $this->response->status(404);

//        ddumper($user->downloads());

        return $this->response->view('user', [
            'user' => $user
        ]);
    }

    public function index() {
        return $this->response->view('users', [
            'users' => $this->user->all()
        ]);
    }
}