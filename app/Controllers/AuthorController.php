<?php

namespace App\Controllers;

use App\Models\Author;
use Framework\Controller\Controller;

class AuthorController extends Controller {

    protected $author;

    public function __construct()
    {
        parent::__construct();

        $this->author = new Author();
    }

    public function show($id) {

        $author = $this->author->find($id);
        if(is_null($author))
            return $this->response->status(404);

        

        return $this->response->view('author', [
            'author' => $author
        ]);
    }

    public function index() {
        return $this->response->view('authors', [
            'authors' => $this->author->all()
        ]);
    }

    public function add() {
        return $this->response->view('author-add');
    }

    public function create() {

        $name = $this->request->name;
        $birthdate = $this->request->birthdate;

        $author = $this->author->create([
            'name' => $name,
            'birthdate' => $birthdate
        ]);
        $author = is_array($author) ? $author[0] : $author;

        return $author ?
            $this->response->redirect(url('author/' . $author->id))
            :
            $this->response->redirect(url('authors/add'));
    }

    public function getSearch() {
        return $this->response->view('author-search');
    }

    public function search() {
        $search = $this->request->search;

        $objects = Author::search($search);

        return $this->response->write(json_encode($objects));
    }
}