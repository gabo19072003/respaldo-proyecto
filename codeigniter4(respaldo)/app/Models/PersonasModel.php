<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonasModel extends Model
{
    protected $table            = 'personas';
    protected $primaryKey       = 'persona_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['persona_nombre','persona_apellido','persona_fch_nacimi','persona_carnet','persona_ci','persona_sexo','persona_tf','persona_email','persona_foto','cargo_id','tipo_id','user_id','direccion'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

     public function validarpersona($carnet){
        $persona = $this->where(['persona_carnet' => $carnet])->first();
        if($persona && is_array($persona) && isset($persona['persona_id'])){
            return $persona;
        }
        return null;
    }

    public function validaresponsable($cedula){
        $persona = $this->where(['persona_ci' => $cedula])->first();
        if($persona && is_array($persona) && isset($persona['persona_id'])){
            return $persona;
        }
        return null;
    }


}