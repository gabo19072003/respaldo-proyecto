<?php

namespace App\Models;

use CodeIgniter\Model;

class CargosModel extends Model
{
    protected $table            = 'cargos';
    protected $primaryKey       = 'cargo_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['cargo_name'];

}