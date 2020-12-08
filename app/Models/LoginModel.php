<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'users';
    protected $primarykey = 'iduser';
    protected $useTimestamps = true;
    protected $allowedFields = ['password'];

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

    // public function cekUser($iduser)
    // {
    //     return $this->db->table('users')
    //         ->where(array('iduser' => $iduser))
    //         ->get()->getRowArray();
    // }

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

    public function cekOtp($codeotp)
    {
        return $this->db->table('user_otp')
            ->where(array('otp' => $codeotp))
            ->get()->getRowArray();
    }

    public function cekLevel($email)
    {
        return $this->db->table('users')
            ->where(array('email' => $email))
            ->get()->getRowArray();
    }
}
