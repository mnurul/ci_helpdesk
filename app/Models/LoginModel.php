<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'users';
    protected $primarykey = 'iduser';
    protected $useTimestamps = true;

    public function cekLogin($username, $password)
    {
        return $this->db->table('users')
            ->where(array('username' => $username, 'password' => $password))
            ->get()->getRowArray();
    }

    public function cekEmail($inputEmail)
    {
        return $this->db->table('users')
            ->where(array('email' => $inputEmail))
            ->get()->getRowArray();
    }

    public function getUser($iduser = false)
    {
        if ($iduser == false) {
            return $this->findAll();
            // Ga perlu pake else, return langsung keluar dari if
        }

        return $this->where(['iduser' => $iduser])->first();
    }
}
