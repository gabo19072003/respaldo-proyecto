<?php

namespace App\Models;

use CodeIgniter\Model;

class CubiculosModel extends Model
{
    protected $table            = 'cubiculos';
    protected $primaryKey       = 'cubiculo_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['cubiculo_nro','cubiculo_ubicacion','cubiculo_escritorio','cubiculo_silla','cubiculo_ventana','cubiculo_redes','cubiculo_detalles','cubiculo_espacioso'];
}
