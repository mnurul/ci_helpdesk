<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketsModelM extends Model
{
    protected $table = 'tickets';
    protected $primarykey = 'idtickets';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['password'];

    public function getTicket($idtickets = false)
    {
        $this->db->table('tickets');
        if ($idtickets == false) {
            return $this->findAll();
            // Ga perlu pake else, return langsung keluar dari if
        }

        return $this->where(['idtickets' => $idtickets])->first();
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



    public function search_tickets($search)
    {
        // Metode Chaining
        return $this->table('tickets')->like('noticket', $search)->orLike('ticketstatus', $search)->orLike('problemsummary', $search);
        // $builder = $this->db->table('while_ticket');
        // $builder->like('csnama', $search);
        // // $builder->like('username', $search);
        // // $builder->like('level', $search);
        // // $builder->like('fullname', $search);
        // return $builder;
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
        return $this->table('customers')->like('idcustomer', $search)->orLike('csnama', $search)->orLike('alamat', $search)->orLike('pic', $search)->orLike('email', $search)->orLike('telp', $search)->orLike('csproduct', $search);

        // $array = ['iduser' => $search, 'fullname' => $search, 'level' => $search];
        // return $builder->like($array);
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
