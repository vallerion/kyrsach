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
        return Auth::check() ?
            $this->response->view('/') :
            $this->response->view('login');
    }

    public function getLogout() {
        $this->auth->logout();

        return $this->response->redirect('/');
    }

    public function login() {
        
        $email = $this->request->email;
        $password = $this->request->password;

        if(empty($email) || empty($password))
            return $this->response->redirect('login');

        $user = $this->auth->login(
            $this->request->email,
            $this->request->password
        );
        
        if($user)
            return $this->response->redirect('profile/' . $user->id);
        else
            return $this->response->redirect('login');
    }

    public function getRegistration() {
        return Auth::check() ?
            $this->response->view('/') :
            $this->response->view('registration');
    }

    public function registration() {
        $name = $this->request->name;
        $email = $this->request->email;
        $password = $this->request->password;
        $phone = $this->request->phone;

        if(empty($email) || empty($password) || empty($name))
            return $this->response->redirect('registration');


        $user = $this->user->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
        ]);


        if($user)
            return $this->response->redirect('login/' . $user->id);
        else
            return $this->response->redirect('registration');
    }


}