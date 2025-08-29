<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BitacoraModel;

class Bitacora extends BaseController
{
    private $BitacoraModel;

    public function __construct()
    {

        $this->BitacoraModel = new BitacoraModel(); 

    }
    public function index()
    {
        $datos['bitacoras']= $this->BitacoraModel->orderBy('bitacora_id','ASC')->findAll();
        return view('bitacora/listar',$datos);
    }
}
