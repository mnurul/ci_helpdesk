<?php

namespace App\Controllers;

use App\Models\LoginModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Login extends BaseController
{
    protected $komikModel;

    public function __construct()
    {
        // Termasuk cara oop
        // Cara 2 inisialisasi database
        helper('form');
        $session = \Config\Services::session();
        $this->LoginModel = new LoginModel();
        $email = \Config\Services::email();
        $this->form_validation = \Config\Services::validation();
        $this->db      = \Config\Database::connect();
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

            if (isset($cek['is_active']) == 0) {
                session()->setFlashdata('salah', 'Username kamu belum diaktivasi');
                return redirect()->to(base_url('/'));
            } elseif (isset($cek['is_active']) == 1) {
                if ((isset($cek['username']) == $username) && (isset($cek['password']) == $password) && ($cek['level'] == "admin")) {
                    // Jika benar
                    session()->set('iduser', $cek['iduser']);
                    session()->set('username', $cek['username']);
                    session()->set('level', $cek['level']);

                    return redirect()->to(base_url('admin'));
                } elseif ((isset($cek['username']) == $username) && (isset($cek['password']) == $password) && ($cek['level'] == 'teknisi')) {
                    // Jika benar
                    session()->set('iduser', $cek['iduser']);
                    session()->set('username', $cek['username']);
                    session()->set('level', $cek['level']);

                    return redirect()->to(base_url('teknisi'));
                } elseif ((isset($cek['username']) == $username) && (isset($cek['password']) == $password) && ($cek['level'] == 'manager')) {
                    // Jika benar
                    session()->set('iduser', $cek['iduser']);
                    session()->set('username', $cek['username']);
                    session()->set('level', $cek['level']);

                    return redirect()->to(base_url('manager'));
                } elseif ((isset($cek['username']) == $username) && (isset($cek['password']) == $password) && ($cek['level'] == 'customer')) {
                    // Jika benar
                    session()->set('iduser', $cek['iduser']);
                    session()->set('username', $cek['username']);
                    session()->set('level', $cek['level']);

                    return redirect()->to(base_url('user'));
                } else {
                    session()->setFlashdata('salah', 'Username dan Password tidak sesuai');
                    return redirect()->to(base_url('/'));
                }
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
            'title' => 'Lupa Password'
        ];
        return view('forgot_password/index', $data);
    }

    public function forgot_password2()
    {
        $inputEmail = $this->request->getPost('email');
        $cekEmail = $this->LoginModel->cekEmail($inputEmail);
        // dd($cekEmail);

        if ((isset($cekEmail['email']) == $inputEmail)) {

            // $db      = \Config\Database::connect();
            $builder = $this->db->table('user_tokens');
            $token = base64_encode(random_bytes(32));
            $data = [
                'email' => $inputEmail,
                'token' => $token,
                'data_created' => time()
            ];

            // dd($data);
            $builder->insert($data);


            // Jika benar
            session()->set('iduser', $cekEmail['iduser']);
            session()->set('username', $cekEmail['username']);
            session()->set('level', $cekEmail['level']);
            session()->set('email', $cekEmail['email']);

            // $to = $inputEmail;
            // $subject = 'Reset Password';
            // $message = 'Click link below to reset password <br>' . '<a href="' . base_url() . '/login/change_password" target="_blank">Reset Password</a>';
            // $email = \Config\Services::email();
            // $email->setTo($to);
            // $email->setFrom('mnurulislam05@gmail.com', 'DIMS');
            // $email->setSubject($subject);
            // $email->setMessage($message);

            $mail = new PHPMailer(true);


            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.googlemail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mnurulislam05@gmail.com'; // silahkan ganti dengan alamat email Anda
            $mail->Password   = 'nurulislam10'; // silahkan ganti dengan password email Anda
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('mnurulislam05@gmail.com', 'DIMS'); // silahkan ganti dengan alamat email Anda
            $mail->addAddress($inputEmail);
            $mail->addReplyTo('mnurulislam05@gmail.com', 'DIMS'); // silahkan ganti dengan alamat email Anda
            // Content
            $mail->isHTML(true);
            $subject = 'Reset Password';


            $start = '<html><body>';
            $start = '<h4>Hallo </h4>';
            $start .= '<p style="font-size:16px;color:black;">Email ini Anda terima atas permintaan untuk mengatur ulang kata sandi akun Anda pada Helpdesk System</p>';
            $start .= '<p style="color:#080;font-size:18px;">Will you marry me?</p>';
            $start .= '</body></html>';

            $htmlContent = ' 
                <html> 
                <head> 
                    <style>
                        #nav {
                            width:100%;
                            height:80px;
                            background-color:#F8FAFC; 
                        }

                        #header {
                            color:#BBBFC3;
                            margin-left:390px !important;
                            padding-top:25px !important;
                            font-family: Merriweather, serif;
                            font-weight: 700;
                            font-size: 28px;
                            line-height: 34px;
                        }

                        #desc {
                            margin-left:390px !important;
                            color:black;
                        }

                        #bg-btn{
                            width:190px;
                            height:45px;
                            background-color:#244295; 
                            border-radius:5px; 
                            margin-left:510px !important;
                            margin-top:-30px !important;
                        }

                        #btn {
                            color:white;
                            font-size:20px !important;
                            text-decoration:none;
                            margin-top:-50px !important;
                            padding-top:5px !important;
                            padding-left:18px !important;
                            font-family: Merriweather, serif;
                            font-weight: 700;
                            font-size: 28px;
                            line-height: 34px;
                            display:block;
                        }

                        #desc-1 {
                            margin-left:390px !important;
                            color:black;
                        }

                        #footer {
                            margin-left:390px !important;
                            color:#0F0E20;
                        }
                    </style>

                </head> 
                <body>
                    <div id="nav">
                        <h1 id="header" >Hallo, ' . session()->get('username') . '</h1> 
                    </div><br>
                    <h4 id="desc">Email ini Anda terima atas permintaan untuk mengatur ulang kata<br>sandi akun Anda pada Helpdesk System</h4><br>
                    <div id="bg-btn">
                        <a href=" ' . base_url() . '/login/change_password_u?email=' . $inputEmail . '&token=' . urlencode($token) . '" id="btn" target="_blank">Reset Password</a>
                    </div><br>
                    <h4 id="desc-1">Jika Anda tidak meminta mengatur ulang kata sandi, silahkan abaikan<br>saja email ini (tidak perlu ditindaklanjuti)</h4><br>
                    <h4 id="footer">Salam hangat,<br><br><br><br>
                    DIMS</h4>
                    
                
                </body> 
                </html>';

            $mail->Subject = $subject;
            $mail->Body    = $htmlContent;


            // $mail->send();
            // session()->setFlashdata('success', 'Send Email successfully');
            // return redirect()->to(base_url('login/forgot_password'));

            // session()->setFlashdata('error', "Send Email failed. Error: " . $mail->ErrorInfo);
            // return redirect()->to('/kirim_email');


            if ($mail->send()) {
                session()->setFlashdata('send', 'Silakan cek email kamu');
                return redirect()->to(base_url('login/forgot_password'));
            } else {
                $data = $mail->printDebugger(['headers']);
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

    public function change_password_u()
    {
        // Ambil data url

        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        // parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        // $code = $_GET['email'];
        // dd($email, $token);
        // $token = $this->input->get('token');
        $cekUserToken = $this->LoginModel->cekUserToken($email);

        if ($cekUserToken) {
            $cekToken = $this->LoginModel->cekToken($token);

            if ($cekToken) {
                session()->set('reset_email', $email);

                $data = [
                    'title' => 'Password Baru'
                ];
                // session()->setFlashdata('pesan', 'Data berhasil diubah');
                // return redirect()->to(base_url('/login/change_password_u'));
                return view('change_password_u/index', $data);
            } else {
                session()->setFlashdata('salah', 'Wrong token');
                return redirect()->to(base_url('login/forgot_password'));
            }
        } else {
            session()->setFlashdata('salah', 'Reset Password failed, Wrong email');
            return redirect()->to(base_url('login/forgot_password'));
        }
    }

    public function update_password_u()
    {
        // ambil data dari form input
        // $iduser = $this->request->getPost('iduser');
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');

        $data = [
            'password' => $password,
            'cpassword'  => $cpassword
        ];
        // dd($data);
        // $session_id = $this->session->userdata('iduser');

        if ($this->form_validation->run($data, 'change_password') == FALSE) {
            // mengembalikan nilai input yang sudah dimasukan sebelumnya
            session()->setFlashdata('inputs', $this->request->getPost());
            // memberikan pesan error pada saat input data
            session()->setFlashdata('errors', $this->form_validation->getErrors());
            // kembali ke halaman form
            return redirect()->to(base_url('/login/change_password_u'));
        } else {
            // $cek = $this->LoginModel->cekUser($this->request->getVar('iduser'));
            // $cekUser = $this->LoginModel->cekUser($iduser);
            // dd($cek);
            // $cpassword = password_hash($cpassword, PASSWORD_DEFAULT);
            $email = session()->get('reset_email');
            $cekEmail = $this->LoginModel->cekEmail($email);
            // $db      = \Config\Database::connect();
            $builder = $this->db->table('users');
            $builder->set('password', $cpassword);
            $builder->where('iduser', $cekEmail['iduser']);
            $builder->update();
            // $this->LoginModel->save([
            //     'iduser' => $cekEmail['iduser'],
            //     'judul' => $this->request->getVar('judul'),
            //     'slug' => $slug,
            //     'penulis' => $this->request->getVar('penulis'),
            //     'penerbit' => $this->request->getVar('penerbit'),
            //     'sampul' => $this->request->getVar('sampul')
            // ]);


            // if ((isset($cekUser['iduser']) == $iduser)) {
            //     $db      = \Config\Database::connect();
            //     $builder = $db->table('users');


            //     $builder->set('password', 'password+1', FALSE);
            //     $builder->where('iduser', $iduser);
            //     $builder->update(); // gives UPDATE mytable SET field = field+1 WHERE `id` = 2


            // $this->LoginModel->save([
            //     'iduser' => $iduser,
            //     'cpassword' => $this->request->getVar('cpassword')


            // ]);
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to(base_url(''));
            // } else {
            //     session()->setFlashdata('gagalupdate', 'Data belum berhasil diubah');
            //     return redirect()->to(base_url('/login/change_password_u'));
            // }
        }
        session()->setFlashdata('gagalupdate', 'Data belum berhasil diubah');
        return redirect()->to(base_url('/login/change_password_u'));
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
