<?php

namespace App\Models;

use CodeIgniter\Model;

class EventosModel extends Model
{
    protected $table            = 'eventos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title','start','end','lugar','color','detalles','responsable','estado'];

}
