<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['user','user_passwd','user_name','user_lastname','user_email','rol_id','user_active','persona_id','user_token','user_reset_token','user_reset_expires_at'];

    protected bool $allowEmptyInserts = false;
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function validateUser($user, $password){
        $user = $this->where(['user' => $user, 'user_active' => 1])->first();
        if($user && password_verify($password, $user['user_passwd'])){
            return $user;
        }

        return null;
    }

    public function validateClave($password){
        $user = $this->where(['user_id' => $_SESSION['userid']])->first();
        if($user && password_verify($password, $user['user_passwd'])){
            return $user;
        }

        return null;
    }


}
