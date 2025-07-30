<?php

namespace App\Models;

use CodeIgniter\Model;

class RecursosModel extends Model
{
    protected $table            = 'recursos';
    protected $primaryKey       = 'recurso_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['recurso_nro','recurso_nombre','recurso_cantidad','recurso_tiempo','ocupado'];


}
