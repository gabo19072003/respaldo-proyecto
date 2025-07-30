<?php

namespace App\Models;

use CodeIgniter\Model;

class SesionesModel extends Model
{
    protected $table            = 'sesiones';
    protected $primaryKey       = 'sesion_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['sesion_titulo','sesion_inicial','sesion_final','casillero_id','cubiculo_id','recurso_id','servicio_id','modalidad_id','persona_id','user_id','tiempo','cantidad'];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
