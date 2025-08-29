<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CasillerosModel;
use App\Models\LibrosModel;

class Casilleros extends BaseController
{
    private $CasillerosModel;
    private $LibrosModel;

    public function __construct()
    {
        $this->CasillerosModel = new CasillerosModel();
        $this->LibrosModel = new LibrosModel();
    }

    public function index()
    {
        $datos['casilleros'] = $this->CasillerosModel->getCasillerosWithLibro();
        return view('casillero/listar', $datos);
    }

    public function crear()
    {
        $datos['libros'] = $this->LibrosModel->orderBy('lib_nombre', 'ASC')->findAll();
        return view('casillero/crear', $datos);
    }

    public function guardar()
    {
        $reglas = $this->validate([
            'cedula' => [
                'label' => 'cédula',
                'rules' => 'required|numeric|max_length[15]|is_unique[casilleros.cedula]',
                'errors' => [
                    'required' => 'El campo {field} es requerido.',
                    'max_length' => 'El campo {field} debe tener un máximo de 15 caracteres numéricos.',
                    'is_unique' => 'Ya existe un casillero con esta {field}.',
                    'numeric' => 'El campo {field} debe ser numérico.'
                ]
            ],
            'nombre' => [
                'label' => 'nombre',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido.',
                    'max_length' => 'El campo {field} debe tener un máximo de 100 caracteres.'
                ]
            ],
            'libro_id' => [
                'label' => 'libro',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Debe seleccionar un {field}.',
                    'is_natural_no_zero' => 'Debe seleccionar un {field} válido.'
                ]
            ]
        ]);

        if (!$reglas) {
            $session = session();
            $session->setFlashdata('color', 'danger');
            $session->setFlashdata('mensaje', 'Revise la Información.');
            return redirect()->to(site_url('casillero/crear'))->withInput();
        }

        $datos = [
            'cedula' => $this->request->getVar('cedula'),
            'nombre' => $this->request->getVar('nombre'),
            'libro_id' => $this->request->getVar('libro_id')
        ];

        $datos = array_map('trim', $datos);

        $this->CasillerosModel->insert($datos);

        $id = $this->CasillerosModel->getInsertID();
        // MODIFICACIÓN CRÍTICA AQUÍ: Obtener el casillero con el nombre del libro de forma segura
        $casillero = $this->CasillerosModel->select('casilleros.*, libros.lib_nombre')
                                          ->join('libros', 'libros.lib_id = casilleros.libro_id', 'left')
                                          ->where('casilleros.casillero_id', $id)
                                          ->first();

        $session = session();
        $session->setFlashdata('color', 'success');
        $nombreLibro = $casillero['lib_nombre'] ?? 'Sin libro asignado';
        $session->setFlashdata('mensaje', 'ID: ' . $casillero['casillero_id'] . ' - El casillero de ' . $casillero['nombre'] . ' (Cédula: ' . $casillero['cedula'] . ') con libro "' . $nombreLibro . '" registrado exitosamente.');

        return $this->response->redirect(site_url('/casillero'));
    }

    public function editar($id = null)
    {
        $datos['casillero'] = $this->CasillerosModel->find($id);
        $datos['libros'] = $this->LibrosModel->orderBy('lib_nombre', 'ASC')->findAll();

        if (empty($datos['casillero'])) {
            $session = session();
            $session->setFlashdata('color', 'danger');
            $session->setFlashdata('mensaje', 'El casillero no fue encontrado o ha sido eliminado.');
            return redirect()->to(site_url('/casillero'));
        }
        return view('casillero/editar', $datos);
    }

    public function borrar($id = null)
    {
        // MODIFICACIÓN CRÍTICA AQUÍ: Obtener el casillero con el nombre del libro de forma segura antes de borrar
        $casillero = $this->CasillerosModel->select('casilleros.*, libros.lib_nombre')
                                          ->join('libros', 'libros.lib_id = casilleros.libro_id', 'left')
                                          ->where('casilleros.casillero_id', $id)
                                          ->first();

        if (empty($casillero)) {
            $session = session();
            $session->setFlashdata('color', 'danger');
            $session->setFlashdata('mensaje', 'El casillero no fue encontrado.');
            return redirect()->to(site_url('/casillero'));
        }

        $this->CasillerosModel->delete($id);

        $session = session();
        $session->setFlashdata('color', 'danger');
        $nombreLibro = $casillero['lib_nombre'] ?? 'Sin libro asignado';
        $session->setFlashdata('mensaje', 'ID: ' . $casillero['casillero_id'] . ' - El casillero de ' . $casillero['nombre'] . ' (Cédula: ' . $casillero['cedula'] . ') con libro "' . $nombreLibro . '" eliminado exitosamente.');

        return $this->response->redirect(site_url('/casillero'));
    }

    public function actualizar()
    {
        $id = $this->request->getVar('casillero_id');

        $casilleroActual = $this->CasillerosModel->find($id);

        if (empty($casilleroActual)) {
            $session = session();
            $session->setFlashdata('color', 'danger');
            $session->setFlashdata('mensaje', 'El casillero a actualizar no fue encontrado.');
            return redirect()->to(site_url('/casillero'));
        }

        $reglas = $this->validate([
            'cedula' => [
                'label' => 'cédula',
                'rules' => "required|numeric|max_length[15]|is_unique[casilleros.cedula,casillero_id,{$id}]",
                'errors' => [
                    'required' => 'El campo {field} es requerido.',
                    'max_length' => 'El campo {field} debe tener un máximo de 15 caracteres numéricos.',
                    'is_unique' => 'Ya existe un casillero con esta {field}.',
                    'numeric' => 'El campo {field} debe ser numérico.'
                ]
            ],
            'nombre' => [
                'label' => 'nombre',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es requerido.',
                    'max_length' => 'El campo {field} debe tener un máximo de 100 caracteres.'
                ]
            ],
            'libro_id' => [
                'label' => 'libro',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Debe seleccionar un {field}.',
                    'is_natural_no_zero' => 'Debe seleccionar un {field} válido.'
                ]
            ]
        ]);

        if (!$reglas) {
            $session = session();
            $session->setFlashdata('color', 'danger');
            $session->setFlashdata('mensaje', 'Revise la Información.');
            return redirect()->to(site_url('casillero/editar/' . $id))->withInput();
        }

        $datos = [
            'cedula' => $this->request->getVar('cedula'),
            'nombre' => $this->request->getVar('nombre'),
            'libro_id' => $this->request->getVar('libro_id')
        ];

        $datos = array_map('trim', $datos);

        $this->CasillerosModel->update($id, $datos);

        // MODIFICACIÓN CRÍTICA AQUÍ: Obtener el casillero actualizado con el nombre del libro de forma segura
        $casillero = $this->CasillerosModel->select('casilleros.*, libros.lib_nombre')
                                          ->join('libros', 'libros.lib_id = casilleros.libro_id', 'left')
                                          ->where('casilleros.casillero_id', $id)
                                          ->first();

        $session = session();
        $session->setFlashdata('color', 'success');
        $nombreLibro = $casillero['lib_nombre'] ?? 'Sin libro asignado';
        $session->setFlashdata('mensaje', 'ID: ' . $casillero['casillero_id'] . ' - El casillero de ' . $casillero['nombre'] . ' (Cédula: ' . $casillero['cedula'] . ') con libro "' . $nombreLibro . '" actualizado exitosamente.');

        return $this->response->redirect(site_url('/casillero'));
    }
}