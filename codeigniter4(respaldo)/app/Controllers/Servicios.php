<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiciosModel;

class Servicios extends BaseController
{
        private $ServiciosModel;

    public function __construct()
    {

        $this->ServiciosModel = new ServiciosModel(); 

    }
    public function index()
    {
        $datos['servicios']= $this->ServiciosModel->orderBy('servicio_id','ASC')->findAll();
        return view('servicio/listar',$datos);
    }
    public function crear(){
         return view('servicio/crear');
    }
    public function guardar(){

        $reglas = $this->validate([
            'servicio_detalles' =>[
                'label' => 'detalles',
                'rules' => 'required|max_length[150]|is_unique[servicios.servicio_detalles]',
                'errors' => [
                    'required' => 'El campo es requerido',
                    'is_unique' => 'El campo debe ser único',
                    'max_length' => 'El campo debe ser de un maximo 150 carácteres númericos']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $datos=[
                'servicio_detalles'=>$this->request->getVar('servicio_detalles')
            ];

        $datos = array_map('trim', $datos);  

        $this->ServiciosModel->insert($datos);

        $id = $this->ServiciosModel->getInsertID();
        $servicio = $this->ServiciosModel->where('servicio_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','El servicio ID:'.$servicio['servicio_id'].' registrado exitosamente');
   
        return $this->response->redirect(site_url('/servicio/crear'));

    }

    public function editar($id=null){

        $datos['servicio']=$this->ServiciosModel->where('servicio_id',$id)->first();

        return view('servicio/editar',$datos);
    }

    public function borrar($id=null){

        $servicio = $this->ServiciosModel->where('servicio_id', $id)->first();

        $this->ServiciosModel->where('servicio_id',$id)->delete($id);

        $session= session();
        $session->setFlashdata('color','danger');
        $session->setFlashdata('mensaje','El servicio ID:'.$servicio['servicio_id'].' eliminado exitosamente');
   
        return $this->response->redirect(site_url('/servicio'));
    }

    public function actualizar($id = null){

        $id= $this->request->getVar('servicio_id');

        $reglas = $this->validate([
            'servicio_detalles' =>[
                'label' => 'detalles',
                'rules' => "required|max_length[150]|is_unique[servicios.servicio_detalles,servicio_id,{$id}]",
                'errors' => [
                    'required' => 'El campo es requerido',
                    'is_unique' => 'El campo debe ser único',
                    'max_length' => 'El campo debe ser de un maximo 150 carácteres númericos']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $datos=[
                'servicio_detalles'=>$this->request->getVar('servicio_detalles')
            ];

        $datos = array_map('trim', $datos);  

        $this->ServiciosModel->update($id,$datos);

        $servicio = $this->ServiciosModel->where('servicio_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','El servicio ID:'.$servicio['servicio_id'].' actualizado exitosamente');
   
        return $this->response->redirect(site_url('/servicio'));

    }
}