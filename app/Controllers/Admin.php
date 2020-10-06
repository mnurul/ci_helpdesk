<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CustomerModel;
use App\Models\TicketModel;
use App\Models\TeknisiModel;
use App\Models\ProjectModel;
use App\Models\ProductModel;
use App\Models\CorrectWordModel;
use App\Models\EdcModel;
use App\Models\VocabsModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Admin extends BaseController
{
    protected $AdminModel;
    protected $CustomerModel;
    protected $TicketModel;
    protected $TeknisiModel;
    protected $ProjectModel;
    protected $ProductModel;
    protected $CorrectWordModel;
    protected $EdcModel;
    protected $VocabsModel;

    public function __construct()
    {
        // Termasuk cara oop
        // Cara 2 inisialisasi database
        helper('form');
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        $this->AdminModel = new AdminModel();
        $this->CustomerModel = new CustomerModel();
        $this->TicketModel = new TicketModel();
        $this->TeknisiModel = new TeknisiModel();
        $this->ProjectModel = new ProjectModel();
        $this->ProductModel = new ProductModel();
        $this->CorrectWordModel = new CorrectWordModel();
        $this->EdcModel = new EdcModel();
        $this->VocabsModel = new VocabsModel();
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
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $while_ticket = $this->TicketModel->search_myassigment($search);
        } else {
            $while_ticket = $this->TicketModel;
        }
        // $statusticket = $this->TicketModel->statusticket();
        // $builder = $this->db->table('while_ticket');
        // foreach ($builder->get()->getResultArray() as $b) {
        //     $b['status'];
        // }
        // dd($b);

        // dd($statusticket);
        // $builder = $this->db->table('customers');
        // $query   = $builder->get();
        $data = [
            'title' => 'My Assigment',
            // 'query' => $query,
            'count' => $this->db->table('while_ticket')->countAll(),
            // 'statusticket' => $statusticket,
            'while_ticket' => $while_ticket->paginate(3, 'while_ticket'),
            'pager' => $this->TicketModel->pager
        ];
        return view('my_assigment_a/index', $data);
    }

    public function detail_assigment_a($id)
    {
        // $iduser = $this->request->getVar('iduser');
        // dd($iduser);
        $sla = $this->TicketModel->sla();
        $teknisi = $this->TicketModel->teknisi();
        // dd($teknisi);

        $data = [
            'title' => 'Detail My Assigment',
            'ticket' => $this->TicketModel->getTicket($id),
            'sla' => $sla,
            'teknisi' => $teknisi
        ];
        // dd($data);
        return view('detail_assigment_a/index', $data);
    }

    public function proses_assigment($id)
    {
        $idcustomer = $this->request->getPost('idcustomer');
        $csnama = $this->request->getPost('csnama');
        $csproduct = $this->request->getPost('csproduct');
        $wperiod = $this->request->getPost('wperiod');
        $cperiod = $this->request->getPost('cperiod');
        $rdate = $this->request->getPost('rdate');
        $rby = $this->request->getPost('rby');
        $psummary = $this->request->getPost('psummary');
        $pdetail = $this->request->getPost('pdetail');
        $idsla = $this->request->getPost('idsla');
        $ticketstatus = $this->request->getPost('ticketstatus');
        $assigne = $this->request->getPost('assigne');

        $data = [
            'idcustomer'  => $idcustomer,
            'noticket' => $id . '/HD/' . date("M") . '/' . date("Y"),
            'idsla'  => $idsla,
            'reportdate'  => $rdate,
            'reportby'  => $rby,
            'problemsummary'  => $psummary,
            'problemdetail'  => $pdetail,
            'ticketstatus'  => $ticketstatus,
            'assigne'  => $assigne,
            // 'assignedate'  => date("Y-m-d"),
        ];
        // dd($data);

        $builder = $this->db->table('tickets');

        if ($builder->insert($data)) {
            $builder1 = $this->db->table('while_ticket');
            $builder1->where('id', $id);
            $data = [
                'noticket' => $data['noticket'],
                'status' => $ticketstatus
            ];
            $builder1->update($data);

            session()->setFlashdata('pesan', 'Proses Assigment kamu berhasil');
            return redirect()->to(base_url('/admin/my_assigment_a'));
        } else {
            session()->setFlashdata('failed', 'Proses Assigment kamu belum berhasil');
            return redirect()->to(base_url('/admin/detail_assigment_a'));
        }
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
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $w_for_close = $this->TeknisiModel->search_tickets($search);
        } else {
            $w_for_close = $this->TeknisiModel->where('ticketstatus', 'Closed');
        }

        $sla = $this->TeknisiModel->sla();
        // $iduser = session()->get('iduser');
        // dd($idusers);
        // $count_closed = $this->TeknisiModel->count_closed($iduser);
        // dd($count_closed);

        $data = [
            'title' => 'Waiting for Close',
            'count_closed' => $this->db->table('v_ticket')->where('ticketstatus', 'Closed')->countAllResults(),
            'sla' => $sla,
            'w_for_close' => $w_for_close->paginate(3, 'w_for_close'),
            'pager' => $this->TeknisiModel->pager
        ];
        return view('w_for_close/index', $data);
    }

    public function detail_w_for_close($idtickets)
    {
        $tickets = $this->TeknisiModel->getTicket($idtickets);

        $data = [
            'title' => 'Detail Waiting for Close',
            'tickets' => $tickets
        ];
        return view('detail_w_for_close/index', $data);
    }

    public function v_all_ticket_a()
    {
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $v_all_ticket_a = $this->TeknisiModel->search_tickets($search);
        } else {
            $v_all_ticket_a = $this->TeknisiModel;
        }

        $sla = $this->TeknisiModel->sla();
        $count = $this->TeknisiModel->count();

        $data = [
            'title' => 'View All Ticket',
            'count' => $this->db->table('v_ticket')->countAll(),
            'sla' => $sla,
            'v_all_ticket_a' => $v_all_ticket_a->paginate(3, 'v_all_ticket_a'),
            'pager' => $this->TeknisiModel->pager
        ];
        return view('v_all_ticket_a/index', $data);
    }

    public function popular_solution()
    {
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $popular_solution = $this->TeknisiModel->search_tickets($search);
        } else {
            $popular_solution = $this->TeknisiModel->where('ticketstatus', 'Resolved');
        }

        $sla = $this->TeknisiModel->sla();
        $count_resolve = $this->TeknisiModel->count_resolve();

        $data = [
            'title' => 'Popular Solution',
            'count_resolve' => $count_resolve,
            'sla' => $sla,
            'popular_solution' => $popular_solution->paginate(3, 'v_all_ticket'),
            'pager' => $this->TeknisiModel->pager
        ];
        return view('popular_solution/index', $data);
    }

    public function detail_popular_solution($idtickets)
    {
        $tickets = $this->TeknisiModel->getTicket($idtickets);

        $data = [
            'title' => 'Detail Popular Solution',
            'tickets' => $tickets
        ];
        return view('detail_popular_solution/index', $data);
    }

    public function proses_popular_solution($idtickets)
    {
        // dd($idtickets);
        $data = [
            'idtickets' => $idtickets,
            'ticketstatus' => 'Closed',
            'closeby' => session()->get('iduser'),
            'closedate' => date("Y-m-d"),
        ];

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
            return redirect()->to(base_url('admin/popular_solution'));
        } else {
            session()->setFlashdata('failed', 'Tiket kamu belum berhasil diubah');
            return redirect()->to(base_url('admin/detail_popular_solution'));
        }
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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $builder = session()->getFlashdata('builder');
            $product = session()->getFlashdata('product');
            $iduser = $this->request->getPost('iduser');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $level = $this->request->getPost('level');
            $idcustomer = $this->request->getPost('idcustomer');
            $fullname = $this->request->getPost('fullname');
            $email = $this->request->getPost('email');
            $telp = $this->request->getPost('telp');
            // $emailcode = $this->request->getPost('emailcode');
            // $time = $this->request->getPost('time');
            // $confirmed = $this->request->getPost('confirmed');
            $ip = $this->request->getPost('ip');

            $data = [
                'iduser'  => $iduser,
                'username'  => $username,
                'password' => $password,
                'level'  => $level,
                'idcustomer'  => $idcustomer,
                'fullname'  => $fullname,
                'email'  => $email,
                'telp'  => $telp,
                // 'emailcode'  => $emailcode,
                // 'time'  => $time,
                // 'confirmed'  => $confirmed,
                'ip'  => $ip,
                'is_active' => 0,
                'product' => $this->ProductModel->getCustomers()

            ];
            $data1 = [
                'iduser'  => $iduser,
                'username'  => $username,
                'password' => $password,
                'level'  => $level,
                'idcustomer'  => $idcustomer,
                'fullname'  => $fullname,
                'email'  => $email,
                'telp'  => $telp,
                // 'emailcode'  => $emailcode,
                // 'time'  => $time,
                // 'confirmed'  => $confirmed,
                'ip'  => $ip,
                'is_active' => 0
            ];
            if ($builder == $iduser) {
                session()->setFlashdata('failed', 'Id Customer ini sudah digunakan');
                return view('create_customer/index', $data);
            }

            if ($this->form_validation->run($data, 'create_user') == FALSE) {
                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                // kembali ke halaman form
                return view('create_user/index', $data);
            } else {
                $builder = $this->db->table('users');
                $builder->insert($data1);

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
        } else {
            $builder = $this->AdminModel->viewIduser();
            $query = $this->db->query("SELECT iduser FROM users ORDER BY iduser DESC LIMIT 1");
            $row = $query->getRow();
            // dd($builder);
            $data = [
                'title' => 'Create User',
                'builder' => $row->iduser,
                'username'  => '',
                'password' => '',
                'level'  => '',
                'idcustomer'  => '',
                'fullname'  => '',
                'email'  => '',
                'telp'  => '',
                // 'emailcode'  => $emailcode,
                // 'time'  => $time,
                // 'confirmed'  => $confirmed,
                'ip'  => '',
                'is_active' => '',
                'product' => $this->ProductModel->getCustomers()

            ];
            session()->setFlashdata('builder', $data['builder']);
            session()->setFlashdata('product', $data['product']);

            return view('create_user/index', $data);
        }
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

    public function correct_word()
    {
        // getVar() bisa ambil get dan post
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $correct_word = $this->CorrectWordModel->search($search);
        } else {
            $correct_word = $this->CorrectWordModel;
        }
        $data = [
            'title' => 'Correct Word',
            // 'count' => $this->AdminModel->getUser(),
            'count' => $this->db->table('correctword')->countAll(),
            // 'user' => $this->AdminModel->paginate(3, 'users'),
            'correctword' => $correct_word->paginate(3, 'correctword'),
            'pager' => $this->CorrectWordModel->pager
        ];
        return view('correct_word/index', $data);
    }

    public function detail_word($id)
    {
        $data = [
            'title' => 'Detail Word',
            'correct_word' => $this->CorrectWordModel->getWord($id)
        ];
        // dd($data);
        return view('detail_word/index', $data);
    }

    public function edit_word($id)
    {
        $id   = $this->request->getPost('id');
        $word   = $this->request->getPost('word');
        $c_word   = $this->request->getPost('c_word');

        $data = [
            'id'  => $id,
            'word'  => $word,
            'correctword'  => $c_word,
        ];
        // dd($data);

        $builder = $this->db->table('correctword');
        $builder->where('id', $data['id']);

        if ($builder->update($data)) {
            session()->setFlashdata('pesan', 'Data kamu berhasil diubah');
            return redirect()->to(base_url('/admin/correct_word'));
        } else {
            session()->setFlashdata('failed', 'Data kamu belum berhasil diubah');
            return redirect()->to(base_url('/admin/correct_word'));
        }
    }

    public function delete_word($id)
    {
        $builder = $this->db->table('correctword');
        $builder->where('id', $id);
        if ($builder->delete()) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/correct_word'));
        } else {
            session()->setFlashdata('failed', 'Data belum berhasil dihapus ');
            return redirect()->to(base_url('/admin/correct_word'));
        }
    }

    public function create_word()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $builder = session()->getFlashdata('builder');
            $id   = $this->request->getPost('id');
            $word   = $this->request->getPost('word');
            $correctword   = $this->request->getPost('correctword');

            $data = [
                'title' => 'Create Word',
                'id'  => $id,
                'word'  => $word,
                'correctword'  => $correctword
            ];
            $data1 = [
                'id'  => $id,
                'word'  => $word,
                'correctword'  => $correctword
            ];

            $builder = $this->db->table('correctword');
            if ($builder->insert($data1)) {
                session()->setFlashdata('pesan', 'Data kamu berhasil ditambahkan');
                return redirect()->to(base_url('/admin/correct_word'));
            } else {
                session()->setFlashdata('pesan', 'Data kamu belum berhasil ditambahkan');
                return redirect()->to(base_url('/admin/correct_word'));
            }
        } else {
            $builder = $this->CorrectWordModel->viewIdword();

            // dd($builder);
            $data = [
                'title' => 'Create Word',
                'builder' => $builder,
                'id'  => '',
                'word'  => '',
                'correctword'  => ''
            ];
            session()->setFlashdata('builder', $data['builder']);
            return view('create_word/index', $data);
        }
    }

    public function edc()
    {
        // getVar() bisa ambil get dan post
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $edc = $this->EdcModel->search($search);
        } else {
            $edc = $this->EdcModel;
        }
        $data = [
            'title' => 'EDC',
            // 'count' => $this->AdminModel->getUser(),
            'count' => $this->db->table('edc')->countAll(),
            // 'user' => $this->AdminModel->paginate(3, 'users'),
            'edc' => $edc->paginate(3, 'edc'),
            'pager' => $this->EdcModel->pager
        ];
        return view('edc/index', $data);
    }

    public function detail_edc($id)
    {
        $data = [
            'title' => 'Detail EDC',
            'edc' => $this->EdcModel->getEdc($id)
        ];
        // dd($data);
        return view('detail_edc/index', $data);
    }

    public function edit_edc($id)
    {
        $id   = $this->request->getPost('id');
        $jedc   = $this->request->getPost('jedc');
        $lokasi   = $this->request->getPost('lokasi');
        $pic   = $this->request->getPost('pic');
        $pertanyaan   = $this->request->getPost('pertanyaan');
        $idcustomer   = $this->request->getPost('idcustomer');

        $data = [
            'id'  => $id,
            'jenisedc'  => $jedc,
            'lokasi'  => $lokasi,
            'pic'  => $pic,
            'pertanyaan'  => $pertanyaan,
            'idcustomer'  => $idcustomer,
        ];
        // dd($data);

        $builder = $this->db->table('edc');
        $builder->where('id', $data['id']);

        if ($builder->update($data)) {
            session()->setFlashdata('pesan', 'Data kamu berhasil diubah');
            return redirect()->to(base_url('/admin/edc'));
        } else {
            session()->setFlashdata('failed', 'Data kamu belum berhasil diubah');
            return redirect()->to(base_url('/admin/edc'));
        }
    }

    public function delete_edc($id)
    {
        $builder = $this->db->table('edc');
        $builder->where('id', $id);
        if ($builder->delete()) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/edc'));
        } else {
            session()->setFlashdata('failed', 'Data belum berhasil dihapus ');
            return redirect()->to(base_url('/admin/edc'));
        }
    }

    public function create_edc()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $builder = session()->getFlashdata('builder');
            $id   = $this->request->getPost('id');
            $jedc   = $this->request->getPost('jedc');
            $lokasi   = $this->request->getPost('lokasi');
            $pic   = $this->request->getPost('pic');
            $pertanyaan   = $this->request->getPost('pertanyaan');
            $idcustomer   = $this->request->getPost('idcustomer');


            $data = [
                'title' => 'Create EDC',
                'id'  => $id,
                'jenisedc'  => $jedc,
                'lokasi'  => $lokasi,
                'pic'  => $pic,
                'pertanyaan'  => $pertanyaan,
                'idcustomer'  => $idcustomer,
            ];
            $data1 = [
                'id'  => $id,
                'jenisedc'  => $jedc,
                'lokasi'  => $lokasi,
                'pic'  => $pic,
                'pertanyaan'  => $pertanyaan,
                'idcustomer'  => $idcustomer,
            ];

            $builder = $this->db->table('edc');
            if ($builder->insert($data1)) {
                session()->setFlashdata('pesan', 'Data kamu berhasil ditambahkan');
                return redirect()->to(base_url('/admin/edc'));
            } else {
                session()->setFlashdata('pesan', 'Data kamu belum berhasil ditambahkan');
                return redirect()->to(base_url('/admin/edc'));
            }
        } else {
            $builder = $this->EdcModel->viewIdedc();

            // dd($builder);
            $data = [
                'title' => 'Create Edc',
                'builder' => $builder,
                'id'  => '',
                'jenisedc'  => '',
                'lokasi'  => '',
                'pic'  => '',
                'pertanyaan'  => '',
                'idcustomer'  => '',
            ];
            session()->setFlashdata('builder', $data['builder']);
            return view('create_edc/index', $data);
        }
    }

    public function vocabs()
    {
        // getVar() bisa ambil get dan post
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $vocabs = $this->VocabsModel->search($search);
        } else {
            $vocabs = $this->VocabsModel;
        }
        $data = [
            'title' => 'Vocabs',
            // 'count' => $this->AdminModel->getUser(),
            'count' => $this->db->table('vocabs')->countAll(),
            // 'user' => $this->AdminModel->paginate(3, 'users'),
            'vocabs' => $vocabs->paginate(3, 'vocabs'),
            'pager' => $this->VocabsModel->pager
        ];
        return view('vocabs/index', $data);
    }

    public function detail_vocabs($idvocab)
    {
        $data = [
            'title' => 'Detail Vocabs',
            'vocabs' => $this->VocabsModel->getVocabs($idvocab)
        ];
        // dd($data);
        return view('detail_vocabs/index', $data);
    }

    public function edit_vocabs($idvocab)
    {
        $idvocab   = $this->request->getPost('idvocab');
        $idcustomer   = $this->request->getPost('idcustomer');
        $pic   = $this->request->getPost('pic');
        $ask   = $this->request->getPost('ask');
        $answer   = $this->request->getPost('answer');

        $data = [
            'idvocab'  => $idvocab,
            'idcustomer'  => $idcustomer,
            'pic'  => $pic,
            'ask'  => $ask,
            'answer'  => $answer,
        ];
        // dd($data);

        $builder = $this->db->table('vocabs');
        $builder->where('idvocab', $data['idvocab']);

        if ($builder->update($data)) {
            session()->setFlashdata('pesan', 'Data kamu berhasil diubah');
            return redirect()->to(base_url('/admin/vocabs'));
        } else {
            session()->setFlashdata('failed', 'Data kamu belum berhasil diubah');
            return redirect()->to(base_url('/admin/vocabs'));
        }
    }

    public function delete_vocabs($idvocab)
    {
        $builder = $this->db->table('vocabs');
        $builder->where('idvocab', $idvocab);
        if ($builder->delete()) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/vocabs'));
        } else {
            session()->setFlashdata('failed', 'Data belum berhasil dihapus ');
            return redirect()->to(base_url('/admin/vocabs'));
        }
    }

    public function create_vocabs()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idvocab   = $this->request->getPost('idvocab');
            $idcustomer   = $this->request->getPost('idcustomer');
            $pic   = $this->request->getPost('pic');
            $ask   = $this->request->getPost('ask');
            $answer   = $this->request->getPost('answer');


            $data = [
                'title' => 'Create Vocabs',
                'idvocab'  => $idvocab,
                'idcustomer'  => $idcustomer,
                'pic'  => $pic,
                'ask'  => $ask,
                'answer'  => $answer,
            ];
            $data1 = [
                'idvocab'  => $idvocab,
                'idcustomer'  => $idcustomer,
                'pic'  => $pic,
                'ask'  => $ask,
                'answer'  => $answer,
            ];

            $builder = $this->db->table('vocabs');
            if ($builder->insert($data1)) {
                session()->setFlashdata('pesan', 'Data kamu berhasil ditambahkan');
                return redirect()->to(base_url('/admin/vocabs'));
            } else {
                session()->setFlashdata('pesan', 'Data kamu belum berhasil ditambahkan');
                return redirect()->to(base_url('/admin/vocabs'));
            }
        } else {
            $builder = $this->VocabsModel->viewIdvocabs();

            // dd($builder);
            $data = [
                'title' => 'Create Edc',
                'builder' => $builder,
                'idvocab'  => '',
                'idcustomer'  => '',
                'pic'  => '',
                'ask'  => '',
                'answer'  => '',
            ];
            session()->setFlashdata('builder', $data['builder']);
            return view('create_vocabs/index', $data);
        }
    }

    public function list_project()
    {
        // getVar() bisa ambil get dan post
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $list_project = $this->ProjectModel->search_project($search);
        } else {
            $list_project = $this->ProjectModel;
        }
        $data = [
            'title' => 'List Project',
            // 'count' => $this->AdminModel->getUser(),
            'count' => $this->db->table('v_project')->countAll(),
            // 'user' => $this->AdminModel->paginate(3, 'users'),
            'list_project' => $list_project->paginate(3, 'list_project'),
            'pager' => $this->ProjectModel->pager
        ];
        return view('list_project/index', $data);
    }

    public function detail_project($idproject)
    {
        // $iduser = $this->request->getVar('iduser');
        // dd($iduser);

        $data = [
            'title' => 'Detail Project',
            'project' => $this->ProjectModel->getProject($idproject),
            'customer' => $this->ProjectModel->getCustomer(),
        ];
        // dd($data);
        return view('detail_project/index', $data);
    }

    public function edit_project($idproject)
    {
        $idproject   = $this->request->getPost('idproject');
        $namaproject   = $this->request->getPost('namaproject');
        $csnama   = $this->request->getPost('csnama');
        $dbegin   = $this->request->getPost('dbegin');
        $dend   = $this->request->getPost('dend');
        $idate   = $this->request->getPost('idate');
        $iend   = $this->request->getPost('iend');
        $uatbegin   = $this->request->getPost('uatbegin');
        $uatend   = $this->request->getPost('uatend');
        $billstartd   = $this->request->getPost('billstartd');
        $billduee   = $this->request->getPost('billduee');
        $wperiod   = $this->request->getPost('wperiod');
        $cstartdate   = $this->request->getPost('cstartdate');
        $cenddate   = $this->request->getPost('cenddate');

        $data = [
            'idproject'  => $idproject,
            'namaproject'  => $namaproject,
            'idcustomer'  => $csnama,
            'deliveyrbegin'  => $dbegin,
            'deliveryend'  => $dend,
            'installdate'  => $idate,
            'installend'  => $iend,
            'uatbegin'  => $uatbegin,
            'uatend'  => $uatend,
            'billstartdate'  => $billstartd,
            'billdueend'  => $billduee,
            'warantyperiod'  => $wperiod,
            'contractstartdate'  => $cstartdate,
            'contractenddate'  => $cenddate,
        ];
        // dd($data);

        $builder = $this->db->table('projects');
        $builder->where('idproject', $data['idproject']);
        if ($builder->update($data)) {
            session()->setFlashdata('pesan', 'Data kamu berhasil diubah');
            return redirect()->to(base_url('/admin/list_project'));
        } else {
            session()->setFlashdata('failed', 'Data kamu belum berhasil diubah');
            return redirect()->to(base_url('/admin/detail_project'));
        }
    }

    public function delete_pjt($idproject)
    {
        // Cara delete konvensional, minus nya bisa dihapus lewat url
        // dd($iduser);
        $builder = $this->db->table('projects');
        $builder->where('idproject', $idproject);
        if ($builder->delete()) {


            // $this->CustomerModel->where('idcustomer', $idcustomer);
            // $this->CustomerModel->delete($idcustomer);
            // primary key iduser ada di model.php (vebdor->codeigniter4->Model.php)
            // $builder = $this->db->table('users');
            // $builder->where('iduser', $iduser);
            // $builder->delete();
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/list_project'));
        } else {
            session()->setFlashdata('failed', 'Data belum berhasil dihapus ');
            return redirect()->to(base_url('/admin/detail_customer'));
        }
    }

    public function create_project()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $builder = session()->getFlashdata('builder');
            $idproject   = $this->request->getPost('idproject');
            $useid   = $this->request->getPost('useid');
            $namaproject   = $this->request->getPost('namaproject');
            $csnama   = $this->request->getPost('csnama');
            $dbegin   = $this->request->getPost('dbegin');
            $dend   = $this->request->getPost('dend');
            $idate   = $this->request->getPost('idate');
            $iend   = $this->request->getPost('iend');
            $uatbegin   = $this->request->getPost('uatbegin');
            $uatend   = $this->request->getPost('uatend');
            $billstartd   = $this->request->getPost('billstartd');
            $billduee   = $this->request->getPost('billduee');
            $wperiod   = intval($this->request->getPost('wperiod'));
            $cstartdate   = $this->request->getPost('cstartdate');
            $cenddate   = intval($this->request->getPost('cenddate'));

            $data = [
                'title' => 'Create Project',
                'idproject'  => $idproject,
                'namaproject'  => $namaproject,
                'idcustomer'  => $csnama,
                'deliveyrbegin'  => $dbegin,
                'deliveryend'  => $dend,
                'installdate'  => $idate,
                'installend'  => $iend,
                'uatbegin'  => $uatbegin,
                'uatend'  => $uatend,
                'billstartdate'  => $billstartd,
                'billdueend'  => $billduee,
                'warantyperiod'  => $wperiod,
                'contractstartdate'  => $cstartdate,
                'contractenddate'  => $cenddate,
                'builder' => $this->ProjectModel->viewIdproject(),
                'customer' => $this->ProjectModel->getCustomer(),

            ];
            $data1 = [
                'idproject'  => $idproject,
                'namaproject'  => $namaproject,
                'idcustomer'  => $csnama,
                'deliveyrbegin'  => $dbegin,
                'deliveryend'  => $dend,
                'installdate'  => $idate,
                'installend'  => $iend,
                'uatbegin'  => $uatbegin,
                'uatend'  => $uatend,
                'billstartdate'  => $billstartd,
                'billdueend'  => $billduee,
                'warantyperiod'  => $wperiod,
                'contractstartdate'  => $cstartdate,
                'contractenddate'  => $cenddate,
            ];

            if ($idproject == $useid) {
                session()->setFlashdata('failed', 'Id Project ini sudah digunakan');
                return view('create_project/index', $data);
            }

            $builder = $this->db->table('projects');
            if ($builder->insert($data1)) {
                session()->setFlashdata('pesan', 'Data kamu berhasil ditambahkan');
                return redirect()->to(base_url('/admin/list_project'));
            } else {
                session()->setFlashdata('pesan', 'Data kamu belum berhasil ditambahkan');
                return redirect()->to(base_url('/admin/create_project'));
            }
        } else {
            $builder = $this->ProjectModel->viewIdproject();

            // dd($builder);
            $data = [
                'title' => 'Create Project',
                'builder' => $builder,
                'customer' => $this->ProjectModel->getCustomer(),
                'idproject'  => '',
                'namaproject'  => '',
                'idcustomer'  => '',
                'deliveyrbegin'  => '',
                'deliveryend'  => '',
                'installdate'  => '',
                'installend'  => '',
                'uatbegin'  => '',
                'uatend'  => '',
                'billstartdate'  => '',
                'billdueend'  => '',
                'warantyperiod'  => '',
                'contractstartdate'  => '',
                'contractenddate'  => '',

            ];
            session()->setFlashdata('builder', $data['builder']);
            return view('create_project/index', $data);
        }
    }

    public function create_pjt()
    {
        $idproject   = $this->request->getPost('idproject');
        $useid   = $this->request->getPost('useid');
        $namaproject   = $this->request->getPost('namaproject');
        $csnama   = $this->request->getPost('csnama');
        $dbegin   = $this->request->getPost('dbegin');
        $dend   = $this->request->getPost('dend');
        $idate   = $this->request->getPost('idate');
        $iend   = $this->request->getPost('iend');
        $uatbegin   = $this->request->getPost('uatbegin');
        $uatend   = $this->request->getPost('uatend');
        $billstartd   = $this->request->getPost('billstartd');
        $billduee   = $this->request->getPost('billduee');
        $wperiod   = intval($this->request->getPost('wperiod'));
        $cstartdate   = $this->request->getPost('cstartdate');
        $cenddate   = intval($this->request->getPost('cenddate'));



        $data = [
            'idproject'  => $idproject,
            'namaproject'  => $namaproject,
            'idcustomer'  => $csnama,
            'deliveyrbegin'  => $dbegin,
            'deliveryend'  => $dend,
            'installdate'  => $idate,
            'installend'  => $iend,
            'uatbegin'  => $uatbegin,
            'uatend'  => $uatend,
            'billstartdate'  => $billstartd,
            'billdueend'  => $billduee,
            'warantyperiod'  => $wperiod,
            'contractstartdate'  => $cstartdate,
            'contractenddate'  => $cenddate,
        ];
        // dd($data);

        if ($idproject == $useid) {
            session()->setFlashdata('failed', 'Id Project ini sudah digunakan');
            // return view('create_project/index');
            return redirect()->to(base_url('/admin/create_project'));
        }

        $builder = $this->db->table('projects');
        if ($builder->insert($data)) {
            session()->setFlashdata('pesan', 'Data kamu berhasil ditambahkan');
            return redirect()->to(base_url('/admin/list_project'));
        } else {
            session()->setFlashdata('pesan', 'Data kamu belum berhasil ditambahkan');
            return redirect()->to(base_url('/admin/create_project'));
        }
    }

    public function list_customer()
    {
        // getVar() bisa ambil get dan post
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $customers = $this->CustomerModel->search_cs($search);
        } else {
            $customers = $this->CustomerModel;
        }
        // $builder = $this->db->table('customers');
        // $query   = $builder->get();
        $data = [
            'title' => 'List Customer',
            // 'query' => $query,
            'count' => $this->db->table('customers')->countAll(),
            'customers' => $customers->paginate(3, 'customers'),
            'pager' => $this->CustomerModel->pager
        ];
        return view('list_customer/index', $data);
    }

    public function create_customer()
    {
        // $db      = \Config\Database::connect();
        // $builder = $this->db->table('users');

        // $builder->orderBy('iduser', 'DESC');
        // $builder->limit(1);
        // $query   = $builder->get();
        //d($this->request->getMethod());

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // $idcustomer2 = $this->request->getVar('idcustomer1');
            $idcustomer2 = session()->getFlashdata('idcustomer1');
            $idcustomer = $this->request->getPost('idcustomer');
            // d($idcustomer);
            // d($idcustomer2);


            $csnama = $this->request->getPost('csnama');
            $alamat = $this->request->getPost('alamat');
            $telp = $this->request->getPost('telp');
            $email = $this->request->getPost('email');
            $pic = $this->request->getPost('pic');
            // $csproduct = $this->request->getPost('csproduct');

            $data = [
                'idcustomer'  => $idcustomer,
                'csnama'  => $csnama,
                'alamat' => $alamat,
                'telp'  => $telp,
                'email'  => $email,
                'pic'  => $pic,
                'time'  => time(),
                'ip'  => 0,
                // 'csproduct'  => $csproduct,
            ];
            $validasi = $data;
            // d($validasi);
            if ($idcustomer == $idcustomer2) {
                session()->setFlashdata('failed', 'Id Customer ini sudah digunakan');
                return view('create_customer/index', $validasi);
            }

            if ($this->form_validation->run($validasi, 'create_cs') == FALSE) {




                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                // kembali ke halaman form

                return view('create_customer/index', $validasi);
            } else {
                $builder = $this->db->table('customers');
                $builder->insert($data);
                // $builder1 = $this->db->table('csproduct');
                // $builder1->insert($data1);

                session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
                return redirect()->to(base_url('/admin/create_customer'));
            }
        } else {

            $builder = $this->CustomerModel->viewIduser();
            $query = $this->db->query("SELECT idcustomer FROM customers ORDER BY idcustomer DESC LIMIT 1");
            $row = $query->getRow();
            // $row->idcustomer;
            // d($row->idcustomer);
            // d($idcustomer1);
            // dd($builder);
            $data = [
                'title' => 'Create Customer',
                'builder' => $builder,
                'idcustomer1'  => $row->idcustomer,
                'csnama'  => '',
                'alamat' => '',
                'telp'  => '',
                'email'  => '',
                'pic'  => '',
                'csproduct'  => '',
                'time'  => '',
                'ip'  => '',


            ];

            session()->setFlashdata('idcustomer1', $data['idcustomer1']);
            return view('create_customer/index', $data);
        }
    }

    public function create_cs()
    {
        $idcustomer = $this->request->getPost('idcustomer');
        $csnama = $this->request->getPost('csnama');
        $alamat = $this->request->getPost('alamat');
        $telp = $this->request->getPost('telp');
        $email = $this->request->getPost('email');
        $pic = $this->request->getPost('pic');
        $csproduct = $this->request->getPost('csproduct');
        // $time = $this->request->getPost('time');
        // $ip = $this->request->getPost('ip');

        $data = [
            'idcustomer'  => $idcustomer,
            'csnama'  => $csnama,
            'alamat' => $alamat,
            'telp'  => $telp,
            'email'  => $email,
            'pic'  => $pic,
            'csproduct'  => $csproduct,
            'time'  => time(),
            'ip'  => 0
        ];



        if ($this->form_validation->run($data, 'create_cs') == FALSE) {
            // mengembalikan nilai input yang sudah dimasukan sebelumnya
            session()->setFlashdata('inputs', $this->request->getPost());
            // memberikan pesan error pada saat input data
            session()->setFlashdata('errors', $this->form_validation->getErrors());
            // kembali ke halaman form
            return redirect()->to(base_url('/admin/create_customer'));
        } else {
            $builder = $this->db->table('customers');
            $builder->insert($data);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

            return redirect()->to(base_url('/admin/create_customer'));
        }
    }

    public function detail_customer($idcustomer)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idcustomer = $this->request->getPost('idcustomer');
            $csnama = $this->request->getPost('csnama');
            $alamat = $this->request->getPost('alamat');
            $telp = $this->request->getPost('telp');
            $email = $this->request->getPost('email');
            $pic = $this->request->getPost('pic');
            // $csproduct = $this->request->getPost('csproduct');
            // d($csproduct);
            $title =  'Detail Customer';
            $data = [
                'idcustomer'  => $idcustomer,
                'csnama'  => $csnama,
                'alamat' => $alamat,
                'telp'  => $telp,
                'email'  => $email,
                'pic'  => $pic
            ];
            $validasi = $data;

            if ($this->form_validation->run($validasi, 'edit_customer') == FALSE) {

                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                // kembali ke halaman form

                return view('detail_customer/index', $validasi);
            } else {
                $builder = $this->db->table('customers');
                $builder->where('idcustomer', $data['idcustomer']);
                $builder->update($data);

                session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
                return redirect()->to(base_url('/admin/list_customer'));
            }
        } else {
            $data = [
                'title' => 'Detail Customer',
                'customer' => $this->CustomerModel->getCustomer($idcustomer)
            ];
            // dd($data);
            return view('detail_customer/index', $data);
        }
    }

    public function edit_customer($idcustomer)
    {
        $idcustomer = $this->request->getPost('idcustomer');
        $csnama = $this->request->getPost('csnama');
        $alamat = $this->request->getPost('alamat');
        $telp = $this->request->getPost('telp');
        $email = $this->request->getPost('email');
        $pic = $this->request->getPost('pic');
        $csproduct = $this->request->getPost('csproduct');
        // d($csproduct);

        $data = [
            'idcustomer'  => $idcustomer,
            'csnama'  => $csnama,
            'alamat' => $alamat,
            'telp'  => $telp,
            'email'  => $email,
            'pic'  => $pic
        ];


        // dd($data);

        if ($this->form_validation->run($data, 'edit_customer') == FALSE) {
            // mengembalikan nilai input yang sudah dimasukan sebelumnya
            session()->setFlashdata('inputs', $this->request->getPost());
            // memberikan pesan error pada saat input data
            session()->setFlashdata('errors', $this->form_validation->getErrors());
            // kembali ke halaman form
            return redirect()->to(base_url('/admin/detail_customer'));
        } else {
            $builder = $this->db->table('customers');
            $builder->where('idcustomer', $data['idcustomer']);
            $builder->update($data);

            session()->setFlashdata('pesan', 'Data kamu berhasil diubah');
            return redirect()->to(base_url('/admin/list_customer'));
        }
        session()->setFlashdata('failed', 'Data kamu belum berhasil diubah');
        return redirect()->to(base_url('/admin/list_customer'));
    }

    public function delete_cs($idcustomer)
    {
        // Cara delete konvensional, minus nya bisa dihapus lewat url
        // dd($iduser);
        $builder = $this->db->table('customers');
        $builder->where('idcustomer', $idcustomer);
        if ($builder->delete()) {


            // $this->CustomerModel->where('idcustomer', $idcustomer);
            // $this->CustomerModel->delete($idcustomer);
            // primary key iduser ada di model.php (vebdor->codeigniter4->Model.php)
            // $builder = $this->db->table('users');
            // $builder->where('iduser', $iduser);
            // $builder->delete();
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/list_customer'));
        } else {
            session()->setFlashdata('pesan', 'Data ');
            return redirect()->to(base_url('/admin/list_customer'));
        }
    }

    public function list_product()
    {
        // getVar() bisa ambil get dan post
        $search = $this->request->getVar('search');
        // d($search);
        if ($search) {
            $product = $this->ProductModel->search_cs($search);
        } else {
            $product = $this->ProductModel;
        }
        // $builder = $this->db->table('customers');
        // $query   = $builder->get();
        $data = [
            'title' => 'List Product',
            // 'query' => $query,
            'count' => $this->db->table('csproduct')->countAll(),
            'product' => $product->paginate(3, 'product'),
            'pager' => $this->ProductModel->pager
        ];
        return view('list_product/index', $data);
    }

    public function detail_product($idcustomer)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idcustomer = $this->request->getPost('idcustomer');
            $csproduct = $this->request->getPost('csproduct');
            $data = [
                'idcustomer'  => $idcustomer,
                'csproduct'  => $csproduct
            ];
            $validasi = $data;

            $builder = $this->db->table('csproduct');
            $builder->where('idcustomer', $data['idcustomer']);
            $builder->update($data);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('/admin/list_product'));
        } else {
            $data = [
                'title' => 'Detail Product',
                'product' => $this->ProductModel->getProduct($idcustomer)
            ];
            // dd($data);
            return view('detail_product/index', $data);
        }
    }

    public function create_product()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idcustomer = $this->request->getPost('idcustomer');
            $csproduct = $this->request->getPost('csproduct');
            $data = [
                'idcustomer'  => $idcustomer,
                'csproduct'  => $csproduct
            ];
            $validasi = $data;

            $builder = $this->db->table('csproduct');
            // $builder->where('idcustomer', $data['idcustomer']);
            $builder->insert($data);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('/admin/list_product'));
        } else {
            $data = [
                'title' => 'Create Product',
                'product' => $this->ProductModel->getCustomers()
            ];
            // dd($data);
            return view('create_product/index', $data);
        }
    }

    public function delete_pdc($idcustomer)
    {
        // Cara delete konvensional, minus nya bisa dihapus lewat url
        // dd($iduser);
        $builder = $this->db->table('csproduct');
        $builder->where('idcustomer', $idcustomer);
        if ($builder->delete()) {


            // $this->CustomerModel->where('idcustomer', $idcustomer);
            // $this->CustomerModel->delete($idcustomer);
            // primary key iduser ada di model.php (vebdor->codeigniter4->Model.php)
            // $builder = $this->db->table('users');
            // $builder->where('iduser', $iduser);
            // $builder->delete();
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/list_product'));
        } else {
            session()->setFlashdata('pesan', 'Data ');
            return redirect()->to(base_url('/admin/list_product'));
        }
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

    // public function create_project()
    // {
    //     $data = [
    //         'title' => 'Create Project'
    //     ];
    //     return view('create_project/index', $data);
    // }

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
