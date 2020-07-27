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
        $session = \Config\Services::session();
        $this->TeknisiModel = new TeknisiModel();
        $email = \Config\Services::email();
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
        $data = [
            'title' => 'My Assigment'
        ];
        return view('my_assigment/index', $data);
    }

    public function v_all_ticket()
    {
        $data = [
            'title' => 'View All Ticket'
        ];
        return view('v_all_ticket/index', $data);
    }

    public function change_status_t()
    {
        $data = [
            'title' => 'Change Status Ticket'
        ];
        return view('change_status_t/index', $data);
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
