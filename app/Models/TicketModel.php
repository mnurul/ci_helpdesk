<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table = 'while_ticket';
    protected $primarykey = 'id';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['password'];

    public function getTicket($id = false)
    {
        $this->db->table('while_ticket');
        if ($id == false) {
            return $this->findAll();
            // Ga perlu pake else, return langsung keluar dari if
        }

        return $this->where(['id' => $id])->first();
    }

    public function sla()
    {
        $builder = $this->db->table('sla');
        $query   = $builder->get()->getResultArray();
        return $query;
    }

    public function teknisi()
    {
        return $this->db->table('users')
            ->where(array('level' => 'teknisi'))
            ->get()->getResultArray();
    }

    public function statusticket()
    {
        return $this->db->table('while_ticket')
            ->where(array('status' => 'Assigned'))
            ->get()->getResultArray();
    }

    // public function cekUserToken($email)
    // {
    //     return $this->db->table('users')
    //         ->where(array('email' => $email))
    //         ->get()->getRowArray();
    // }

    // public function cekToken($token)
    // {
    //     return $this->db->table('user_tokens')
    //         ->where(array('token' => $token))
    //         ->get()->getRowArray();
    // }

    // public function search($search)
    // {
    //     // $builder = $this->table('users');
    //     // $builder->like('iduser', $search);
    //     // $builder->like('username', $search);
    //     // $builder->like('level', $search);
    //     // $builder->like('fullname', $search);
    //     // return $builder;

    //     // Metode Chaining
    //     return $this->table('users')->like('iduser', $search)->orLike('fullname', $search)->orLike('level', $search)->orLike('username', $search)->orLike('email', $search)->orLike('telp', $search);

    //     // $array = ['iduser' => $search, 'fullname' => $search, 'level' => $search];
    //     // return $builder->like($array);
    // }

    public function search_myassigment($search)
    {
        // Metode Chaining
        return $this->table('while_ticket')->like('csnama', $search)->orLike('csproduct', $search)->orLike('reportby', $search)->orLike('problemsummary', $search)->orLike('problemdetail', $search)->orLike('status', $search);
        // $builder = $this->db->table('while_ticket');
        // $builder->like('csnama', $search);
        // // $builder->like('username', $search);
        // // $builder->like('level', $search);
        // // $builder->like('fullname', $search);
        // return $builder;
    }

    public function viewIduser()
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
            ->orderBy('idcustomer', 'DESC')
            ->limit(1)
            ->get()->getRowArray();
    }

    public function cekPassword($oldpassword)
    {
        return $this->db->table('users')
            ->where(array('password' => $oldpassword))
            ->get()->getRowArray();
    }
}
