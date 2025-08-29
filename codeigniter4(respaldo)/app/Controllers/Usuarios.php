<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PersonasModel;
use App\Models\UsersModel;
use App\Models\RolModel;
use App\Models\BitacoraModel;


class Usuarios extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT rol.nombre as rol, users.user_id as id, users.user as usuario, users.user_active as active, users.user_email as email
                FROM users, rol 
                WHERE users.rol_id = rol.rol_id AND users.deleted_at IS NULL');

        $datos['users'] = $query->getResultArray();

        return view('usuario/listar',$datos);
    }

    public function crear(){

        $RolModel = new RolModel;
        $datos['roles']= $RolModel->orderBy('nombre','ASC')->findAll();
        return view('usuario/crear',$datos);
    }

    public function guardar(){
        $reglas = $this->validate([
            'user_name' =>[
                'label' => 'nombre',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe tener un máximo de 100 carácteres']
            ],
            'user_lastname' =>[
                'label' => 'apellido',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe tener un máximo de 100 carácteres']
            ],
            'usuario'=> [
                'label' => 'usuario',
                'rules' => 'required|max_length[30]|is_unique[users.user]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe tener un máximo de 30 carácteres',
                    'is_unique' => 'El campo {field} debe ser único']
            ],
            'carnet'=> [
                'label' => 'carnet',
                'rules' => 'required|numeric|max_length[7]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'numeric' => 'El campo {field} debe ser númerico',
                    'max_length' => 'El campo {field} debe tener un máximo de 7 carácteres']
            ],
            'password'=> [
                'label' => 'contraseña',
                'rules' => 'required|max_length[50]|min_length[8]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe tener un máximo de 50 carácteres',
                    'min_length' => 'El campo {field} debe tener un minimo de 8 carácteres']
            ],
            'repassword'=> [
                'label' => 'contraseñas',
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Las {field} no coinciden']
            ],
            'user_email' =>[
                'label' => 'correo',
                'rules' => 'required|valid_email|is_unique[users.user_email]',
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'valid_email' => 'El {field} debe ser válido',
                    'is_unique' => 'El {field} debe ser único']
            ],
            'rol_id' =>[
                'label' => 'rol',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ]
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $userModel = new UsersModel();
        $PersonasModel = new PersonasModel();

        $post = $this->request->getPost(['user_name', 'user_lastname', 'usuario', 'carnet', 'password','rol_id', 'user_email']);

        $persona = $PersonasModel->validarpersona($post['carnet']);

        if($persona == null){

        $session= session();       
        $session->setFlashdata('color','danger');
        $session->setFlashdata('mensaje','El número de carnet no se encuentra registrado en la base de datos.');

        return redirect()->back()->withInput();    
        }

        $user = $userModel->where(['persona_id' => $persona['persona_id']])->first();

        if($user){

        $session= session();       
        $session->setFlashdata('color','danger');
        $session->setFlashdata('mensaje','Esta persona ya tiene usuario registrado.');

        return redirect()->back()->withInput();

        }

        $token = bin2hex(random_bytes(20));

        $datos = [
            'user_name' => $post['user_name'],
            'user_lastname' => $post['user_lastname'],
            'user' => $post['usuario'],
            'user_passwd' => password_hash($post['password'], PASSWORD_DEFAULT) ,
            'user_email' => $post['user_email'],
            'rol_id' => $post['rol_id'],
            'persona_id' => $persona['persona_id'],
            'user_active' => 0,
            'user_token' => $token
        ];

        $datos = array_map('trim', $datos);  

        $userModel->insert($datos);

        $email = \Config\Services::email();

        $email->setTo($post['user_email']);
        $email->setSubject('Activa tu cuenta');

        $url = base_url('activate-user/' . $token);
        $body ='<p>Hola '.$post['user_name'].' '.$post['user_lastname'].',</p>';
        $body .= "<p>Para continuar con el proceso de registro, has clic en la siguiente enlace: <a href='$url'>Activar Cuenta.</a></p>";
        $body .= 'Gracias!';

        $email->setMessage($body);
        $email->send();

            $session= session();       
            $session->setFlashdata('color','success');
            $session->setFlashdata('mensaje','Registro exitoso <br> Revisa tu correo electrónico para activar tu cuenta.');

        return $this->response->redirect(site_url('/usuario/crear'));
            
    }

     public function borrar($id=null){

        $userModel = new UsersModel();

        $usuario = $userModel->where('user_id', $id)->first();

        $userModel->where('user_id',$id)->delete($id);

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$usuario['user_id'].' - El usuario  ('. $usuario['user'].') eliminado exitosamente');
   
        return $this->response->redirect(site_url('/usuario'));
    }

    public function editar($id=null){

        $userModel = new UsersModel();
        $RolModel = new RolModel;

        $datos['roles']= $RolModel->orderBy('nombre','ASC')->findAll();

        $datos['usuario']=$userModel->where('user_id',$id)->first();

        return view('usuario/editar',$datos);
    }

    public function actualizar($id = null){

        $id = $this->request->getPost('user_id');

        $reglas = $this->validate([
            'user_name' =>[
                'label' => 'nombre',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe tener un máximo de 100 carácteres']
            ],
            'user_lastname' =>[
                'label' => 'apellido',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe tener un máximo de 100 carácteres']
            ],
            'usuario'=> [
                'label' => 'usuario',
                'rules' => "required|max_length[30]|is_unique[users.user,user_id,{$id}]",
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'max_length' => 'El campo {field} debe tener un máximo de 30 carácteres',
                    'is_unique' => 'El campo {field} debe ser único']
            ],
            'estatus'=> [
                'label' => 'estatus',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido']
            ],
            'user_email' =>[
                'label' => 'correo',
                'rules' => "required|valid_email|is_unique[users.user_email,user_id,{$id}]",
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'valid_email' => 'El {field} debe ser válido',
                    'is_unique' => 'El {field} debe ser único']
            ],
            'rol_id' =>[
                'label' => 'rol',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ],
        ]);

        if(!$reglas){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('mensaje','Revise la Información');
            return redirect()->back()->withInput();
        }

        $userModel = new UsersModel();

        $post = $this->request->getPost(['user_name','user_lastname','usuario','estatus', 'user_email','rol_id']);

        $datos = [
            'user_name' => $post['user_name'],
            'user_lastname' => $post['user_lastname'],
            'user' => $post['usuario'],
            'user_email' => $post['user_email'],
            'rol_id' => $post['rol_id'],
            'user_active' => $post['estatus'],
        ];

        if($post['estatus'] == 1){
            $datos['user_token'] = '';
        }

        $datos = array_map('trim', $datos);  

        $userModel->update($id,$datos);

        $usuario = $userModel->where('user_id', $id)->first();

        $session= session();
        $session->setFlashdata('color','success');
        $session->setFlashdata('mensaje','ID:'.$usuario['user_id'].' - El usuario  ('. $usuario['user'].') actualizado exitosamente');

        return $this->response->redirect(site_url('/usuario'));
            
    }




}