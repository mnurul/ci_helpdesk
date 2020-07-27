<?php

namespace App\Controllers;

use App\Models\AdminModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Admin extends BaseController
{
    protected $AdminModel;

    public function __construct()
    {
        // Termasuk cara oop
        // Cara 2 inisialisasi database
        helper('form');
        $session = \Config\Services::session();
        $this->AdminModel = new AdminModel();
        $email = \Config\Services::email();
        $this->pager = \Config\Services::pager();
        $this->form_validation = \Config\Services::validation();
        $validation =  \Config\Services::validation();
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
        // if (session()->get('username') == '') {
        //     session()->setFlashdata('salah', 'Kamu harus Login');
        //     return redirect()->to(base_url('/'));
        // }
        $data = [
            'title' => 'Home Admin'
        ];
        return view('admin/index', $data);
    }

    public function my_request()
    {
        $data = [
            'title' => 'My Request'
        ];
        return view('my_request/index', $data);
    }

    public function my_assigment_a()
    {
        $data = [
            'title' => 'My Assigment'
        ];
        return view('my_assigment_a/index', $data);
    }

    public function form_assigment_a()
    {
        $data = [
            'title' => 'Form My Assigment'
        ];
        return view('form_assigment_a/index', $data);
    }

    public function my_resolution()
    {
        $data = [
            'title' => 'My Resolution'
        ];
        return view('my_resolution/index', $data);
    }

    public function w_for_close()
    {
        $data = [
            'title' => 'Waiting for Close'
        ];
        return view('w_for_close/index', $data);
    }

    public function detail_w_for_close()
    {
        $data = [
            'title' => 'Detail Waiting for Close'
        ];
        return view('detail_w_for_close/index', $data);
    }

    public function v_all_ticket_a()
    {
        $data = [
            'title' => 'View All Ticket'
        ];
        return view('v_all_ticket_a/index', $data);
    }

    public function popular_solution()
    {
        $data = [
            'title' => 'Popular Solution'
        ];
        return view('popular_solution/index', $data);
    }

    public function detail_popular_solution()
    {
        $data = [
            'title' => 'Detail Popular Solution'
        ];
        return view('detail_popular_solution/index', $data);
    }

    public function pivot_table_a()
    {
        $data = [
            'title' => 'Pivot Table'
        ];
        return view('pivot_table_a/index', $data);
    }

    public function sla_chart_a()
    {
        $data = [
            'title' => 'SLA Chart'
        ];
        return view('sla_chart_a/index', $data);
    }

    public function add_sla()
    {
        $data = [
            'title' => 'Add New SLA'
        ];
        return view('add_sla/index', $data);
    }

    public function sla_setting_a()
    {
        $data = [
            'title' => 'SLA Setting'
        ];
        return view('sla_setting_a/index', $data);
    }

    public function detail_sla()
    {
        $data = [
            'title' => 'Detail SLA'
        ];
        return view('detail_sla/index', $data);
    }

    public function create_user()
    {
        // $db      = \Config\Database::connect();
        // $builder = $this->db->table('users');

        // $builder->orderBy('iduser', 'DESC');
        // $builder->limit(1);
        // $query   = $builder->get();
        $builder = $this->AdminModel->viewIduser();

        // dd($builder);
        $data = [
            'title' => 'Create User',
            'builder' => $builder

        ];
        return view('create_user/index', $data);
    }

    public function proses_create()
    {
        $iduser = $this->request->getPost('iduser');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $level = $this->request->getPost('level');
        $fullname = $this->request->getPost('fullname');
        $email = $this->request->getPost('email');
        $telp = $this->request->getPost('telp');
        // $emailcode = $this->request->getPost('emailcode');
        $time = $this->request->getPost('time');
        // $confirmed = $this->request->getPost('confirmed');
        $ip = $this->request->getPost('ip');

        $data = [
            'iduser'  => $iduser,
            'username'  => $username,
            'password' => $password,
            'level'  => $level,
            'fullname'  => $fullname,
            'email'  => $email,
            'telp'  => $telp,
            // 'emailcode'  => $emailcode,
            'time'  => $time,
            // 'confirmed'  => $confirmed,
            'ip'  => $ip,
            'is_active' => 0
        ];

        if ($this->form_validation->run($data, 'create_user') == FALSE) {
            // mengembalikan nilai input yang sudah dimasukan sebelumnya
            session()->setFlashdata('inputs', $this->request->getPost());
            // memberikan pesan error pada saat input data
            session()->setFlashdata('errors', $this->form_validation->getErrors());
            // kembali ke halaman form
            return redirect()->to(base_url('/admin/create_user'));
        } else {
            // $db      = \Config\Database::connect();
            $builder = $this->db->table('users');
            $builder->insert($data);

            $builder = $this->db->table('user_tokens');
            $token = base64_encode(random_bytes(32));
            $data = [
                'email' => $email,
                'token' => $token,
                'data_created' => time()
            ];
            $builder->insert($data);

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
            $mail->addAddress($email);
            $mail->addReplyTo('mnurulislam05@gmail.com', 'DIMS'); // silahkan ganti dengan alamat email Anda
            // Content
            $mail->isHTML(true);
            $subject = 'User Activation';
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
                        <h1 id="header" >Hallo, ' . $username . '</h1> 
                    </div><br>
                    <h4 id="desc">Email ini Anda terima atas permintaan untuk mengatur ulang kata<br>sandi akun Anda pada Helpdesk System</h4><br>
                    <div id="bg-btn">
                        <a href=" ' . base_url() . '/admin/user_activation?email=' . $email . '&token=' . urlencode($token) . '" id="btn" target="_blank">User Activation</a>
                    </div><br>
                    <h4 id="desc-1">Jika Anda tidak meminta mengatur ulang kata sandi, silahkan abaikan<br>saja email ini (tidak perlu ditindaklanjuti)</h4><br>
                    <h4 id="footer">Salam hangat,<br><br><br><br>
                    DIMS</h4>
                    
                
                </body> 
                </html>';

            $mail->Subject = $subject;
            $mail->Body    = $htmlContent;

            if ($mail->send()) {
                session()->setFlashdata('pesan', 'User sudah ditambahkan, Silakan kamu aktivasi lewat email');
                return redirect()->to(base_url('/admin/create_user'));
            } else {
                $data = $mail->printDebugger(['headers']);
                // print_r($data);
                session()->setFlashdata('failed', $data);
                return redirect()->to(base_url('/admin/create_user'));
            }

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

            return redirect()->to(base_url('/admin/create_user'));
        }
    }

    public function user_activation()
    {
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $cekUserToken = $this->AdminModel->cekUserToken($email);

        if ($cekUserToken) {
            $cekToken = $this->AdminModel->cekToken($token);

            if ($cekToken) {
                if (time()) {
                    $builder = $this->db->table('users');
                    $builder->set('is_active', 1);
                    $builder->where('email', $email);
                    $builder->update();

                    $builder = $this->db->table('user_tokens');
                    $builder->where('email', $email);
                    $builder->delete();

                    session()->setFlashdata('pesan', $email . ' sudah aktif, kamu bisa login');
                    return redirect()->to(base_url(''));
                } else {
                    $builder = $this->db->table('users');
                    $builder->where('email', $email);
                    $builder->delete();
                    $builder = $this->db->table('user_tokens');
                    $builder->where('email', $email);
                    $builder->delete();
                    session()->setFlashdata('salah', 'User Activation expired');
                    return redirect()->to(base_url(''));
                }
                session()->set('reset_email', $email);

                $data = [
                    'title' => 'Password Baru'
                ];
                // session()->setFlashdata('pesan', 'Data berhasil diubah');
                // return redirect()->to(base_url('/login/change_password_u'));
                return view('change_password_u/index', $data);
            } else {
                session()->setFlashdata('salah', 'User Activation failed, Wrong token');
                return redirect()->to(base_url(''));
            }
        } else {
            session()->setFlashdata('salah', 'User Activation failed, Wrong email');
            return redirect()->to(base_url(''));
        }
    }

    public function list_user()
    {
        // getVar() bisa ambil get dan post
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $user = $this->AdminModel->search($search);
        } else {
            $user = $this->AdminModel;
        }
        $data = [
            'title' => 'List User',
            // 'count' => $this->AdminModel->getUser(),
            'count' => $this->db->table('users')->countAll(),
            // 'user' => $this->AdminModel->paginate(3, 'users'),
            'user' => $user->paginate(3, 'users'),
            'pager' => $this->AdminModel->pager
        ];
        return view('list_user/index', $data);
    }

    public function detail_user($iduser)
    {
        // $iduser = $this->request->getVar('iduser');
        // dd($iduser);

        $data = [
            'title' => 'Detail User',
            'user' => $this->AdminModel->getUser($iduser)
        ];
        // dd($data);
        return view('detail_user/index', $data);
    }

    public function edit_user($iduser)
    {
        $iduser   = $this->request->getPost('iduser');
        $username   = $this->request->getPost('username');
        $level   = $this->request->getPost('level');
        $fullname   = $this->request->getPost('fullname');
        $email   = $this->request->getPost('email');
        $telp   = $this->request->getPost('telp');

        $data = [
            'iduser'  => $iduser,
            'username'  => $username,
            'level'  => $level,
            'fullname'  => $fullname,
            'email'  => $email,
            'telp'  => $telp,
        ];
        // dd($data);

        if ($this->form_validation->run($data, 'edit_user') == FALSE) {
            // mengembalikan nilai input yang sudah dimasukan sebelumnya
            session()->setFlashdata('inputs', $this->request->getPost());
            // memberikan pesan error pada saat input data
            session()->setFlashdata('errors', $this->form_validation->getErrors());
            // kembali ke halaman form
            return redirect()->to(base_url('/admin/list_user'));
        } else {
            $builder = $this->db->table('users');
            $builder->where('iduser', $data['iduser']);
            $builder->update($data);

            session()->setFlashdata('pesan', 'Data kamu berhasil diubah');
            return redirect()->to(base_url('/admin/list_user'));
        }
        session()->setFlashdata('failed', 'Data kamu belum berhasil diubah');
        return redirect()->to(base_url('/admin/list_user'));
    }

    public function delete($iduser)
    {
        // Cara delete konvensional, minus nya bisa dihapus lewat url
        // dd($iduser);
        $this->AdminModel->delete($iduser);
        // primary key iduser ada di model.php (vebdor->codeigniter4->Model.php)
        // $builder = $this->db->table('users');
        // $builder->where('iduser', $iduser);
        // $builder->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('/admin/list_user'));
    }

    public function change_password_a()
    {
        $data = [
            'title' => 'Change Password'
        ];
        return view('change_password_a/index', $data);
    }

    public function update_password_a()
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
            return redirect()->to(base_url('/admin/change_password_a'));
        } else {
            // $email = session()->get('reset_email');
            $iduser = session()->get('iduser');
            // dd($iduser);
            $cekPassword = $this->AdminModel->cekPassword($oldpassword);
            if ($cekPassword) {
                $builder = $this->db->table('users');
                $builder->set('password', $cpassword);
                $builder->where('iduser', $cekPassword['iduser']);
                $builder->update();

                session()->setFlashdata('pesan', 'Password kamu berhasil diubah');
                return redirect()->to(base_url(''));
            } else {
                session()->setFlashdata('pesan', 'Password lama kamu tidak sesuai');
                return redirect()->to(base_url('admin/change_password_a'));
            }
            // } else {
            //     session()->setFlashdata('gagalupdate', 'Data belum berhasil diubah');
            //     return redirect()->to(base_url('/login/change_password_u'));
            // }
        }

        //--------------------------------------------------------------------

    }

    public function create_project()
    {
        $data = [
            'title' => 'Create Project'
        ];
        return view('create_project/index', $data);
    }

    public function change_status()
    {
        $data = [
            'title' => 'Change Status Ticket'
        ];
        return view('change_status/index', $data);
    }

    public function form_status_ticket()
    {
        $data = [
            'title' => 'Form Change Status Ticket'
        ];
        return view('form_status_ticket/index', $data);
    }

    //--------------------------------------------------------------------

}
