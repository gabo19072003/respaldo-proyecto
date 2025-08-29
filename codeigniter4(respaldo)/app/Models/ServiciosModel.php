<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiciosModel extends Model
{
    protected $table            = 'servicios';
    protected $primaryKey       = 'servicio_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['servicio_detalles'];

     // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'ocupado';


}
