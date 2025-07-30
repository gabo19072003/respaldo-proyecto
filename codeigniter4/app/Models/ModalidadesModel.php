<?php

namespace App\Models;

use CodeIgniter\Model;

class ModalidadesModel extends Model
{
    protected $table            = 'modalidades';
    protected $primaryKey       = 'modalidad_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['modalidad_detalles','servicio_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'ocupado';


}
