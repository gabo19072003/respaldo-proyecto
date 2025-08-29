<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SesionesModel;

class Sesiones extends BaseController
{
        private $SesionesModel;

    public function __construct()
    {

        $this->SesionesModel = new SesionesModel(); 

    }
    public function index()
    {
        $datos['sesiones']= $this->SesionesModel->orderBy('sesion_id','ASC')->findAll();
        return view('sesion/listar',$datos);
        /*****esto es para hacer test  $model = new SesionesModel();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();
        var_dump($objects);*/
    }
    public function crear(){
         return view('sesion/crear');
    }
    public function guardar(){

        $reglas = $this->validate([
            'sesion_nro' =>[
                'label' => 'número',
                'rules' => 'required|numeric|max_length[2]|is_unique[sesiones.sesion_nro]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo 2 carácteres númericos',
                    'is_unique' => 'El campo {field} debe ser único',
                    'numeric' => 'El campo {field} debe ser númerico']
            ],
            'sesion_detalles' =>[
                'label' => 'detalles',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo 150 carácteres númericos']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $datos=[
                'sesion_nro'=>$this->request->getVar('sesion_nro'),
                'sesion_detalles'=>$this->request->getVar('sesion_detalles')
            ];

        $datos = array_map('trim', $datos);  

        $this->SesionesModel->insert($datos);

        $id = $this->SesionesModel->getInsertID();
        $sesion = $this->SesionesModel->where('sesion_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$sesion['sesion_id'].' - El sesion ('. $sesion['sesion_nro'].') registrado exitosamente');
   
        return $this->response->redirect(site_url('/sesion/crear'));

    }

    public function editar($id=null){

        $datos['sesion']=$this->SesionesModel->where('sesion_id',$id)->first();

        return view('sesion/editar',$datos);
    }

    public function borrar($id=null){

        $sesion = $this->SesionesModel->where('sesion_id', $id)->first();

        $this->SesionesModel->where('sesion_id',$id)->delete($id);

        $session= session();
        $session->setFlashdata('color','danger');
        $session->setFlashdata('mensaje','ID:'.$sesion['sesion_id'].' - El sesion ('. $sesion['sesion_nro'].') eliminado exitosamente');
   
        return $this->response->redirect(site_url('/sesion'));
    }

    public function actualizar($id = null){

        $id= $this->request->getVar('sesion_id');

        $reglas = $this->validate([
            'sesion_nro' =>[
                'label' => 'número',
                'rules' => "required|numeric|max_length[2]|is_unique[sesiones.sesion_nro,sesion_id,{$id}]",
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo 2 carácteres númericos',
                    'is_unique' => 'El campo {field} debe ser único',
                    'numeric' => 'El campo {field} debe ser númerico']
            ],
            'sesion_detalles' =>[
                'label' => 'detalles',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo 150 carácteres númericos']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $datos=[
                'sesion_nro'=>$this->request->getVar('sesion_nro'),
                'sesion_detalles'=>$this->request->getVar('sesion_detalles')
            ];

        $datos = array_map('trim', $datos);  

        $this->SesionesModel->update($id,$datos);

        $sesion = $this->SesionesModel->where('sesion_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$sesion['sesion_id'].' - El sesion ('. $sesion['sesion_nro'].') actualizado exitosamente');
   
        return $this->response->redirect(site_url('/sesion'));

    }
}
