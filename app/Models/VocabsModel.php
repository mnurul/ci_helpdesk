<?php

namespace App\Models;

use CodeIgniter\Model;

class VocabsModel extends Model
{
    protected $table = 'vocabs';
    protected $primarykey = 'idvocab';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['password'];

    function search($tanya)
    {


        // $this->db->like('blog_title', $title , 'both');
        // $this->db->order_by('blog_title', 'ASC');
        // $this->db->limit(10);
        // return $this->db->get('blog')->result();

        // return $this->table('vocabs')->like('vocab', $tanya);
        return $this->db->table('vocabs')
            ->like('ask', $tanya)
            ->orderBy('ask', 'DESC')
            ->limit(10)
            ->get()->getResult();
    }
}
