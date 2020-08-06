<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TicketModel;
use CodeIgniter\I18n\Time;


class User extends BaseController
{
    // public function index()
    // {
    //     $data = [
    //         'title' => 'Home User'
    //     ];
    //     return view('user/index', $data);
    // }

    protected $UserModel;
    protected $TicketModel;


    public function __construct()
    {
        // Termasuk cara oop
        // Cara 2 inisialisasi database
        helper('form');
        helper('url');
        $session = \Config\Services::session();
        $this->UserModel = new UserModel();
        $this->TicketModel = new TicketModel();
        $email = \Config\Services::email();
        $this->form_validation = \Config\Services::validation();
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $while_ticket = $this->TicketModel->search_myassigment($search);
        } else {
            $while_ticket = $this->TicketModel;
        }
        // $idcustomer = session()->get('idcustomer');
        // // dd($idcustomer);
        // $noTicket = $this->UserModel->noTicket($idcustomer);
        // dd($noTicket);

        $data = [
            'title' => 'View Ticket Status',
            'count' => $this->db->table('while_ticket')->countAll(),
            // 'statusticket' => $statusticket,
            'while_ticket' => $while_ticket->paginate(3, 'while_ticket'),
            'pager' => $this->TicketModel->pager,
            // 'noTikcet' => $noTicket
        ];
        return view('v_ticket_status/index', $data);
    }



    public function create_ticket()
    {
        $csnama = $this->UserModel->joinCs();
        $namaProject = $this->UserModel->namaProject();
        // dd($namaProject);
        $rdate = new Time('now');

        $data = [
            'title' => 'Create Ticket',
            'csnama' => $csnama,
            'rdate' => $rdate,
            'namaProject' => $namaProject,
            'getUatEnd' => ''
        ];
        return view('create_ticket/index', $data);
    }

    public function proses_create()
    {
        $customers = $this->request->getPost('customers');
        $csproduct = $this->request->getPost('csproduct');
        $wperiod = $this->request->getPost('wperiod');
        $cperiod = $this->request->getPost('cperiod');
        $rdate = $this->request->getPost('rdate');
        $rby = $this->request->getPost('rby');
        $psummary = $this->request->getPost('psummary');
        $pdetail = $this->request->getPost('pdetail');

        $getProject = $this->UserModel->getProject($csproduct);


        $data = [
            'csnama' => $customers,
            'csproduct' => $getProject['namaproject'],
            'warantyperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject['uatend']))),
            'contractperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject['billstartdate']))),
            'reportdate'  => $rdate,
            'reportby'  => $rby,
            'problemsummary'  => $psummary,
            'problemdetail'  => $pdetail,
            'idcustomer' => session()->get('idcustomer')

        ];

        // dd($data);

        $builder = $this->db->table('while_ticket');
        if ($builder->insert($data)) {
            session()->setFlashdata('pesan', 'Ticket kamu berhasil dibuat');
            return redirect()->to(base_url('/user/create_ticket'));
        } else {
            session()->setFlashdata('failed', 'Ticket kamu belum berhasil dibuat');
            return redirect()->to(base_url('/user/create_ticket'));
        }
    }

    public function change_password()
    {
        $data = [
            'title' => 'Change Password'
        ];
        return view('change_password/index', $data);
    }

    public function update_password_u()
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
            return redirect()->to(base_url('/user/change_password'));
        } else {
            // $email = session()->get('reset_email');
            $iduser = session()->get('iduser');
            // dd($iduser);
            $cekPassword = $this->UserModel->cekPassword($oldpassword);
            if ($cekPassword) {
                $builder = $this->db->table('users');
                $builder->set('password', $cpassword);
                $builder->where('iduser', $cekPassword['iduser']);
                $builder->update();

                session()->setFlashdata('pesan', 'Password kamu berhasil diubah');
                return redirect()->to(base_url(''));
            } else {
                session()->setFlashdata('pesan', 'Password lama kamu tidak sesuai');
                return redirect()->to(base_url('user/change_password'));
            }
            // } else {
            //     session()->setFlashdata('gagalupdate', 'Data belum berhasil diubah');
            //     return redirect()->to(base_url('/login/change_password_u'));
            // }
        }
    }

    public function v_ticket_status()
    {
        $data = [
            'title' => 'View Ticket Status'
        ];
        return view('v_ticket_status/index', $data);
    }

    //--------------------------------------------------------------------

}
