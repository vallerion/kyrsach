<?php

namespace App\Controllers;

use App\Models\Download;
use App\Models\Object;
use Framework\App\Auth;
use Framework\Controller\Controller;

class ObjectController extends Controller {

    protected $object;

    protected $download;

    public function __construct()
    {
        parent::__construct();


        $this->object = new Object();
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


}