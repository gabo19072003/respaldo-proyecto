<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\PersonasModel;

class Users extends BaseController
{
    public function index()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($user_agent, 'Firefox') === false) {
            return view('errorfirefox');
        }else{
            return view('register');
        }     
    }
     
    public function create()
    {
        $rules = $this->validate([
            'name' =>[
                'label' => 'nombre',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'max_length' => 'El {field} debe tener un máximo de 100 carácteres']
            ],
            'lastname' =>[
                'label' => 'apellido',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'max_length' => 'El {field} debe tener un máximo de 100 carácteres']
            ],
            'user'=> [
                'label' => 'usuario',
                'rules' => 'required|max_length[30]|is_unique[users.user]',
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'max_length' => 'El {field} debe tener un máximo de 30 carácteres',
                    'is_unique' => 'El {field} debe ser único']
            ],
            'carnet'=> [
                'label' => 'carnet',
                'rules' => 'required|numeric|max_length[7]',
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'numeric' => 'El {field} debe ser númerico',
                    'max_length' => 'El {field} debe tener un maximo de 7 carácteres']
            ],
            'password'=> [
                'label' => 'contraseña',
                'rules' => 'required|max_length[50]|min_length[8]',
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'max_length' => 'El {field} debe tener un maximo de 50 carácteres',
                    'min_length' => 'El {field} debe tener un minimo de 8 carácteres']
            ],
            'repassword'=> [
                'label' => 'contraseñas',
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Las {field} no coinciden']
            ],
            'email' =>[
                'label' => 'correo',
                'rules' => 'required|valid_email|is_unique[users.user_email]',
                'errors' => [
                    'required' => 'El {field} es requerido',
                    'valid_email' => 'El {field} debe ser válido',
                    'is_unique' => 'El {field} debe ser único']
            ]
        ]);

        if(!$rules){
            $session= session();       
            $session->setFlashdata('color','danger');
            $session->setFlashdata('errors','Revise la Información');
            return redirect()->back()->withInput();
        }

        $userModel = new UsersModel();

        $PersonasModel = new PersonasModel();

        $post = $this->request->getPost(['carnet','user', 'password', 'name','lastname', 'email']);

        $persona = $PersonasModel->validarpersona($post['carnet']);

        if($persona == null){

        $session= session();       
        $session->setFlashdata('color','danger');
        $session->setFlashdata('errors','El número de carnet no se encuentra registrado en la base de datos.');

        return redirect()->back()->withInput();    
        }

        $user = $userModel->where(['persona_id' => $persona['persona_id']])->first();

        if($user){

        $session= session();       
        $session->setFlashdata('color','danger');
        $session->setFlashdata('errors','Esta persona ya tiene usuario registrado.');

        return redirect()->back()->withInput();

        }

        $token = bin2hex(random_bytes(20));

        $datos = [
            'user_name' => $post['name'],
            'user_lastname' => $post['lastname'],
            'user' => $post['user'],
            'user_passwd' => password_hash($post['password'], PASSWORD_DEFAULT) ,
            'user_email' => $post['email'],
            //'rol_id' => $post['rol_id'],
            'persona_id' => $persona['persona_id'],
            'user_active' => 0,
            'user_token' => $token
        ];

        $datos = array_map('trim', $datos);

        $userModel->insert($datos);  

        $email = \Config\Services::email();

        $email->setTo($post['email']);
        $email->setSubject('Activa tu cuenta');

        $url = base_url('activate-user/' . $token);
        $body ='<p>Hola ' . $post['name'] . ',</p>';
        $body .= "<p>Para continuar con el proceso de registro, has clic en la siguiente enlace: <a href='$url'>Activar Cuenta.</a></p>";
        $body .= 'Gracias!';

        $email->setMessage($body);
        $email->send();

        $title = 'Registro exitoso';
        $message = 'Revisa tu correo electrónico para activar tu cuenta.';

        return $this->showMessage($title, $message);

    }

    public function activateUser($token){
        $userModel = new UsersModel();
        $user = $userModel->where(['user_token' => $token, 'user_active' => 0, 'deleted_at' => null])->first();

        if($user){
            $userModel->update(
                $user['user_id'],
                [
                    'user_active' => 1,
                    'user_token' => ''
                ]
            );

            return $this->showMessage('Cuenta activada.', 'Tu cuenta ha sido activada.');
        }

        return $this->showMessage('Ocurrió un error.','Por favor, intenta nuevamente más tarde.');

    }

    public function linkRequestForm(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($user_agent, 'Firefox') === false) {
            return view('errorfirefox');
        }else{
            return view('link_request');
        }       
    }

    public function sendResetLinkEmail(){

        $rules = [
            'email' => 'required|max_length[80]|valid_email'
        ];

        if(!$this->validate($rules)){
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $userModel = new UsersModel();
        $post = $this->request->getPost(['email']);
        $user = $userModel->where(['user_email'=> $post['email'], 'user_active' => 1, 'deleted_at' => null])->first();
        $user1 = $userModel->where(['user_active' => 1, 'deleted_at' => null])->first();

        if(!$user1){

            $title = 'Usuario Inactivo o Bloqueado';
            $message = 'En caso estar inactivo, revise su correo de validación si no lo ha hecho.';

            return $this->showMessage($title, $message);
            
            }

        if($user){
            $token = bin2hex(random_bytes(20));

            $expiresAt = new \Datetime();
            $expiresAt->modify('+1 hour');

            $userModel->update($user['user_id'],[
                'user_reset_token' => $token,
                'user_reset_expires_at' => $expiresAt->format('Y-m-d H:i:s')
            ]);

            $email = \Config\Services::email();

            $email->setTo($post['email']);
            $email->setSubject('Recuperar contraseña');

            $url = base_url('password-reset/' . $token);
            $body ="<p>Estimado Sr o Sra." . $user['user_name'] . ",</p>";
            $body .= "<p>Se ha solicitado un reinicio de contraseña.</br>Para restaurar la contraseña, visita la siguiente dirección: <a href='$url'>Recupera tu cuenta.</a></p>";

            $email->setMessage($body);
            $email->send();

            $title = 'Correo de recuperación enviado';
            $message = 'Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña.';

             return $this->showMessage($title, $message);
            }

        $title = 'Correo de recuperación enviado';
        $message = 'Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña.';

        return $this->showMessage($title, $message);

    }

    public function resetForm($token){
        $userModel = new UsersModel();
        $user = $userModel->where(['user_reset_token'=> $token])->first();

        if($user){
            $currentDateTime = new \DateTime();
            $currentDateTimeStr = $currentDateTime->format('Y-m-d H:i:s');

            if($currentDateTimeStr <= $user['user_reset_expires_at']){
                return view('reset_password',['token' => $token]);
            }else{
                return $this->showMessage('El enlace ha expirado', 'Por favor, solicita un nuevo enlace para restablecer tu contraseña.');
            }
        }

        return $this->showMessage('Ocurrió un error.','Por favor, intenta nuevamente más tarde.');

    }

    public function resetPassword(){
        $rules = [
            'password' => 'required|max_length[50]|min_length[8]',
            'repassword' => 'matches[password]'
        ];

        if(!$this->validate($rules)){
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $userModel = new UsersModel();
        $post = $this->request->getPost(['token', 'password']);

        $user = $userModel->where(['user_reset_token' => $post['token'], 'user_active' => 1, 'deleted_at' => null])->first();
        if ($user) {
            $userModel->update($user['user_id'], [
                'user_passwd' => password_hash($post['password'], PASSWORD_DEFAULT),
                'user_reset_token' => '',
                'user_reset_expires_at' => ''
            ]);

            return $this->showMessage('Contraseña modificada', 'Hemos modificado la contraseña.');

        }

        return $this->showMessage('Ocurrió un error.','Por favor, intenta nuevamente más tarde.');

    }

    private function showMessage($title,$message){
        $data = [
            'title' => $title,
            'message' => $message
        ];

        return view('message',$data);
    }
}