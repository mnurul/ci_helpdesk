<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'v_project';
    // protected $primarykey = 'id';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['password'];

    public function getProject($idproject = false)
    {
        $this->db->table('v_project');
        if ($idproject == false) {
            return $this->findAll();
            // Ga perlu pake else, return langsung keluar dari if
        }

        return $this->where(['idproject' => $idproject])->first();
    }

    public function getCustomer()
    {
        return $this->db->table('customers')->get()->getResultArray();

        // return $this->findAll();
        // Ga perlu pake else, return langsung keluar dari if


    }

    public function viewIdproject()
    {
        // $builder = $this->db->table('users');
        // $builder->get();
        // $builder->orderBy('iduser', 'DESC');
        // $builder->limit(1);
        // return $builder;

        // return $this->first();
        // Ga perlu pake else, return langsung keluar dari if


        // return $this->where(['iduser' => $iduser])->first();

        return $this->db->table('projects')
            ->orderBy('idproject', 'DESC')
            ->limit(1)
            ->get()->getRowArray();
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

    public function search_project($search)
    {

        // Metode Chaining
        return $this->table('v_project')
            // ->where(array('assigne' => session()->get('iduser')))
            ->like('idproject', $search)->orLike('namaproject', $search)->orLike('csnama', $search)->orLike('warantyperiod', $search)->orLike('contractenddate', $search)
            ->distinct();

        // return $this->db->table('v_ticket')
        //     ->join('users', 'users.iduser = tickets.assigne')
        //     ->join('master', 'master.idcustomer = tickets.idcustomer')
        //     ->join('sla', 'sla.idsla = tickets.idsla')
        //     ->where(array('assigne' => session()->get('iduser')))
        //     ->like('noticket', $search)->orLike('ticketstatus', $search)->orLike('problemsummary', $search)
        //     ->get()->getResultArray();
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
