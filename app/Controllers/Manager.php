<?php

namespace App\Controllers;

use App\Models\ManagerModel;
use App\Models\TeknisiModel;


class Manager extends BaseController
{
    protected $ManagerModel;
    protected $TeknisiModel;

    public function __construct()
    {
        // Termasuk cara oop
        // Cara 2 inisialisasi database
        helper('form');
        $session = \Config\Services::session();
        $this->ManagerModel = new ManagerModel();
        $this->TeknisiModel = new TeknisiModel();
        $this->pager = \Config\Services::pager();
        $email = \Config\Services::email();
        $this->form_validation = \Config\Services::validation();
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Home Manager'
        ];
        return view('manager/index', $data);
    }

    public function v_all_ticket_m()
    {
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $tickets = $this->TeknisiModel->search_tickets($search);
        } else {
            // $tickets = $this->ManagerModel;
            $tickets = $this->TeknisiModel;
        }
        // dd($manager);



        $sla = $this->TeknisiModel->sla();
        // dd($sla);


        $data = [
            'title' => 'View All Ticket',
            'count' => $this->db->table('v_ticket')->countAll(),
            'sla' => $sla,
            // 'statusticket' => $statusticket,
            'tickets' => $tickets->paginate(3, 'tickets'),
            'pager' => $this->TeknisiModel->pager
        ];
        return view('v_all_ticket_m/index', $data);
    }

    public function pivot_table()
    {
        $sql = "SELECT csproduct,COUNT(csproduct) AS jum FROM while_ticket GROUP BY csproduct";
        $chart = $this->db->query($sql)->getResult('array');

        $data = [
            'title' => 'Pivot Table',
            'chart' => $chart
        ];
        return view('pivot_table/index', $data);
    }

    public function sla_chart()
    {
        $data = [
            'title' => 'SLA Chart'
        ];
        return view('sla_chart/index', $data);
    }

    public function change_password_m()
    {
        $data = [
            'title' => 'Change Password'
        ];
        return view('change_password_m/index', $data);
    }

    public function update_password_m()
    {
        $oldpassword = $this->request->getPost('oldpassword');
        $newpassword = $this->request->getPost('newpassword');
        $cpassword = $this->request->getPost('cpassword');

        $data = [
            'oldpassword' => $oldpassword,
            'newpassword' => $newpassword,
            'cpassword'  => $cpassword
        ];

        if ($this->form_validation->run($data, 'change_password_u') == FALSE) {
            // mengembalikan nilai input yang sudah dimasukan sebelumnya
            session()->setFlashdata('inputs', $this->request->getPost());
            // memberikan pesan error pada saat input data
            session()->setFlashdata('errors', $this->form_validation->getErrors());
            // kembali ke halaman form
            return redirect()->to(base_url('/manager/change_password_m'));
        } else {
            // $email = session()->get('reset_email');
            $iduser = session()->get('iduser');
            // dd($iduser);
            $cekPassword = $this->ManagerModel->cekPassword($oldpassword);
            if ($cekPassword) {
                $builder = $this->db->table('users');
                $builder->set('password', $cpassword);
                $builder->where('iduser', $cekPassword['iduser']);
                $builder->update();

                session()->setFlashdata('pesan', 'Password kamu berhasil diubah');
                return redirect()->to(base_url(''));
            } else {
                session()->setFlashdata('pesan', 'Password lama kamu tidak sesuai');
                return redirect()->to(base_url('manager/change_password_m'));
            }
            // } else {
            //     session()->setFlashdata('gagalupdate', 'Data belum berhasil diubah');
            //     return redirect()->to(base_url('/login/change_password_u'));
            // }
        }

        //--------------------------------------------------------------------

    }
}
