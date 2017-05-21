<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\Download;
use App\Models\Genre;
use App\Models\Object;
use App\Models\ObjectType;
use App\Models\Role;
use Framework\App\Auth;
use Framework\Controller\Controller;

class RoleController extends Controller {

    protected $role;

    public function __construct()
    {
        parent::__construct();


        $this->role = new Role();
    }

    public function index() {

        $roles = $this->role->all();

        return $this->response->view('roles', [
            'roles' => $roles
        ]);
    }

    public function add() {
        return $this->response->view('role-add');
    }

    public function create() {

        $name = $this->request->name;

        $ole = $this->role->create([
            'name' => $name
        ]);
        $role = is_array($ole) ? $ole[0] : $ole;

        return $role ?
            $this->response->redirect(url('roles'))
            :
            $this->response->redirect(url('roles/add'));
    }

    public function delete($id) {
        return $this->role->find($id)->delete();
    }


}