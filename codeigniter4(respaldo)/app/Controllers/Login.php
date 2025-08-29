<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Models\BitacoraModel;

class Login extends BaseController
{
	public function index()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($user_agent, 'Firefox') === false) {
            return view('errorfirefox');
        }else{
            
            if ($this->session->get('logged_in')){
                return redirect()->to(base_url('inicio'));
            }else{
                return view('login');
            }
        }       
        
    }
    public function auth(){
    	$rules = [
            'user'=> [
                'label' => 'usuario',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ],
            'password'=> [
                'label' => 'contraseña',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es requerido']
            ]
    	];

    	if(!$this->validate($rules)){
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $userModel = new UsersModel();

        $post = $this->request->getPost(['user','password']);

        $user = $userModel->validateUser($post['user'],$post['password']);

        if($user !== null){
        	$this->setSession($user);
            $this->bitacora($post['user']);
        	return redirect()->to(base_url('inicio'));
        }

        return redirect()->back()->withInput()->with('errors', 'El usuario y/o contraseña son incorrectos.');

    }

    private function setSession($userData)
    {
    	$data = [
    		'logged_in' => true,
    		'userid' => $userData['user_id'],
            'personaid' => $userData['persona_id'],
            'user' => $userData['user'],
    		'username' => $userData['user_name'],
            'userlastname' => $userData['user_lastname'],
            'email' => $userData['user_email'],
            'rol' => $userData['rol_id'],
            'time' => time()

    	];

    	$this->session->set($data);
    }

    public function logout(){
        if($this->session->get('logged_in')){
            $this->session->destroy();

            if (empty($_SESSION)) {
            $datos = [
                'tipo' => 'error', 
                'mensaje' => 'ERROR AL SALIR'
            ];
            } else {
            $datos = [
                'tipo' => 'success', 
                'mensaje' => 'SALIENDO...'
            ];
            }
            $res = json_encode($datos);
            return $this->response->setJSON($res);     
        }
    }

    public function obtenerDireccionIP() {
    // Si el usuario está detrás de un proxy, obtén la dirección IP del cliente desde las cabeceras
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Si no se encuentra detrás de un proxy, obtén la dirección IP directamente
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
    }

    public function bitacora($user) {

        $BitacoraModel= new BitacoraModel();

        $direccionIP = $this->obtenerDireccionIP(); 
        $detalles = "Inició sesión";

        $datos = [

            'user' => $user,
            'bitacora_detalles' => $detalles,
            'bitacora_ip' => $direccionIP

        ];
        $BitacoraModel->insert($datos);
     }

}