<?php

namespace App\Models;

use CodeIgniter\Model;

class TeknisiModel extends Model
{
    // protected $table = 'users';
    // protected $primarykey = 'iduser';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['password'];

    public function cekPassword($oldpassword)
    {
        return $this->db->table('users')
            ->where(array('password' => $oldpassword))
            ->get()->getRowArray();
    }
}
