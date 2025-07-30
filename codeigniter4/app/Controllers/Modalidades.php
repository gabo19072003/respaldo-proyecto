<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiciosModel;
use App\Models\ModalidadesModel;

class Modalidades extends BaseController
{
        private $ModalidadesModel;

    public function __construct()
    {

        $this->ModalidadesModel = new ModalidadesModel(); 

    }
    public function index($id)
    {
        $ServiciosModel = new ServiciosModel;
        $servicio = $ServiciosModel->where('servicio_id', $id)->first();

        $datos['servicio'] = $servicio['servicio_id'];

        $datos['nombre'] = $servicio['servicio_detalles'];

        $datos['modalidades'] = $this->ModalidadesModel->where(['servicio_id' => $servicio['servicio_id']])->findAll();


        return view('modalidad/listar',$datos);
    }
    public function crear($id){

        $datos['id'] = $id;

         return view('modalidad/crear',$datos);
    }
    public function guardar($id){


        $reglas = $this->validate([
            'modalidad_detalles' =>[
                'label' => 'detalles',
                'rules' => 'required|max_length[150]|is_unique[modalidades.modalidad_detalles]',
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
                'modalidad_detalles'=>$this->request->getVar('modalidad_detalles'),
                'servicio_id'=>$id
            ];

        $datos = array_map('trim', $datos);  

        $this->ModalidadesModel->insert($datos);

        $id_modalidad = $this->ModalidadesModel->getInsertID();
        $modalidad = $this->ModalidadesModel->where('modalidad_id', $id_modalidad)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','La modalidad ID:'.$modalidad['modalidad_id'].'se registró exitosamente');

        return $this->response->redirect(site_url('/modalidad/crear/'.$id));

    }

    public function editar($id){

        $datos['modalidad']=$this->ModalidadesModel->where('modalidad_id',$id)->first();

        return view('modalidad/editar',$datos);
    }

    public function borrar($id){

        $modalidad = $this->ModalidadesModel->where('modalidad_id', $id)->first();

        $this->ModalidadesModel->where('modalidad_id',$id)->delete($id);

        $session= session();
        $session->setFlashdata('color','danger');
        $session->setFlashdata('mensaje','La modalidad ID:'.$modalidad['modalidad_id'].' se borró exitosamente');
   
        return $this->response->redirect(site_url('/servicio/agregar/'.$modalidad['servicio_id']));
    }

    public function actualizar($id = null){

        $id= $this->request->getVar('modalidad_id');

        $reglas = $this->validate([
            'modalidad_detalles' =>[
                'label' => 'detalles',
                'rules' => "required|max_length[150]|is_unique[modalidades.modalidad_detalles,modalidad_id,{$id}]",
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
                'modalidad_detalles'=>$this->request->getVar('modalidad_detalles')
            ];

        $datos = array_map('trim', $datos);  

        $this->ModalidadesModel->update($id,$datos);

        $modalidad = $this->ModalidadesModel->where('modalidad_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','La modalidad ID:'.$modalidad['modalidad_id'].' se actualizó exitosamente');
   
        return $this->response->redirect(site_url('/servicio/agregar/'.$modalidad['servicio_id']));

    }
}