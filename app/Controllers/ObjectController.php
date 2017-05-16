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

class ObjectController extends Controller {

    protected $object;

    protected $author;

    protected $genre;

    protected $objectType;

    protected $download;

    protected $role;

    public function __construct()
    {
        parent::__construct();


        $this->object = new Object();
        $this->genre = new Genre();
        $this->role = new Role();
        $this->author = new Author();
        $this->objectType = new ObjectType();
        $this->download = new Download();
    }

    public function show($id) {

        $object = $this->object->find($id);
        if(is_null($object))
            return $this->response->status(404);


        return $this->response->view('object', [
            'object' => $object
        ]);
    }

    public function index() {

        $objects = $this->object->all();

        return $this->response->view('objects', [
            'objects' => $objects
        ]);
    }

    public function download($id) {

        if( ! Auth::check())
            return $this->response->redirect($this->request->referer());

        $object = $this->object->find($id);
        if(is_null($object))
            return $this->response->status(404);

        $this->download->create($object->id, Auth::user()->id);

        return $this->response->file(__DIR__ . '/../../public/' . $object->path);
    }

    public function add() {

        $genres = $this->genre->all();
        $types = $this->objectType->all();
        $authors = $this->author->all();
        $roles = $this->role->all();

        return $this->response->view('object-add', [
            'types' => $types,
            'authors' => $authors,
            'genres' => $genres,
            'roles' => $roles,
        ]);
    }

    public function getSelectRow() {

        $authorIds = $this->request->author_ids;
        $countRoles = intval($this->request->count_roles);

        $authors = $this->author->all();
        $roles = $this->role->all();

        return $this->response->view('object-add-select-row', [
            'authors' => $authors,
            'roles' => $roles,
            'authorIds' => $authorIds,
            'roleIndex' => $countRoles
        ]);
    }

    public function create() {

        $file = $this->request->getUploadedFiles();
//        ddumper($file);
        $file = $file['file'] ?? null;
        if(is_null($file))
            return false;

        list(, $type) = explode('.', $file['name']);

        $name = $this->request->name;
        $typeId = $this->request->type;
        $genreIds = $this->request->genre;
        $authorIds = array_values($this->request->author);
        $roleIds = array_values($this->request->role);

        $fileName = PUBLIC_DIR . '/assets/files/' . md5(time() . $file['name']) . '.' . $type;
        $this->saveFile($file['tmp_name'], $fileName);

        $object = $this->object->create([
            'name' => $name,
            'type_id' => $typeId,
            'path' => 'assets/files/' . basename($fileName),
            'format' => $file['type'],
            'size' => $file['size']
        ]);
        $object = is_array($object) ? $object[0] : $object;

        Object::objectGenre($object->id, $genreIds);



        $authors = [];

        foreach ($roleIds as $key => $roleId) {
            foreach ($roleId as $value) {
                $authors[] = [
                    'object' => $object->id,
                    'author' => $authorIds[$key],
                    'role' => $value
                ];
            }
        }

        Object::objectRoleAuthor($authors);

        return $this->response->redirect(url('object/' . $object->id));
    }

    protected function saveFile($tmp, $path) {
        return move_uploaded_file($tmp, $path);
    }

    public function getSearch() {
        return $this->response->view('object-search');
    }

    public function search() {
        $search = $this->request->search;

        $objects = Object::search($search);

        return $this->response->write(json_encode($objects));
    }


}