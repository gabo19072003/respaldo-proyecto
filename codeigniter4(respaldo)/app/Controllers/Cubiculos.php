<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CubiculosModel;

class Cubiculos extends BaseController
{
    private $CubiculosModel;

    public function __construct()
    {

        $this->CubiculosModel = new CubiculosModel(); 

    }
    public function index()
    {
        $datos['cubiculos']= $this->CubiculosModel->orderBy('cubiculo_id','ASC')->findAll();
        return view('cubiculo/listar',$datos);
    }
    public function crear(){
         return view('cubiculo/crear');
    }
    public function guardar(){
        $reglas = $this->validate([
            'cubiculo_nro' =>[
                'label' => 'número',
                'rules' => 'required|numeric|max_length[2]|is_unique[cubiculos.cubiculo_nro]',
                'errors' => [
                    'required' => 'El campo {field} es requerido.',
                    'max_length' => 'El campo {field} tiene un máximo de 2 carácteres.',
                    'is_unique' => 'El campo {field} debe ser único.',
                    'numeric' => 'El campo {field} debe ser númerico.']
            ],
            'cubiculo_ubicacion' =>[
                'label' => 'ubicación',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido.']
            ],
            'cubiculo_escritorio' =>[
                'label' => 'escritorio',
                'rules' => 'uploaded[cubiculo_escritorio]|mime_in[cubiculo_escritorio,image/jpg,image/jpeg,image/png]|max_size[cubiculo_escritorio,3072]',
                'errors' => [
                    'uploaded' => 'La imagen del {field} es requerida.',
                    'mime_in' => 'El formato de la imagen del {field} no es jpeg o png.',
                    'max_size' => 'El tamaño valido es menos de 3 mb.'

                ]
            ],
            'cubiculo_silla' =>[
                'label' => 'sillas',
                'rules' => 'required',
                'errors' => [
                    'required' => 'La cantidad de {field} es requerida.']
            ],
            'cubiculo_ventana' =>[
                'label' => 'ventanas',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Es opción es requerida.']
            ],
            'cubiculo_espacioso' =>[
                'rules' => 'required',
                'errors' => [
                    'required' => 'Es opción es requerida.']
            ],
            'cubiculo_redes' =>[
                'label' => 'redes',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Es opción es requerida.']
            ],
            'cubiculo_detalles' =>[
                'label' => 'detalles',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es requerido.',
                    'max_length' => 'El campo {field} debe ser de un maximo 150 carácteres númericos.']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $imagen=$this->request->getFile('cubiculo_escritorio');

        if($imagen->isValid()){
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move('public/uploads/',$nuevoNombre);       
        }

        $datos=[
                'cubiculo_nro'=>$this->request->getVar('cubiculo_nro'),
                'cubiculo_ubicacion'=>$this->request->getVar('cubiculo_ubicacion'),
                'cubiculo_silla'=>$this->request->getVar('cubiculo_silla'),
                'cubiculo_ventana'=>$this->request->getVar('cubiculo_ventana'),
                'cubiculo_redes'=>$this->request->getVar('cubiculo_redes'),
                'cubiculo_espacioso'=>$this->request->getVar('cubiculo_espacioso'),
                'cubiculo_detalles'=>$this->request->getVar('cubiculo_detalles'),
                'cubiculo_escritorio'=>$nuevoNombre  
            ];

        $datos = array_map('trim', $datos);  

        $this->CubiculosModel->insert($datos);

        $id = $this->CubiculosModel->getInsertID();
        $cubiculo = $this->CubiculosModel->where('cubiculo_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$cubiculo['cubiculo_id'].' - El cubiculo ('. $cubiculo['cubiculo_nro'].') registrado exitosamente');
   
        return $this->response->redirect(site_url('/cubiculo/crear'));

    }

    public function editar($id=null){

        $datos['cubiculo']=$this->CubiculosModel->where('cubiculo_id',$id)->first();

        return view('cubiculo/editar',$datos);
    }

    public function borrar($id=null){

        $cubiculo = $this->CubiculosModel->where('cubiculo_id', $id)->first();

        $ruta=('public/uploads/'.$cubiculo['cubiculo_escritorio']);  
        @unlink($ruta);

        $this->CubiculosModel->where('cubiculo_id',$id)->delete($id);

        $session= session();
        $session->setFlashdata('color','danger');
        $session->setFlashdata('mensaje','ID:'.$cubiculo['cubiculo_id'].' - El cubiculo ('. $cubiculo['cubiculo_nro'].') eliminado exitosamente');
   
        return $this->response->redirect(site_url('/cubiculo'));
    }

    public function actualizar($id = null){

        $id= $this->request->getVar('cubiculo_id');

        $reglas = $this->validate([
            'cubiculo_nro' =>[
                'label' => 'número',
                'rules' => "required|numeric|max_length[2]|is_unique[cubiculos.cubiculo_nro,cubiculo_id,{$id}]",
                'errors' => [
                    'required' => 'El campo {field} es requerido.',
                    'max_length' => 'El campo {field} tiene un máximo de 2 carácteres.',
                    'is_unique' => 'El campo {field} debe ser único.',
                    'numeric' => 'El campo {field} debe ser númerico.']
            ],
            'cubiculo_ubicacion' =>[
                'label' => 'ubicación',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido.']
            ],
            'cubiculo_escritorio' =>[
                'label' => 'escritorio',
                'rules' => 'mime_in[cubiculo_escritorio,image/jpg,image/jpeg,image/png]|max_size[cubiculo_escritorio,3072]',
                'errors' => [
                    'mime_in' => 'El formato de la imagen del {field} no es jpeg o png.',
                    'max_size' => 'El tamaño valido es menos de 3 mb.'

                ]
            ],
            'cubiculo_silla' =>[
                'label' => 'sillas',
                'rules' => 'required',
                'errors' => [
                    'required' => 'La cantidad de {field} es requerida.']
            ],
            'cubiculo_ventana' =>[
                'label' => 'ventanas',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Es opción es requerida.']
            ],
            'cubiculo_espacioso' =>[
                'rules' => 'required',
                'errors' => [
                    'required' => 'Es opción es requerida.']
            ],
            'cubiculo_redes' =>[
                'label' => 'redes',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Es opción es requerida.']
            ],
            'cubiculo_detalles' =>[
                'label' => 'detalles',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es requerido.',
                    'max_length' => 'El campo {field} debe ser de un maximo 150 carácteres númericos.']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $imagen=$this->request->getFile('cubiculo_escritorio');

        $cubiculo = $this->CubiculosModel->where('cubiculo_id', $id)->first();

        if($imagen->isValid()){
                $ruta=('public/uploads/'.$cubiculo['cubiculo_escritorio']);
                unlink($ruta);
                $nuevoNombre = $imagen->getRandomName();
                $imagen->move('public/uploads/',$nuevoNombre);

        }else{
                $nuevoNombre = $cubiculo['cubiculo_escritorio'];
        }


        $datos=[
                'cubiculo_nro'=>$this->request->getVar('cubiculo_nro'),
                'cubiculo_ubicacion'=>$this->request->getVar('cubiculo_ubicacion'),
                'cubiculo_silla'=>$this->request->getVar('cubiculo_silla'),
                'cubiculo_ventana'=>$this->request->getVar('cubiculo_ventana'),
                'cubiculo_redes'=>$this->request->getVar('cubiculo_redes'),
                'cubiculo_espacioso'=>$this->request->getVar('cubiculo_espacioso'),
                'cubiculo_detalles'=>$this->request->getVar('cubiculo_detalles'),
                'cubiculo_escritorio'=>$nuevoNombre  
            ];

        $datos = array_map('trim', $datos);  

        $this->CubiculosModel->update($id,$datos);

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$cubiculo['cubiculo_id'].' - El cubiculo ('. $cubiculo['cubiculo_nro'].') actualizado exitosamente');
   
        return $this->response->redirect(site_url('/cubiculo'));

    }
    
}
