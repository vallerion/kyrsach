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
}