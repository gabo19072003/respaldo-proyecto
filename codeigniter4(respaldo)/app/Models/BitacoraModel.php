<?php

namespace App\Models;

use CodeIgniter\Model;

class BitacoraModel extends Model
{
    protected $table            = 'bitacora';
    protected $primaryKey       = 'bitacora_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['bitacora_ip','bitacora_detalles','user'];
    
}
