<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    private $_table = "users";
    protected $useTimestamps = true;
    protected $allowedFields = ['email'];

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
}
