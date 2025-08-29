<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FireFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($user_agent, 'Firefox') === false) {
                // Si el agente de usuario no contiene la palabra "Firefox"
                 // Redirige o muestra un mensaje de error
               redirect()->to(base_url('errorfirefox'));
        }        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
