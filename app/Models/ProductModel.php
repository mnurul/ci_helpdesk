<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'v_customers';
    // protected $primarykey = 'idcustomer';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['password'];

    public function getProduct($idcustomer = false)
    {
        $this->db->table('csproduct');
        if ($idcustomer == false) {
            return $this->findAll();
            // Ga perlu pake else, return langsung keluar dari if
        }

        return $this->where(['idcustomer' => $idcustomer])->first();
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

    public function search($search)
    {
        // $builder = $this->table('users');
        // $builder->like('iduser', $search);
        // $builder->like('username', $search);
        // $builder->like('level', $search);
        // $builder->like('fullname', $search);
        // return $builder;

        // Metode Chaining
        return $this->table('users')->like('iduser', $search)->orLike('fullname', $search)->orLike('level', $search)->orLike('username', $search)->orLike('email', $search)->orLike('telp', $search);

        // $array = ['iduser' => $search, 'fullname' => $search, 'level' => $search];
        // return $builder->like($array);
    }

    public function search_cs($search)
    {
        // $builder = $this->table('users');
        // $builder->like('iduser', $search);
        // $builder->like('username', $search);
        // $builder->like('level', $search);
        // $builder->like('fullname', $search);
        // return $builder;

        // Metode Chaining
        return $this->table('v_customers')->like('idcustomer', $search)->orLike('csproduct', $search);

        // $array = ['iduser' => $search, 'fullname' => $search, 'level' => $search];
        // return $builder->like($array);
    }

    public function getCustomers()
    {
        // $builder = $this->db->table('users');
        // $builder->get();
        // $builder->orderBy('iduser', 'DESC');
        // $builder->limit(1);
        // return $builder;

        // return $this->first();
        // Ga perlu pake else, return langsung keluar dari if


        // return $this->where(['iduser' => $iduser])->first();

        return $this->db->table('customers')
            ->get()->getResultArray();
    }

    public function cekPassword($oldpassword)
    {
        return $this->db->table('users')
            ->where(array('password' => $oldpassword))
            ->get()->getRowArray();
    }
}
