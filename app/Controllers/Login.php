<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
    protected $komikModel;

    public function __construct()
    {
        // Termasuk cara oop
        // Cara 2 inisialisasi database
        helper('form');
        $this->LoginModel = new LoginModel();
        $email = \Config\Services::email();
        $this->form_validation = \Config\Services::validation();
        $db      = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('login/index', $data);
    }

    public function cekLogin()
    {
        // ambil data dari form input
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = [
            'username'  => $username,
            'password' => $password
        ];

        if ($this->form_validation->run($data, 'user') == FALSE) {
            // mengembalikan nilai input yang sudah dimasukan sebelumnya
            session()->setFlashdata('inputs', $this->request->getPost());
            // memberikan pesan error pada saat input data
            session()->setFlashdata('errors', $this->form_validation->getErrors());
            // kembali ke halaman form
            return redirect()->to(base_url('/'));
        } else {
            $cek = $this->LoginModel->cekLogin($username, $password);
            // dd($cek);
            // echo $cek['username'];
            // echo $cek['level'];
            // dd($cek);

            if ((isset($cek['username']) == $username) && (isset($cek['password']) == $password) && ($cek['level'] == "admin")) {
                // Jika benar
                session()->set('username', $cek['username']);
                session()->set('level', $cek['level']);

                return redirect()->to(base_url('admin'));
            } elseif ((isset($cek['username']) == $username) && (isset($cek['password']) == $password) && ($cek['level'] == 'teknisi')) {
                // Jika benar
                session()->set('username', $cek['username']);
                session()->set('level', $cek['level']);

                return redirect()->to(base_url('teknisi'));
            } elseif ((isset($cek['username']) == $username) && (isset($cek['password']) == $password) && ($cek['level'] == 'manager')) {
                // Jika benar
                session()->set('username', $cek['username']);
                session()->set('level', $cek['level']);

                return redirect()->to(base_url('manager'));
            } elseif ((isset($cek['username']) == $username) && (isset($cek['password']) == $password) && ($cek['level'] == 'customer')) {
                // Jika benar
                session()->set('username', $cek['username']);
                session()->set('level', $cek['level']);

                return redirect()->to(base_url('user'));
            } else {
                session()->setFlashdata('salah', 'Username dan Password tidak sesuai');
                return redirect()->to(base_url('/'));
            }
        }
    }

    public function logout()
    {
        session()->remove('username');
        session()->remove('level');
        session()->remove('logout', 'Kamu sudah logout');
        return redirect()->to(base_url('/'));
    }

    public function forgot_password()
    {
        $data = [
            'title' => 'Lupa Password',
        ];
        return view('forgot_password/index', $data);
    }

    public function forgot_password2()
    {
        $inputEmail = $this->request->getPost('email');
        $cekEmail = $this->LoginModel->cekEmail($inputEmail);
        // dd($cek);

        if ((isset($cekEmail['email']) == $inputEmail)) {
            // Jika benar
            session()->set('username', $cekEmail['username']);
            session()->set('level', $cekEmail['level']);
            session()->set('email', $cekEmail['email']);

            $to = $inputEmail;
            $subject = 'Reset Password';
            $message = 'Click link below to reset password <br>' . '<a href="' . base_url() . '/login/change_password" target="_blank">Reset Password</a>';
            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('mnurulislam05@gmail.com', 'DIMS');
            $email->setSubject($subject);
            $email->setMessage($message);
            if ($email->send()) {
                session()->setFlashdata('send', 'Silakan cek email');
                return redirect()->to(base_url('login/forgot_password'));
            } else {
                $data = $email->printDebugger(['headers']);
                // print_r($data);
                session()->setFlashdata('send', $data);
                return redirect()->to(base_url('login/forgot_password'));
            }

            return redirect()->to(base_url('login/forgot_password'));
        } else {
            session()->setFlashdata('salah', 'Email tidak terdaftar');
            return redirect()->to(base_url('login/forgot_password'));
        }
    }

    // public function forgot_password1()
    // {
    //     $email1 = $this->request->getPost('email');
    //     $user = $this->LoginModel->cekEmail($email1);
    //     $user = $this->db->get_where('user', ['email' => $email])->row_array();
    //     if ($user) {
    //         $token = base64_encode(random_bytes(32));
    //         $user_token = [
    //             'email' => $email,
    //             'token' => $token,
    //             'data_created' => time()
    //         ];
    //         $this->LoginModel->save([
    //             'email' => $this->request->getVar('email'),
    //             'token' => $token
    //         ]);

    //         $this->db->insert('user_tokens', $user_token);

    //         $email = \Config\Services::email();
    //         $email->setFrom('mnurulislam05@gmail.com', 'DIMS');
    //         $email->setTo($email1);
    //         $email->setSubject('Reset Password Test');
    //         $email->setMessage('

    //             ');

    //         $email->send();

    //         $this->sendEmail($token, 'forgot');

    //         $this->session->set_flashdata('message', '');
    //         redirect('forgot_password/index');
    //     } else {
    //         $this->session->set_flashdata('message', '');
    //         redirect('forgot_password/index');
    //     }
    // }

    // public function reset_password()
    // {
    //     $email = $this->input->get('email');
    //     $token = $this->input->get('token');

    //     $user = $this->db->get_where('user', ['email' => $email])->row_array();

    //     if ($user) {
    //         $user_token = $this->db->get_where('user_tokens', ['token' => $token])->row_array();
    //         if ($user_token) {
    //             $this->session->set_userdata('reset_email', $email);
    //             $this->change_password();
    //         } else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed</div>');
    //             redirect('base_url()');
    //         }
    //     } else {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed, email wrong</div>');
    //         redirect('base_url()');
    //     }
    // }

    // public function change_password()
    // {
    //     if (!$this->session->userdata('reset_email')) {
    //         redirect('base_url()');
    //     }
    //     $this->form_validation->set_rules('new-password', 'Password', 'trim|required|min_length[3]');
    //     $this->form_validation->set_rules('r-new-password', 'Password', 'trim|required|min_length[3]|matches[new-password]');
    //     if ($this->form_validation->run() == false) {
    //         $data = [
    //             'title' => 'Lupa Password',
    //         ];
    //         return view('change_password_u/index', $data);
    //     } else {
    //         $password = password_hash($this->input->post('r-new-password'), PASSWORD_DEFAULT);
    //         $email = $this->session->userdata('reset_email');

    //         $this->db->set('password', $password);
    //         $this->db->where('email', $email);
    //         $this->db->update('user');

    //         $this->session->unset_userdata('reset_email');
    //         $this->db->delete('user_tokens', ['email' => $email]);

    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password change</div>');
    //         redirect('base_url()');
    //     }
    // }
}



    //--------------------------------------------------------------------
