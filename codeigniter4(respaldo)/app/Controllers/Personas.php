<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PersonasModel;
use App\Models\CargosModel;
use App\Models\TiposModel;

class Personas extends BaseController
{
    private $PersonasModel;

    public function __construct()
    {
        $this->PersonasModel = new PersonasModel(); 
    }

    public function index()
    {
        $datos['personas']= $this->PersonasModel->orderBy('persona_id','ASC')->findAll();
        return view('persona/listar',$datos);
    }

    public function interno()
    {
        $datos['personas']= $this->PersonasModel->where('carnet !=','null')->orderBy('persona_id','ASC')->findAll();
        return view('persona/interno',$datos);
    }

    public function crear()
    {
        $CargosModel = new CargosModel;
        $TiposModel = new TiposModel;
        $datos['cargos']= $CargosModel->orderBy('cargo_id','ASC')->findAll();
        $datos['tipos']= $TiposModel->orderBy('tipo_id','ASC')->findAll();
        return view('persona/crear',$datos);
    }

    public function guardar()
    {
        $fechaActual = date('Y-m-d');

        $reglas = $this->validate([
            'persona_nombre' =>[
                'label' => 'nombre',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo de 100 caracteres']
            ],
            'persona_apellido' =>[
                'label' => 'apellido',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo de 100 caracteres']
            ],
            'persona_fch_nacimi' =>[
                'label' => 'fecha',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo de {field} es requerido']
            ],
            'persona_carnet' =>[
                'label' => 'carnet',
                'rules' => 'required|max_length[7]|numeric|is_unique[personas.persona_carnet]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo de 7 caracteres numéricos',
                    'is_unique' => 'El campo {field} debe ser único',
                    'numeric' => 'El campo {field} debe ser numérico']
            ],
            'persona_ci' =>[
                'label' => 'cédula',
                'rules' => 'required|numeric|max_length[12]|is_unique[personas.persona_ci]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo de 12 caracteres numéricos',
                    'is_unique' => 'El campo {field} debe ser único',
                    'numeric' => 'El campo {field} debe ser numérico']
            ],
            'persona_sexo' =>[
                'label' => 'género',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ],
            'persona_tf' =>[
                'label' => 'teléfono',
                'rules' => 'required|numeric|is_unique[personas.persona_tf]',
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'numeric' => 'El {field} debe ser numérico',
                    'is_unique' => 'El {field} debe ser único']
            ],
            'persona_email' =>[
                'label' => 'correo',
                'rules' => 'required|valid_email|is_unique[personas.persona_email]',
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'valid_email' => 'El {field} debe ser válido',
                    'is_unique' => 'El {field} debe ser único']
            ],
            'cargo_id' =>[
                'label' => 'cargo',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ],
            'tipo_id' =>[
                'label' => 'tipo',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ],
            'direccion' =>[
                'label' => 'dirección',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo de 255 caracteres']
            ],
            'persona_foto' => [
                'label' => 'foto',
                'rules' => 'mime_in[persona_foto,image/jpg,image/jpeg,image/png]|max_size[persona_foto,4096]',
                'errors' => [
                    'max_size' => 'La {field} debe ser de un máximo de 4 MB',
                    'mime_in' => 'La {field} debe ser de jpg o png']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $imagen=$this->request->getFile('persona_foto');

        if($imagen->isValid()){
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move('public/uploads/',$nuevoNombre);       
        }else{
            $nuevoNombre = 'imagen_predeterminada.jpg';  
        }

        $datos=[
            'persona_nombre'=>$this->request->getVar('persona_nombre'),
            'persona_apellido'=>$this->request->getVar('persona_apellido'),
            'persona_fch_nacimi'=>$this->request->getVar('persona_fch_nacimi'),
            'persona_carnet'=>$this->request->getVar('persona_carnet'),
            'persona_ci'=>$this->request->getVar('persona_ci'),
            'persona_sexo'=>$this->request->getVar('persona_sexo'),
            'persona_tf'=>$this->request->getVar('persona_tf'),
            'persona_email'=>$this->request->getVar('persona_email'),
            'direccion'=>$this->request->getPost('direccion'),
            'cargo_id'=>$this->request->getVar('cargo_id'),
            'tipo_id'=>$this->request->getVar('tipo_id'),
            'persona_foto'=>$nuevoNombre  
        ];

        $datos = array_map('trim', $datos);  

        $this->PersonasModel->insert($datos);

        $id = $this->PersonasModel->getInsertID();
        $persona = $this->PersonasModel->where('persona_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$persona['persona_id'].' - '. ucfirst($persona['persona_nombre']).' ('. $persona['persona_ci'] .') registrado exitosamente');
   
        return $this->response->redirect(site_url('/persona/crear'));
    }

    public function borrar($id = null)
{
    // Buscar la persona antes de eliminar para tener datos y poder mostrar en el mensaje
    $persona = $this->PersonasModel->where('persona_id', $id)->first();

    if ($persona) {
        // Intentar eliminar el registro
        $resultado = $this->PersonasModel->delete($id);
        if ($resultado) {
            // Eliminar la foto del servidor si no es la predeterminada
            if ($persona['persona_foto'] && $persona['persona_foto'] != 'imagen_predeterminada.jpg') {
                $ruta = 'public/uploads/' . $persona['persona_foto'];
                if (file_exists($ruta)) {
                    unlink($ruta);
                }
            }
            // Mensaje de éxito
            $session= session();
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','ID:' . $persona['persona_id'] . ' - ' . ucfirst($persona['persona_nombre']) . ' (' . $persona['persona_ci'] . ') eliminado exitosamente');
        } else {
            // No se pudo eliminar en la base de datos
            $session= session();
            $session->setFlashdata('color','warning');
            $session->setFlashdata('mensaje','No se pudo eliminar el registro en la base de datos');
        }
    } else {
        // Registro no encontrado
        $session= session();
        $session->setFlashdata('color','warning');
        $session->setFlashdata('mensaje','Registro no encontrado');
    }

    return redirect()->to('/persona');
}

    public function editar($id=null)
    {
        $CargosModel = new CargosModel;
        $TiposModel = new TiposModel;

        $datos['cargos']= $CargosModel->orderBy('cargo_id','ASC')->findAll();
        $datos['tipos']= $TiposModel->orderBy('tipo_id','ASC')->findAll();

        $datos['persona']=$this->PersonasModel->where('persona_id',$id)->first();

        return view('persona/editar',$datos);
    }   

    public function actualizar($id=null)
    {
        $id= $this->request->getVar('persona_id');

        $reglas = $this->validate([
            'persona_nombre' =>[
                'label' => 'nombre',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo de 100 caracteres']
            ],
            'persona_apellido' =>[
                'label' => 'apellido',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo de 100 caracteres']
            ],
            'persona_fch_nacimi' =>[
                'label' => 'fecha',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo de {field} es requerido']
            ],
            'persona_carnet' =>[
                'label' => 'carnet',
                'rules' => "required|max_length[7]|numeric|is_unique[personas.persona_carnet,persona_id,{$id}]",
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo de 7 caracteres numéricos',
                    'is_unique' => 'El campo {field} debe ser único',
                    'numeric' => 'El campo {field} debe ser numérico']
            ],
            'persona_ci' =>[
                'label' => 'cédula',
                'rules' => "required|max_length[12]|is_unique[personas.persona_ci,persona_id,{$id}]",
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo de 12 caracteres numéricos',
                    'is_unique' => 'El campo {field} debe ser único',
                    'numeric' => 'El campo {field} debe ser numérico']
            ],
            'persona_sexo' =>[
                'label' => 'género',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ],
            'persona_tf' =>[
                'label' => 'teléfono',
                'rules' => "required|numeric|is_unique[personas.persona_tf,persona_id,{$id}]",
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'numeric' => 'El {field} debe ser numérico',
                    'is_unique' => 'El {field} debe ser único']
            ],
            'persona_email' =>[
                'label' => 'correo',
                'rules' => "required|valid_email|is_unique[personas.persona_email,persona_id,{$id}]",
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'valid_email' => 'El {field} debe ser válido',
                    'is_unique' => 'El {field} debe ser único']
            ],
            'cargo_id' =>[
                'label' => 'cargo',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ],
            'tipo_id' =>[
                'label' => 'tipo',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ],
            'direccion' =>[
                'label' => 'dirección',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe ser de un maximo de 255 caracteres']
            ],
            'persona_foto' => [
                'label' => 'foto',
                'rules' => 'mime_in[persona_foto,image/jpg,image/jpeg,image/png]|max_size[persona_foto,4096]',
                'errors' => [
                    'max_size' => 'La {field} debe ser de un máximo de 4 MB',
                    'mime_in' => 'La {field} debe ser de jpg o png']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $imagen=$this->request->getFile('persona_foto');

        if($imagen->isValid()){
            $datosPersona=$this->PersonasModel->where('persona_id',$id)->first();
            $ruta='public/uploads/'.$datosPersona['persona_foto'];
            if(file_exists($ruta) && $datosPersona['persona_foto'] != 'imagen_predeterminada.jpg'){
                unlink($ruta);
            }
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move('public/uploads/',$nuevoNombre);
        }else{
            $datosPersona = $this->PersonasModel->where('persona_id', $id)->first();
            $nuevoNombre = $datosPersona['persona_foto'];
        }

        $datos=[
            'persona_nombre'=>$this->request->getVar('persona_nombre'),
            'persona_apellido'=>$this->request->getVar('persona_apellido'),
            'persona_fch_nacimi'=>$this->request->getVar('persona_fch_nacimi'),
            'persona_carnet'=>$this->request->getVar('persona_carnet'),
            'persona_ci'=>$this->request->getVar('persona_ci'),
            'persona_sexo'=>$this->request->getVar('persona_sexo'),
            'persona_tf'=>$this->request->getVar('persona_tf'),
            'persona_email'=>$this->request->getVar('persona_email'),
            'direccion'=>$this->request->getPost('direccion'),
            'cargo_id'=>$this->request->getVar('cargo_id'),
            'tipo_id'=>$this->request->getVar('tipo_id'),
            'persona_foto'=>$nuevoNombre  
        ];

        $datos = array_map('trim', $datos);
        $this->PersonasModel->update($id,$datos);

        $persona = $this->PersonasModel->where('persona_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$persona['persona_id'].' - '. ucfirst($persona['persona_nombre']).' ('. $persona['persona_ci'] .') actualizado exitosamente');

        return $this->response->redirect(site_url('/persona')); 
    }
}