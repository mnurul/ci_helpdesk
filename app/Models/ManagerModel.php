<?php

namespace App\Models;

use CodeIgniter\Model;

class ManagerModel extends Model
{
    protected $table = 'tickets';
    protected $primarykey = 'idtickets';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['password'];

    public function cekPassword($oldpassword)
    {
        return $this->db->table('users')
            ->where(array('password' => $oldpassword))
            ->get()->getRowArray();
    }

    public function getTicket($idtickets = false)
    {
        $this->db->table('tickets');
        if ($idtickets == false) {
            return $this->findAll();
            // Ga perlu pake else, return langsung keluar dari if
        }

        return $this->where(['idtickets' => $idtickets])->first();
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

    public function sla($idtickets = false)
    {
        // $builder = $this->db->table('sla');
        // $builder = $this->db->table('customers');
        // $builder->select('*');
        // $builder->join('tickets', 'tickets.idsla = sla.idsla');
        // $builder->join('tickets', 'tickets.idcustomer = customers.idcustomer');
        // $query = $builder->get()->getResultArray();
        // return $query;

        return $this->db->table('tickets')
            ->join('users', 'users.iduser = tickets.assigne')
            ->join('master', 'master.idcustomer = tickets.idcustomer')
            ->join('sla', 'sla.idsla = tickets.idsla')
            ->get()->getResultArray();
    }
}
