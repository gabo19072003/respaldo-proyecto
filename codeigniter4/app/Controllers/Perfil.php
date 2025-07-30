<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\PersonasModel;
use App\Models\RolModel;

class Perfil extends BaseController
{
   private $UsuariosModel;

   public function __construct(){

        $this->UsuariosModel = new UsersModel(); 

    }

   public function index(){

      $RolModel = new RolModel;
      $datos['roles']= $RolModel->orderBy('rol_id','ASC')->findAll();

      $PersonasModel = new PersonasModel;
      $datos['persona']= $PersonasModel->where(['persona_id' => $_SESSION['personaid']])->first();

       return view('perfil/index',$datos);
    }

   public function cambiar(){

        $reglas = $this->validate([
            'actual'=> [
                'label' => 'contraseña actual',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido']
            ],
            'nueva'=> [
                'label' => 'contraseña',
                'rules' => 'required|max_length[50]|min_length[8]',
                'errors' => [
                    'max_length' => 'El campo {field} debe tener un máximo de 50 carácteres',
                    'min_length' => 'El campo {field} debe tener un minimo de 8 carácteres']
            ],
            'confirmar'=> [
                'label' => 'contraseña',
                'rules' => 'matches[nueva]',
                'errors' => [
                    'matches' => 'La {field} no coinciden']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $post = $this->request->getPost(['actual', 'nueva']);

        $post = array_map('trim', $post);

        $user = $this->UsuariosModel->validateClave($post['actual']);

        if($user == null){

            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','La contraseña actual es incorrecta');

            return redirect()->back()->withInput();
        }

        if($user){

            $id = $user['user_id']; 

            $datos['user_passwd'] = password_hash($post['nueva'], PASSWORD_DEFAULT);

            $this->UsuariosModel->update($id,$datos);

            $session= session();       
            $session->setFlashdata('color','success');
            $session->setFlashdata('mensaje','Contraseña actualizada exitosamente');

            return redirect()->back()->withInput();


        }

        $session= session();       
        $session->setFlashdata('color','danger');
        $session->setFlashdata('mensaje','Ocurrió un error.Por favor, intenta nuevamente más tarde.');

        return redirect()->back()->withInput();
    }
}
