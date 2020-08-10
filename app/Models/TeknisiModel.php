<?php

namespace App\Models;

use CodeIgniter\Model;

class TeknisiModel extends Model
{
    protected $table = 'v_ticket';
    // protected $primarykey = 'idtickets';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['password'];

    public function cekPassword($oldpassword)
    {
        return $this->db->table('users')
            ->where(array('password' => $oldpassword))
            ->get()->getRowArray();
    }

    public function search_tickets($search)
    {

        // Metode Chaining
        return $this->table('v_ticket')
            ->where(array('assigne' => session()->get('iduser')))
            ->like('noticket', $search)->orLike('ticketstatus', $search)->orLike('problemsummary', $search)->orLike('namasla', $search)->orLike('csnama', $search)->orLike('assigne', $search)->orLike('username', $search);

        // return $this->db->table('v_ticket')
        //     ->join('users', 'users.iduser = tickets.assigne')
        //     ->join('master', 'master.idcustomer = tickets.idcustomer')
        //     ->join('sla', 'sla.idsla = tickets.idsla')
        //     ->where(array('assigne' => session()->get('iduser')))
        //     ->like('noticket', $search)->orLike('ticketstatus', $search)->orLike('problemsummary', $search)
        //     ->get()->getResultArray();
    }

    public function sla()
    {
        // $builder = $this->db->table('sla');
        // $builder = $this->db->table('customers');
        // $builder->select('*');
        // $builder->join('tickets', 'tickets.idsla = sla.idsla');
        // $builder->join('tickets', 'tickets.idcustomer = customers.idcustomer');
        // $query = $builder->get()->getResultArray();
        // return $query;

        // return $this->db->table('tickets')
        //     ->join('users', 'users.iduser = tickets.assigne')
        //     ->join('master', 'master.idcustomer = tickets.idcustomer')
        //     ->join('sla', 'sla.idsla = tickets.idsla')
        //     ->where(array('assigne' => session()->get('iduser')))
        //     ->get()->getResultArray();
        return $this->db->table('v_ticket')
            ->where(array('assigne' => session()->get('iduser')))
            ->get()->getResultArray();
    }

    public function count()
    {
        return $this->db->table('v_ticket')
            ->where(array('assigne' => session()->get('iduser')))
            ->countAllResults();
    }

    public function cekTicket($noticket)
    {
        return $this->db->table('tickets')
            ->where(array('noticket' => $noticket))
            ->get()->getRowArray();
    }
}
