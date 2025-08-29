<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventosModel;
use App\Models\PersonasModel;

class Eventos extends BaseController{

    public $EventosModel;

    public function __construct()
    {
        $this->EventosModel = new EventosModel;

    }

    public function index()
    {
        return view('evento/index');
    }

    public function agenda(){

        $eventos = $this->EventosModel->where(['estado' => null])->findAll();

        $datos = json_encode($eventos);

        return $this->response->setJSON($datos);
    }

    public function listar(){
        $datos['eventos']= $this->EventosModel->where(['estado' => null])->orderBy('id','ASC')->findAll();
        return view('evento/listar',$datos);
    }

    public function listarexit(){
        $datos['eventos']= $this->EventosModel->where(['estado !=' => 0])->orderBy('id','ASC')->findAll();
        return view('evento/listarx',$datos);
    }

    public function crear(){
         return view('evento/crear');
    }

    public function guardar(){

        $reglas = $this->validate([
            'title' =>[
                'label' => 'nombre',
                'rules' => 'required|max_length[30]|is_unique[eventos.title]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo 30 carácteres',
                    'is_unique' => 'El campo {field} debe ser único']
            ],
            'start' =>[
                'label' => 'fecha inicial',
                'rules' => 'required',
                'errors' => [
                    'required' => 'La {field} es requerida']
            ],
            'end' =>[
                'label' => 'fecha final',
                'rules' => 'required',
                'errors' => [
                    'required' => 'La {field} es requerida']
            ],
            'color' =>[
                'label' => 'color',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ],
            'lugar' =>[
                'label' => 'lugar',
                'rules' => 'required|max_length[30]',
                'errors' => [
                    'max_length' => 'El campo {field} debe ser de un maximo 30 carácteres',
                    'required' => 'El {field} es requerido']
            ],
            'description' =>[
                'label' => 'descripción',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'max_length' => 'El campo {field} debe ser de un maximo 150 carácteres',
                    'required' => 'El campo {field} es requerido']
            ],
            'responsable' =>[
                'label' => 'responsable',
                'rules' => 'required|max_length[30]',
                'errors' => [
                    'max_length' => 'El campo {field} debe ser de un maximo 150 carácteres',
                    'numeric' => 'La cédula de {field} debe ser númerica',
                    'required' => 'El {field} es requerido']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $post = $this->request->getPost(['title', 'start', 'end','lugar','color','description','responsable']);

        //Validar cedula

        /**$PersonasModel = new PersonasModel();

        $persona = $PersonasModel->validaresponsable($post['responsable']);

        if($persona == null){

        $session= session();       
        $session->setFlashdata('color','danger');
        $session->setFlashdata('mensaje','La cédula no se encuentra registrado en la base de datos.');

        return redirect()->back()->withInput();    
        }**/

        $datos = [
            'title' => trim($post['title']),
            'start' => $post['start'],
            'end' => $post['end'],
            'lugar' => $post['lugar'],
            'color' => $post['color'],
            'detalles' => $post['description'],
            'responsable' => trim($post['responsable'])
        ];

        $this->EventosModel->insert($datos);

        $id = $this->EventosModel->getInsertID();
        
        $evento = $this->EventosModel->where('id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$evento['id'].' - El evento '. ucfirst($evento['title']).' fue registrado exitosamente');
   
        return $this->response->redirect(site_url('/evento/crear'));
    }

    public function restaurar($id=null){

        $datos = [
            'estado' => null
        ];

        $this->EventosModel->update($id,$datos);

        $evento = $this->EventosModel->where('id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$evento['id'].' - El evento '. ucfirst($evento['title']).' ha sido restaurado');

        return $this->response->redirect(site_url('/evento/listarexit'));

    }


    public function suspender($id=null){

        $currentDateTime = new \DateTime();
        $currentDateTimeStr = $currentDateTime->format('Y-m-d H:i:s');

        $datos['estado'] = $currentDateTimeStr;

        $this->EventosModel->update($id,$datos);

        $evento = $this->EventosModel->where('id', $id)->first();

        $session= session();
        $session->setFlashdata('color','warning');
        $session->setFlashdata('mensaje','ID:'.$evento['id'].' - El evento '. ucfirst($evento['title']).' ha sido suspedido');

        return $this->response->redirect(site_url('/evento/lista'));

    }

    public function editar($id = null){

        $datos['evento']=$this->EventosModel->where('id',$id)->first();
        return view('evento/editar',$datos);
    }

    public function actualizar($id = null){

        $id= $this->request->getVar('id');

        $reglas = $this->validate([
            'title' =>[
                'label' => 'nombre',
                'rules' => "required|max_length[30]|is_unique[eventos.title,id,{$id}]",
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo 30 carácteres',
                    'is_unique' => 'El campo {field} debe ser único']
            ],
            'start' =>[
                'label' => 'fecha inicial',
                'rules' => 'required',
                'errors' => [
                    'required' => 'La {field} es requerida']
            ],
            'end' =>[
                'label' => 'fecha final',
                'rules' => 'required',
                'errors' => [
                    'required' => 'La {field} es requerida']
            ],
            'color' =>[
                'label' => 'color',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ],
            'lugar' =>[
                'label' => 'lugar',
                'rules' => 'required|max_length[30]',
                'errors' => [
                    'max_length' => 'El campo {field} debe ser de un maximo 30 carácteres',
                    'required' => 'El {field} es requerido']
            ],
            'description' =>[
                'label' => 'descripción',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'max_length' => 'El campo {field} debe ser de un maximo 150 carácteres',
                    'required' => 'El campo {field} es requerido']
            ],
            'responsable' =>[
                'label' => 'responsable',
                'rules' => 'required|max_length[30]',
                'errors' => [
                    'max_length' => 'El campo {field} debe ser de un maximo 150 carácteres',
                    'numeric' => 'La cédula de {field} debe ser númerica',
                    'required' => 'El {field} es requerido']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $post = $this->request->getPost(['title', 'start', 'end','lugar','color','description','responsable']);

        $datos = [
            'title' => trim($post['title']),
            'start' => $post['start'],
            'end' => $post['end'],
            'lugar' => $post['lugar'],
            'color' => $post['color'],
            'detalles' => $post['description'],
            'responsable' => trim($post['responsable'])
        ];

        $this->EventosModel->update($id,$datos);

        $evento = $this->EventosModel->where('id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$evento['id'].' - El evento '. ucfirst($evento['title']).' fue actualizado exitosamente');
   
        return $this->response->redirect(site_url('/evento/lista'));
    }

    public function borrar($id = null){

        $evento = $this->EventosModel->where('id',$id)->first();

        $this->EventosModel->where('id',$id)->delete($id);

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$evento['id'].' - El evento '. ucfirst($evento['title']).' fue eliminado exitosamente');
   
        return $this->response->redirect(site_url('/evento/lista'));
    }
}
