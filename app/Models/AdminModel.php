<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'users';
    protected $primarykey = 'iduser';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['password'];

    public function getUser($iduser = false)
    {
        if ($iduser == false) {
            return $this->findAll();
            // Ga perlu pake else, return langsung keluar dari if
        }

        return $this->where(['iduser' => $iduser])->first();
    }

    public function cekUserToken($email)
    {
        return $this->db->table('users')
            ->where(array('email' => $email))
            ->get()->getRowArray();
    }

    public function cekToken($token)
    {
        return $this->db->table('user_tokens')
            ->where(array('token' => $token))
            ->get()->getRowArray();
    }
}
