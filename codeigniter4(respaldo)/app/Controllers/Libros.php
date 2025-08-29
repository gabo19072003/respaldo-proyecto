<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LibrosModel;

class Libros extends BaseController{

    private $LibrosModel;

    public function __construct()
    {

        $this->LibrosModel = new LibrosModel(); 

    }

    public function index(){
        
        $datos['libros']= $this->LibrosModel->orderBy('lib_id','ASC')->findAll();
        return view('libros/listar',$datos);
        
    }

    public function crear(){

        return view('libros/crear');
    }

    public function guardar(){

        $reglas = $this->validate([
            'cota'=> [
                'label' => 'cota',
                'rules' => 'required|numeric|max_length[10]|is_unique[libros.cota]',
                'errors' => [
                    'required' => 'La {field} es requerido',
                    'max_length' => 'La {field} debe ser de un maximo es 100 carácteres',
                    'is_unique' => 'La {field} debe ser único',
                    'numeric' => 'La {field} debe ser númerico']
            ],
            'lib_nombre' =>[
                'label' => 'nombre',
                'rules' => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'min_length' => 'El campo {field} debe ser de un minimo es 3 carácteres',
                    'max_length' => 'El campo {field} debe ser de un maximo es 150 carácteres']
            ],
            'lib_editorial' =>[
                'label' => 'editorial',
                'rules' => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'min_length' => 'El campo {field} debe ser de un minimo es 3 carácteres',
                    'max_length' => 'El campo {field} debe ser de un maximo es 150 carácteres']
            ],
            'lib_autor' =>[
                'label' => 'autor',
                'rules' => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'min_length' => 'El campo {field} debe ser de un minimo es 3 carácteres',
                    'max_length' => 'El campo {field} debe ser de un maximo es 150 carácteres']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $datos=[
            'cota'=>$this->request->getVar('cota'),
            'lib_nombre'=>$this->request->getVar('lib_nombre'),
            'lib_editorial'=>$this->request->getVar('lib_editorial'),
            'lib_autor'=>$this->request->getVar('lib_autor') 
        ];

        $this->LibrosModel->insert($datos);
        $id = $this->LibrosModel->getInsertID();
        $libro = $this->LibrosModel->where('lib_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','Libro de COTA: '. $libro['cota'] .' ('. $libro['lib_nombre'] .') registrado exitosamente');
   
        return $this->response->redirect(site_url('/libro'));

    }
    public function borrar($id=null){
      
        $libro = $this->LibrosModel->where('lib_id', $id)->first();

        $this->LibrosModel->where('lib_id',$id)->delete($id);

        $session = session();
        $session->setFlashdata('color','danger');
        $session->setFlashdata('mensaje','Libro de COTA: '. $libro['cota'] .' ('. $libro['lib_nombre'] .') borrado exitosamente');

        return $this->response->redirect(site_url('/libro'));
    }    
    
    public function editar($id=null){

        $datos['libro']=$this->LibrosModel->where('lib_id',$id)->first();
        return view('libros/editar',$datos);
    }

    public function actualizar($id=null){

        $id= $this->request->getVar('lib_id');

        $reglas = $this->validate([
            'cota'=> [
                'label' => 'cota',
                'rules' => "required|numeric|max_length[10]|is_unique[libros.cota,lib_id,{$id}]",
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo es 100 carácteres',
                    'is_unique' => 'El campo {field} debe ser único']
            ],
            'lib_nombre' =>[
                'label' => 'nombre',
                'rules' => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'min_length' => 'El campo {field} debe ser de un minimo es 3 carácteres',
                    'max_length' => 'El campo {field} debe ser de un maximo es 150 carácteres']
            ],
            'lib_editorial' =>[
                'label' => 'editorial',
                'rules' => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'min_length' => 'El campo {field} debe ser de un minimo es 3 carácteres',
                    'max_length' => 'El campo {field} debe ser de un maximo es 150 carácteres']
            ],
            'lib_autor' =>[
                'label' => 'autor',
                'rules' => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'min_length' => 'El campo {field} debe ser de un minimo es 3 carácteres',
                    'max_length' => 'El campo {field} debe ser de un maximo es 150 carácteres']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $datos=[
            'cota'=>$this->request->getVar('cota'),
            'lib_nombre'=>$this->request->getVar('lib_nombre'),
            'lib_editorial'=>$this->request->getVar('lib_editorial'),
            'lib_autor'=>$this->request->getVar('lib_autor')

        ];

        $libro = $this->LibrosModel->where('lib_id', $id)->first();

        $this->LibrosModel->update($id,$datos);

        $session = session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','Libro de COTA: '. $libro['cota'] .' ('. $libro['lib_nombre'] .') actualizado exitosamente');

        return $this->response->redirect(site_url('/libro')); 
    }

}