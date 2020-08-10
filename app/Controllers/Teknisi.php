<?php

namespace App\Controllers;

use App\Models\TeknisiModel;


class Teknisi extends BaseController
{
    protected $TeknisiModel;

    public function __construct()
    {
        // Termasuk cara oop
        // Cara 2 inisialisasi database
        helper('form');
        $this->session = \Config\Services::session();
        $this->TeknisiModel = new TeknisiModel();
        $this->pager = \Config\Services::pager();
        $this->email = \Config\Services::email();
        $this->form_validation = \Config\Services::validation();
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Home Teknisi'
        ];
        return view('teknisi/index', $data);
    }

    public function my_assigment()
    {

        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $my_assigment = $this->TeknisiModel->search_tickets($search);
        } else {
            $my_assigment = $this->TeknisiModel->where('assigne', session()->get('iduser'));
        }

        $sla = $this->TeknisiModel->sla();
        $count = $this->TeknisiModel->count();

        $data = [
            'title' => 'My Assigment',
            'count' => $count,
            'sla' => $sla,
            'my_assigment' => $my_assigment->paginate(3, 'my_assigment'),
            'pager' => $this->TeknisiModel->pager
        ];
        return view('my_assigment/index', $data);
    }

    public function proses_my_assigment()
    {
        $noticket = $this->request->getVar('noticket');
        $cek = $this->TeknisiModel->cekTicket($noticket);

        // dd($cek);

        $builder = $this->db->table('tickets');
        $builder->where('noticket', $noticket);
        $data = [
            'assignedate' => date("Y-m-d")
        ];
        $builder->update($data);
        session()->setFlashdata('pesan', 'Proses Assigment kamu berhasil');
        return redirect()->to(base_url('/teknisi/my_assigment'));
    }

    public function v_all_ticket()
    {
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $v_all_ticket = $this->TeknisiModel->search_tickets($search);
        } else {
            $v_all_ticket = $this->TeknisiModel->where('assigne', session()->get('iduser'));
        }

        $sla = $this->TeknisiModel->sla();
        $count = $this->TeknisiModel->count();

        $data = [
            'title' => 'View All Ticket',
            'count' => $count,
            'sla' => $sla,
            'v_all_ticket' => $v_all_ticket->paginate(3, 'v_all_ticket'),
            'pager' => $this->TeknisiModel->pager
        ];
        return view('v_all_ticket/index', $data);
    }

    public function change_status_t($idtickets)
    {
        // dd($idtickets);

        $tickets = $this->TeknisiModel->getTicket($idtickets);
        // dd($tickets);
        $data = [
            'title' => 'Change Status Ticket',
            'tickets' => $tickets

        ];
        return view('change_status_t/index', $data);
    }

    public function proses_change_status($idtickets)
    {
        // $idticket = $this->request->getPost('idticket');
        // dd($idtickets);
        $status = $this->request->getPost('status');
        $resolution = $this->request->getPost('resolution');

        $data = [
            'idtickets' => $idtickets,
            'ticketstatus' => $status,
            'resolution' => $resolution,
            'resolveby' => session()->get('iduser'),
            'resolvedate' => date("Y-m-d")

        ];

        // dd($data);

        $builder = $this->db->table('tickets');
        $builder->where('idtickets', $idtickets);
        if ($builder->update($data)) {
            // $builder1 = $this->db->table('v_ticket');
            // $builder1->where('idtickets', $idtickets);
            // $data = [
            //     'ticketstatus' => $status
            // ];
            // $builder1->update($data);
            session()->setFlashdata('pesan', 'Tiket kamu berhasil diubah');
            return redirect()->to(base_url('teknisi/v_all_ticket'));
        } else {
            session()->setFlashdata('failed', 'Tiket kamu belum berhasil diubah');
            return redirect()->to(base_url('teknisi/change_status_t'));
        }
    }

    public function change_password_t()
    {
        $data = [
            'title' => 'Change Password'
        ];
        return view('change_password_t/index', $data);
    }

    public function update_password_t()
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
            return redirect()->to(base_url('/teknisi/change_password_t'));
        } else {
            // $email = session()->get('reset_email');
            $iduser = session()->get('iduser');
            // dd($iduser);
            $cekPassword = $this->TeknisiModel->cekPassword($oldpassword);
            if ($cekPassword) {
                $builder = $this->db->table('users');
                $builder->set('password', $cpassword);
                $builder->where('iduser', $cekPassword['iduser']);
                $builder->update();

                session()->setFlashdata('pesan', 'Password kamu berhasil diubah');
                return redirect()->to(base_url(''));
            } else {
                session()->setFlashdata('pesan', 'Password lama kamu tidak sesuai');
                return redirect()->to(base_url('teknisi/change_password_t'));
            }
            // } else {
            //     session()->setFlashdata('gagalupdate', 'Data belum berhasil diubah');
            //     return redirect()->to(base_url('/login/change_password_u'));
            // }
        }

        //--------------------------------------------------------------------

    }

    //--------------------------------------------------------------------

}
