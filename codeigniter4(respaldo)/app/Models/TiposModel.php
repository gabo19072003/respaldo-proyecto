<?php

namespace App\Models;

use CodeIgniter\Model;

class TiposModel extends Model
{
    protected $table            = 'tipos';
    protected $primaryKey       = 'tipo_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tipo_name'];

}