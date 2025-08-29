<?php

namespace App\Models;

use CodeIgniter\Model;

class CasillerosModel extends Model
{
    protected $table            = 'casilleros';
    protected $primaryKey       = 'casillero_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    // **MODIFICACIÓN AQUÍ:** Añadimos 'libro_id' a los campos permitidos
    protected $allowedFields    = ['cedula', 'nombre', 'casillero_detalles', 'libro_id']; 

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'ocupado';

    // **NUEVO MÉTODO:** Para obtener los casilleros junto con el nombre del libro
    public function getCasillerosWithLibro()
    {
        // Realizamos un JOIN con la tabla 'libros' para obtener el 'lib_nombre'
        // Usamos un 'left' join porque un casillero puede no tener un libro asignado (libro_id es NULL)
        return $this->select('casilleros.*, libros.lib_nombre')
                    ->join('libros', 'libros.lib_id = casilleros.libro_id', 'left')
                    ->where('casilleros.ocupado', NULL) // Mantenemos la condición de no "ocupado" (soft-deleted)
                    ->orderBy('casilleros.casillero_id', 'ASC')
                    ->findAll();
    }
}