<?php

namespace App\Models;

use CodeIgniter\Model;


class UserModel extends Model
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

    public function joinCs()
    {
        return $this->db->table('projects')
            ->select('*')
            ->where('projects.idcustomer',  session()->get('idcustomer'))
            ->join('customers', 'projects.idcustomer = customers.idcustomer')
            ->get()->getRowArray();

        // $this->db->table('projects');
        // $this->select('*');
        // $this->join('customers', 'projects.idcustomer = customers.idcustomer');
        // $query = $this->get();
        // return $query;
    }
    public function namaProject()
    {
        return $this->db->table('projects')
            ->select('projects.namaproject,projects.uatend,projects.idproject,projects.billstartdate')
            ->where('projects.idcustomer',  session()->get('idcustomer'))
            // ->join('customers', 'projects.idcustomer = customers.idcustomer')
            ->get()->getResultArray();

        // $this->db->table('projects');
        // $this->select('*');
        // $this->join('customers', 'projects.idcustomer = customers.idcustomer');
        // $query = $this->get();
        // return $query;
    }
    public function getUatEnd($idproject)
    {
        return $this->db->table('projects')
            ->select('projects.uatend,projects.idproject')
            ->where('projects.idcustomer',  session()->get('idcustomer') && 'projects.idproject',  $idproject)
            // ->join('customers', 'projects.idcustomer = customers.idcustomer')
            ->get()->getFieldData(['uatend']);

        // $fields = $db->getFieldNames('table_name');

        // foreach ($fields as $field) {
        //     echo $field;
        // }





        // $query->getFieldNames();

        // $this->db->table('projects');
        // $this->select('*');
        // $this->join('customers', 'projects.idcustomer = customers.idcustomer');
        // $query = $this->get();
        // return $query;
    }
    public function csProduct($wperiod)
    {
        return $this->db->table('projects')
            ->where(array('idproject' => $wperiod))
            ->get()->getRowArray();
    }

    public function getProject($csproduct)
    {
        return $this->db->table('projects')
            ->where(array('idproject' => $csproduct))
            ->get()->getRowArray();
    }

    public function getProject1($idcustomer)
    {
        return $this->db->table('projects')
            ->where(array('idcustomer' => $idcustomer))
            ->get()->getRowArray();
    }

    public function csDate($idproject)
    {
        $builder = $this->db->table('projects');
        $builder->select('*');
        $builder->where('idproject', $idproject);
        // $builder->orderBy('uatend');
        $query = $builder->get();
        $output = '';
        foreach ($query->getResult() as $row) {
            $output .= ' <input type="text" id="wperiod" name="wperiod" value="' . $row->uatend . '" until " required>';
        }
        return $output;

        // return $this->db->table('projects')
        //     ->select('uatend')
        //     ->where(array('idproject' => $idproject))
        //     ->orderBy('namaproduct', 'ASC')
        //     ->get()->getRowArray();
    }

    public function getVal($idproject)
    {

        $builder = $this->db->table('projects');
        $builder->db->select('*'); // or select by fields
        // $this->db->from('order_products');
        // $where = array('quantity' => $quan );
        $builder->where('idproject', $idproject);
        // $this->db->where($where);
        $query = $builder->get();
        $output = '<input  value="" />';
        foreach ($query->getResult() as $row) {
            $output .= ' <input  value="' . $row->uatend . '" />';
        }
        return $query;
    }

    public function noTicket($idcustomer)
    {
        return $this->db->table('tickets')
            ->where(array('idcustomer' => 'cs001'))
            ->get()->getResultArray();
    }

    public function csNama($idcs)
    {
        return $this->db->table('customers')
            ->where(array('idcustomer' => $idcs))
            ->get()->getRowArray();
    }

    public function cekVocabs($teks)
    {
        return $this->db->table('vocabs')
            ->where(array('ask' => $teks))
            ->get()->getRowArray();
    }
    public function cekCsProduct($idcustomer)
    {
        return $this->db->table('csproduct')
            ->where(array('idcustomer' => $idcustomer))
            ->get()->getRowArray();
    }
}
