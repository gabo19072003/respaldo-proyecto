<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RecursosModel;

class Recursos extends BaseController
{
    private $RecursosModel;

    public function __construct()
    {

        $this->RecursosModel = new RecursosModel(); 

    }
    public function index()
    {
        $datos['recursos']= $this->RecursosModel->orderBy('recurso_id','ASC')->findAll();
        return view('recurso/listar',$datos);
    }
    public function crear(){
         return view('recurso/crear');
    }
    public function guardar(){

        $reglas = $this->validate([
            'recurso_nro' =>[
                'label' => 'número',
                'rules' => 'required|numeric|max_length[2]|is_unique[recursos.recurso_nro]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo 2 carácteres númericos',
                    'is_unique' => 'El campo {field} debe ser único',
                    'numeric' => 'El campo {field} debe ser númerico']
            ],
            'recurso_nombre' =>[
                'label' => 'nombre',
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
                'recurso_nro'=>$this->request->getVar('recurso_nro'),
                'recurso_nombre'=>$this->request->getVar('recurso_nombre')
            ];

        $datos = array_map('trim', $datos);  

        $this->RecursosModel->insert($datos);

        $id = $this->RecursosModel->getInsertID();
        $recurso = $this->RecursosModel->where('recurso_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$recurso['recurso_id'].' - El recurso ('. $recurso['recurso_nro'].') registrado exitosamente');
   
        return $this->response->redirect(site_url('/recurso/crear'));

    }

    public function editar($id=null){

        $datos['recurso']=$this->RecursosModel->where('recurso_id',$id)->first();

        return view('recurso/editar',$datos);
    }

    public function borrar($id=null){

        $recurso = $this->RecursosModel->where('recurso_id', $id)->first();

        $this->RecursosModel->where('recurso_id',$id)->delete($id);

        $session= session();
        $session->setFlashdata('color','danger');
        $session->setFlashdata('mensaje','ID:'.$recurso['recurso_id'].' - El recurso ('. $recurso['recurso_nro'].') eliminado exitosamente');
   
        return $this->response->redirect(site_url('/recurso'));
    }

    public function actualizar($id = null){

        $id= $this->request->getVar('recurso_id');

        $reglas = $this->validate([
            'recurso_nro' =>[
                'label' => 'número',
                'rules' => "required|numeric|max_length[2]|is_unique[recursos.recurso_nro,recurso_id,{$id}]",
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo 2 carácteres númericos',
                    'is_unique' => 'El campo {field} debe ser único',
                    'numeric' => 'El campo {field} debe ser númerico']
            ],
            'recurso_nombre' =>[
                'label' => 'nombre',
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
                'recurso_nro'=>$this->request->getVar('recurso_nro'),
                'recurso_nombre'=>$this->request->getVar('recurso_nombre')
            ];

        $datos = array_map('trim', $datos);  

        $this->RecursosModel->update($id,$datos);

        $recurso = $this->RecursosModel->where('recurso_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$recurso['recurso_id'].' - El recurso ('. $recurso['recurso_nombre'].') actualizado exitosamente');
   
        return $this->response->redirect(site_url('/recurso'));

    }
}
