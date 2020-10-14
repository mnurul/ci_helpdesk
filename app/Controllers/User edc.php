<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TicketModel;
use App\Models\VocabsModel;
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
    protected $VocabsModel;


    public function __construct()
    {
        // Termasuk cara oop
        // Cara 2 inisialisasi database
        helper('form');
        helper('url');
        $session = \Config\Services::session();
        $this->UserModel = new UserModel();
        $this->TicketModel = new TicketModel();
        $this->VocabsModel = new VocabsModel();
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
            'pager' => $this->TicketModel->pager
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
        $idcs = session()->get('idcustomer');
        $csNama = $this->UserModel->csNama($idcs);
        // dd($csNama);


        $data = [
            'csnama' => $customers,
            'csproduct' => $getProject['namaproject'],
            'warantyperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject['uatend']))),
            'contractperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject['billstartdate']))),
            'reportdate'  => $rdate,
            'reportby'  => $rby,
            'problemsummary'  => $psummary,
            'problemdetail'  => $pdetail,
            'status'  => 'Not Approve',
            'idcustomer' => $idcs

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

    public function start_asking()
    {
        $userinput = $this->request->getPost('userinput');
        // d($userinput);



        $data = [
            'title' => 'Start Asking',
            // 'arr_result' => null
            // 'json' => json_encode($w)
        ];
        return view('start_asking/index', $data);
    }

    public function auto()
    {
        // echo "auto";
        if (isset($_GET['term'])) {
            $result = $this->VocabsModel->search($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->ask;
                echo json_encode($arr_result);
                // $arr_result =  json_encode($arr_result);
            }
        }
        // $data = [
        //     'arr_result' =>  json_encode($arr_result)
        // ];
        // return view('v_ticket_status/index', $data);
    }

    public function simpanemail()
    {
        $getid = $this->input->get('getid');
        $email = $this->request->getVar('email');
        $this->db->query("UPDATE `askpending` SET `email`='" . $email . "' WHERE (`id`='" . $getid . "')");
    }

    public function caripertanyaan()
    {
        echo "caripertanyaan";
        //-----mengambil data yang di kirim dan mengembalikannya
        $q = strtolower($_GET["q"]);
        if (!$q) return;

        //-----Query untuk mencari data yang dikirimkan berdasarkan npm atau nama
        $sql = "SELECT * FROM vocabs WHERE ask LIKE '%" . $q . "%'";
        $tampil = "SELECT * FROM vocabs WHERE ask LIKE '%" . $q . "%'";

        //-----Menampilkan data dari hasil query
        while ($data = mysqli_fetch_array($tampil)) {
            echo $data['ask'] . "\n";
        }
    }

    public function tanyajawab()
    {
        $tanya = $this->request->getVar('tanya');
        $teks = strtolower($tanya);
        // d($teks);
        $cekVocabs = $this->UserModel->cekVocabs($teks);

        $tesklama = session()->get('kataterakhir');
        // $teksawal = session()->set('tanya', $tanya);
        $teksawal = $teks;

        $correctword = explode(" ", $teks);
        $jumdata = count($correctword);

        //-----Pengecekan Kata Minimal Harus Lebih dari 3 kata-----
        $arr = "|";
        if ($jumdata < 3) {
            echo "jumlah < 3";
            if ($teks == "ya") {
                $idvocab = session()->get('idvocab');
                if ($idvocab <> '') {
                    //echo '$idvocsb';
                    $sql = "SELECT * FROM vocabs WHERE idvocab='" . $idvocab . "'";
                    $tampil =  $this->db->query($sql);
                    // $data = $tampil->getResult('array');
                    // $data = mysqli_fetch_array($tampil);
                    foreach ($tampil->getResult('array') as $data) {
                        $totalask = $data['tolask'] + 1;
                    }
                    // d($data);
                    $update = "UPDATE `vocabs` SET `tolask`='" . $totalask . "' WHERE (`idvocab`='" . $idvocab . "')";
                    $this->db->query($update);

                    $data = array('idvocab' => '');
                    session()->set($data);


                    echo "Syukur deh kalo sudah bisa.. kalo ada apa-apa lagi silahkan saja hubungi kami kembali ya? terima kasih";
                } else {
                    echo "Ya, Apakah ada yang bisa kami bantu?";
                }
                exit;
            } elseif ($teks == "tidak") {
                // echo "tidak";
                $idvocab = session()->get('idvocab');
                $idcustomer = session()->get('idcustomer1');
                $ask = session()->get('ask');
                // d($idvocab);
                // d($ask);
                // d($idcustomer);

                if ($idvocab <> '') {
                    // echo $idvocab;
                    $hapus = "DELETE FROM tmppropabilityvocab WHERE idvocab='" . $idvocab . "' AND idcustomer='" . $idcustomer . "'";
                    // echo "tmpprobabilityvocab 'tidak'";
                    $this->db->query($hapus);
                    // echo "hapus";


                    $sql = "SELECT b.idvocab, b.answer FROM tmppropabilityvocab AS a INNER JOIN vocabs AS b ON b.idvocab = a.idvocab WHERE a.idcustomer='" . $idcustomer . "' ORDER BY a.jumpprobability DESC";
                    $tampil = $this->db->query($sql);

                    // $data = mysqli_fetch_array($tampil);
                    // $data = $tampil->getResult('array');
                    if (count($tampil->getResult('array')) == 0) {
                        // $arr = "test";
                        // echo $ask;

                        // Revisi. data diinput ke tabel ticket
                        // $builder = $this->db->table('askpending');
                        // $data = [
                        //     'ask' => $ask,
                        //     'tglask' => date('Y-m-d H:i:s'),
                        //     'idcustomer' => $idcustomer,
                        //     'status' => 1,
                        //     'email' => session()->get('email')
                        // ];

                        // $teks = $hasil;
                        // dd($teks);
                        $idcustomer = session()->get('idcustomer');
                        $email = session()->get('email');
                        // d($idcustomer);
                        $cekCsProduct = $this->UserModel->cekCsProduct($idcustomer);
                        // d($cekCsProduct['csproduct']);
                        $csproduct = $cekCsProduct['csproduct'];
                        $getProject1 = $this->UserModel->getProject1($idcustomer);
                        // d($getProject1);
                        $csNama = $this->UserModel->csNama($idcustomer);
                        // d($csNama);


                        $data = [
                            'csnama' => $csNama['csnama'],
                            'csproduct' => $getProject1['namaproject'],
                            'warantyperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['uatend']))),
                            'contractperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['billstartdate']))),
                            'reportdate'  => date('Y-m-d '),
                            'reportby'  => $csNama['pic'],
                            'problemsummary'  => $ask,
                            'status'  => 'Not Approve',
                            'idcustomer' => $idcustomer
                        ];
                        // dd($data);

                        $builder = $this->db->table('while_ticket');
                        if ($builder->insert($data)) {
                            // session()->setFlashdata('pesan', 'Ticket kamu berhasil dibuat');
                            $arr = '<p>Teknisi kami akan segera menangani atas pertanyaan yang anda ajukan. Selanjutnya ticket aduan akan dibuat secara otomatis.';
                            // return redirect()->to(base_url('/user/start_asking'));
                        } else {
                            // session()->setFlashdata('failed', 'Ticket kamu belum berhasil dibuat');
                            $arr = '<p>Tiket belum berhasil dibuat. Silakan coba beberapa saat lagi';
                            // return redirect()->to(base_url('/user/start_asking'));
                        }



                        // dd($data);
                        // $getID = $builder->insert($data);
                        // foreach ($getID->getResult() as $row) {
                        //     echo $row->ask;
                        //     echo $row->tglask;
                        //     echo $row->idcustomer;
                        // }
                        // echo $getID;
                        // $arr = '<p>Teknisi kami akan segera menangani atas pertanyaan yang anda ajukan. Selanjutnya ticket aduan akan dibuat secara otomatis123.';

                        $data = array('idvocab' => '');
                        session()->set($data);
                    } else {
                        foreach ($tampil->getResult('array') as $data) {


                            // echo $data['answer'];
                            if (trim($data['answer']) == '') {
                                // echo trim($data['answer']) <> '';
                                // echo "trim";

                                // exit;

                                // Revisi. data diinput ke tabel ticket
                                // $builder = $this->db->table('askpending');
                                // $data = [
                                //     'ask' => $teks,
                                //     'tglask' => date('Y-m-d H:i:s'),
                                //     'idcustomer' => $idcustomer,
                                //     'status' => 1
                                // ];

                                // dd($data);

                                $idcustomer = session()->get('idcustomer');
                                $email = session()->get('email');
                                // d($idcustomer);
                                $cekCsProduct = $this->UserModel->cekCsProduct($idcustomer);
                                // d($cekCsProduct['csproduct']);
                                $csproduct = $cekCsProduct['csproduct'];
                                $getProject1 = $this->UserModel->getProject1($idcustomer);
                                // d($getProject1);
                                $csNama = $this->UserModel->csNama($idcustomer);
                                // d($csNama);


                                $data = [
                                    'csnama' => $csNama['csnama'],
                                    'csproduct' => $getProject1['namaproject'],
                                    'warantyperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['uatend']))),
                                    'contractperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['billstartdate']))),
                                    'reportdate'  => date('Y-m-d '),
                                    'reportby'  => $csNama['pic'],
                                    'problemsummary'  => $teks,
                                    'status'  => 'Not Approve',
                                    'idcustomer' => $idcustomer
                                ];
                                // dd($data);

                                $builder = $this->db->table('while_ticket');
                                if ($builder->insert($data)) {
                                    // session()->setFlashdata('pesan', 'Ticket kamu berhasil dibuat');
                                    $arr = '<p>Teknisi kami akan segera menangani atas pertanyaan yang anda ajukan. Selanjutnya ticket aduan akan dibuat secara otomatis.';
                                    // return redirect()->to(base_url('/user/start_asking'));
                                } else {
                                    // session()->setFlashdata('failed', 'Ticket kamu belum berhasil dibuat');
                                    $arr = '<p>Tiket belum berhasil dibuat. Silakan coba beberapa saat lagi';
                                    // return redirect()->to(base_url('/user/start_asking'));
                                }


                                // $getID = $builder->insert($data);
                                // $arr = '<p>Maaf untuk sementara ini, pertanyaan yang anda ajukan akan kami diskusikan terlebih dahulu dan akan ditindak lanjuti melalui email apabila sudah ada solusinya.<br /> silahkan masukan email anda <input type="text" name="email' . $getID . '" id="email' . $getID . '">&nbsp;<a onclick="simpanemail(' . $getID . ')" href="#">Kirim</a></p>';

                                $data = array('idvocab' => '');
                                session()->set($data);
                            } else {
                                // echo "trim2";
                                // $this->db->query("INSERT INTO `askpending` (`ask`, `status`,`tglask`,`idcustomer`) VALUES ('" . $tesklama . "', '1', '" . date('Y-m-d H:i:s') . "','" . $idcustomer . "')");
                                // $getID = $this->db->insert_id();
                                $arr = $data['answer'] . '. Bagaimana, Bisa tidak? jika bisa ketik `YA` tapi jika tidak bisa ketikkan `TIDAK`, Terima Kasih';
                                $data = array('idvocab' => $data['idvocab']);
                                // $this->session->set_userdata($data);
                                session()->set($data);
                            }
                        }
                    }
                    echo $arr;
                } else {
                    echo "Tidak kenapa? <br> Apakah ada yang bisa kami bantu?";
                }
                exit;
            } else {
                $arr = "Maaf Coba Masukkan Kembali Pertanyaan Anda, karena kami masih tidak paham maksud anda. Terima kasih";
                echo $arr;
                exit;
            }
        }

        if ($teks) {
            echo "teks ada: " . $teks;
            $kata = '';
            $tmpkata = '';
            for ($i = 0; $i < $jumdata; $i++) {
                // $sql = "SELECT correctword FROM correctword WHERE word='" . $correctword[$i] . "'";
                // $tampil = $this->db->query($sql);
                // $data = mysqli_fetch_array($tampil);
                $query = $this->db->query("SELECT correctword FROM correctword WHERE word='" . $correctword[$i] . "'");
                if (count($query->getResult('array')) == 0) {
                    $tmpkata .= $correctword[$i] . " ";
                    //  .= => $hasil = $hasil + $correctword[$i]
                } else {
                    // $data = $query->getResult();
                    // $data = $tampil->getRow();
                    $kata = '';
                    foreach ($query->getResult('array') as $data) {

                        if (trim($data['correctword']) <> '') {
                            $kata .= $data['correctword'] . " ";
                        } else {
                            $kata .= $correctword[$i] . " ";
                        }
                    }
                    $teks = trim($kata);
                    $tmpkata .= $teks . " ";
                }
            }
            // echo "hasil: " . $hasil;
        }
        // d($tmpkata);
        $cekVocabs = $this->UserModel->cekVocabs($tmpkata);
        d($cekVocabs);



        if ((isset($cekVocabs['idvocab']) != 0) && (isset($cekVocabs['idcustomer']) != 0)) {
            echo "cek vocab";
            $idvocab = $cekVocabs['idvocab'];
            $idcustomer = $cekVocabs['idcustomer'];
            // $idcustomer = session()->get('idcustomer');
            session()->set('idcustomer1', $cekVocabs['idcustomer']);
            session()->set('idvocab1', $cekVocabs['idvocab']);
            session()->set('ask', $cekVocabs['ask']);
        } else {
            $teks = $tmpkata;
            // dd($teks);
            $idcustomer = session()->get('idcustomer');
            $email = session()->get('email');
            // d($idcustomer);
            $cekCsProduct = $this->UserModel->cekCsProduct($idcustomer);
            // d($cekCsProduct['csproduct']);
            $csproduct = $cekCsProduct['csproduct'];
            $getProject1 = $this->UserModel->getProject1($idcustomer);
            // d($getProject1);
            $csNama = $this->UserModel->csNama($idcustomer);
            // d($csNama);

            // *Revisi => jika pertanyaan tidak ada diknowledge maka otomatis akan dibuatkan ticket 
            // $builder = $this->db->table('askpending');
            // $data = [
            //     'ask' => $teks,
            //     'tglask' => date('Y-m-d H:i:s'),
            //     'idcustomer' => $idcustomer,
            //     'status' => 1,
            //     'email' => $email
            // ];

            $data = [
                'csnama' => $csNama['csnama'],
                'csproduct' => $getProject1['namaproject'],
                'warantyperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['uatend']))),
                'contractperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['billstartdate']))),
                'reportdate'  => date('Y-m-d '),
                'reportby'  => $csNama['pic'],
                'problemsummary'  => $teks,
                'status'  => 'Not Approve',
                'idcustomer' => $idcustomer
            ];
            // dd($data);

            $builder = $this->db->table('while_ticket');
            if ($builder->insert($data)) {
                // session()->setFlashdata('pesan', 'Ticket kamu berhasil dibuat');
                $arr = '<p>Teknisi kami akan segera menangani atas pertanyaan yang anda ajukan. Selanjutnya ticket aduan akan dibuat secara otomatis.';
                // return redirect()->to(base_url('/user/start_asking'));
            } else {
                // session()->setFlashdata('failed', 'Ticket kamu belum berhasil dibuat');
                $arr = '<p>Tiket belum berhasil dibuat. Silakan coba beberapa saat lagi';
                // return redirect()->to(base_url('/user/start_asking'));
            }

            // dd($data);
            // $getID = $builder->insert($data);

            // $builder->insert($data);
            // foreach ($getID->getResult() as $row) {
            //     echo $row->ask;
            //     echo $row->tglask;
            //     echo $row->idcustomer;
            // }
            // // echo $getID;
            // $arr = '<p>Maaf untuk sementara ini, pertanyaan yang anda ajukan akan kami diskusikan terlebih dahulu dan akan ditindak lanjuti melalui email apabila sudah ada solusinya.';

            $data = array('idvocab' => '');
            session()->set($data);
            return $arr;
        };


        // $ipclient = session()->set('ipclient');
        // $tesklama = session()->set('tesklama');
        // $ipclient = $this->session->set('ipclient');
        // $tesklama = $this->session->userdata('kataterakhir');
        //d($idvocab);
        // d($ipclient);

        //=====Konfirmasi Benar atau tidaknya sebuah jawaban=====
        // if ($teks == 'ya') {
        //     //echo "$teks";
        //     echo session()->get('idvocab');
        //     $idvocab = session()->get('idvocab');
        //     if ($idvocab <> '') {
        //         //echo '$idvocsb';
        //         $sql = "SELECT * FROM vocabs WHERE idvocab='" . $idvocab . "'";
        //         $tampil =  $this->db->query($sql);
        //         // $data = $tampil->getResult('array');
        //         // $data = mysqli_fetch_array($tampil);
        //         foreach ($tampil->getResult('array') as $data) {
        //             $totalask = $data['tolask'] + 1;
        //         }
        //         // d($data);
        //         $update = "UPDATE `vocabs` SET `tolask`='" . $totalask . "' WHERE (`idvocab`='" . $idvocab . "')";
        //         $this->db->query($update);

        //         $data = array('idvocab' => '');
        //         session()->set($data);


        //         echo "Syukur deh kalo sudah bisa.. kalo ada apa-apa lagi silahkan saja hubungi kami kembali ya? terima kasih";
        //     } else {
        //         echo "Ya, Apakah ada yang bisa kami bantu?";
        //     }
        //     exit;
        // } elseif ($teks == 'tidak') {
        //     // echo "tidak";
        //     if ($idvocab <> '') {
        //         $hapus = "DELETE FROM tmppropabilityvocab WHERE idvocab='" . $idvocab . "' AND idcustomer='" . $idcustomer . "'";
        //         // echo "tmpprobabilityvocab 'tidak'";
        //         $this->db->query($hapus);

        //         $sql = "SELECT b.idvocab, b.answer FROM tmppropabilityvocab AS a INNER JOIN vocabs AS b ON b.idvocab = a.idvocab WHERE a.idcustomer='" . $idcustomer . "' ORDER BY a.jumpprobability DESC";
        //         $tampil = $this->db->query($sql);
        //         // $data = mysqli_fetch_array($tampil);
        //         // $data = $tampil->getResult('array');
        //         foreach ($tampil->getResult('array') as $data) {

        //             if (trim($data['answer']) <> '') {
        //                 //echo "trim";
        //                 $arr = $data['answer'] . '. Bagaimana, Bisa tidak? jika bisa ketik `YA` tapi jika tidak bisa ketikkan `TIDAK`, Terima Kasih';
        //                 $data = array('idvocab' => $data['idvocab']);
        //                 // $this->session->set_userdata($data);
        //                 session()->set($data);
        //             } else {
        //                 // $this->db->query("INSERT INTO `askpending` (`ask`, `status`,`tglask`,`idcustomer`) VALUES ('" . $tesklama . "', '1', '" . date('Y-m-d H:i:s') . "','" . $idcustomer . "')");
        //                 // $getID = $this->db->insert_id();
        //                 $builder = $this->db->table('askpending');
        //                 $data = [
        //                     'ask' => $teks,
        //                     'tglask' => date('Y-m-d H:i:s'),
        //                     'idcustomer' => $idcustomer,
        //                     'status' => 1
        //                 ];

        //                 // dd($data);
        //                 $getID = $builder->insert($data);
        //                 $arr = '<p>Maaf untuk sementara ini, pertanyaan yang anda ajukan akan kami diskusikan terlebih dahulu dan akan ditindak lanjuti melalui email apabila sudah ada solusinya.<br /> silahkan masukan email anda <input type="text" name="email' . $getID . '" id="email' . $getID . '">&nbsp;<a onclick="simpanemail(' . $getID . ')" href="#">Kirim</a></p>';

        //                 $data = array('idvocab' => '');
        //                 session()->set($data);
        //             }
        //             echo $arr;
        //         }
        //     } else {
        //         echo "Tidak kenapa? <br> Apakah ada yang bisa kami bantu?";
        //     }
        //     exit;
        // }
        //======Exit Konfirmasi Benar atau tidaknya sebuah jawaban=====


        // if ($teks) {
        //=====Kamus kata untuk menyamakan atau menyetarakan kata=============
        // $correctword = explode(" ", $teks);
        // d($correctword);
        // $jumdata = count($correctword);

        //-----Pengecekan Kata Minimal Harus Lebih dari 3 kata-----
        // if ($jumdata < 3) {
        //     $arr = "Maaf Coba Masukkan Kembali Pertanyaan Anda, karena kami masih tidak paham maksud anda. Terima kasih";
        //     echo $arr;
        //     exit;
        // }
        //-----Exit Kata Minimal-----

        // $kata = '';
        // echo $teks . "DAN" . $jumdata;
        // for ($i = 0; $i < $jumdata; $i++) {
        //     // $sql = "SELECT correctword FROM correctword WHERE word='" . $correctword[$i] . "'";
        //     // $tampil = $this->db->query($sql);
        //     // $data = mysqli_fetch_array($tampil);
        //     // echo "corret word";
        //     $query = $this->db->query("SELECT correctword FROM correctword WHERE word='" . $correctword[$i] . "'");

        //     // $data = $query->getResult();
        //     // $data = $tampil->getRow();
        //     foreach ($query->getResult() as $data) {
        //         // d($data['correctword']);

        //         if (trim($data['correctword']) <> '') {
        //             $kata .= $data['correctword'] . " ";
        //             // echo "correct = " . $data['correctword'];
        //         } else {
        //             $kata .= $correctword[$i] . " ";
        //         }
        //     }
        // }
        // $teks = trim($kata);
        // d($teks);
        //=====Exit Kamus Kata===============

        //==========Mencari berdasarkan data yang berkemungkinan terbesar berdasarkan kata=====
        $this->db->query("DELETE FROM tmppropabilityvocab WHERE idcustomer='" . $idcustomer . "'");
        //echo "delete tmppropabilityvocab ";
        $teks = $tmpkata;
        // d($teks);
        $correctword = explode(" ", $teks);
        $jumdata = count($correctword);
        $kata = '';
        for ($i = 0; $i < $jumdata; $i++) {
            // Cocokkan kata yang udah dipecah ke tabel vocabs
            $sql = "SELECT * FROM vocabs WHERE MATCH(ask) AGAINST('" . $correctword[$i] . "' IN BOOLEAN MODE)";
            $tampil = $this->db->query($sql);
            foreach ($tampil->getResult('array') as $data) {
                $sql_jumtmpvocab = "SELECT COUNT(*) jum FROM tmppropabilityvocab WHERE idvocab=" . $data['idvocab'] . " AND idcustomer='" . $idcustomer . "'";
                $tampil_jumtmpvocab = $this->db->query($sql_jumtmpvocab);
                // $data_jumtmpvocab = mysqli_fetch_array($tampil_jumtmpvocab);
                foreach ($tampil_jumtmpvocab->getResult('array') as $data_jumtmpvocab) {

                    $jumtmpvocab = $data_jumtmpvocab['jum'];
                }
                //-------------Exit Cek Jumlah Vocab--------

                //-------------Cek Vocab-------------
                $sql_tmpvocab = "SELECT * FROM tmppropabilityvocab WHERE idvocab=" . $data['idvocab'] . " AND idcustomer='" . $idcustomer . "'";
                $tampil_tmpvocab = $this->db->query($sql_tmpvocab);
                // $data_tmpvocab = mysqli_fetch_array($tampil_tmpvocab);
                foreach ($tampil_tmpvocab->getResult('array') as $data_tmpvocab) {
                    $jumprobability = $data_tmpvocab['jumpprobability'];
                }
                //-------------Exit Cek Vocab--------

                if ($jumtmpvocab == 0) {
                    $simpan = "INSERT INTO `tmppropabilityvocab` (`idvocab`, `jumpprobability`,`idcustomer`) VALUES ('" . $data['idvocab'] . "', '1','" . $idcustomer . "')";
                    $this->db->query($simpan);
                } else {
                    $jumprobability = $data_tmpvocab['jumpprobability'] + 1;
                    $update = "UPDATE `tmppropabilityvocab` SET `jumpprobability`=" . $jumprobability . " WHERE (`idvocab`='" . $data['idvocab'] . "') AND (`idcustomer`='" . $idcustomer . "')";
                    $this->db->query($update);
                }
            }
            // while ($data = mysqli_fetch_array($tampil)) {
            //     //-------------Cek Jumlah Vocab-------------
            //     $sql_jumtmpvocab = "SELECT COUNT(*) jum FROM tmppropabilityvocab WHERE idvocab=" . $data['id'] . " AND ipclient='" . $ipclient . "'";
            //     $tampil_jumtmpvocab = $this->db->query($sql_jumtmpvocab);
            //     $data_jumtmpvocab = mysqli_fetch_array($tampil_jumtmpvocab);
            //     $jumtmpvocab = $data_jumtmpvocab['jum'];
            //     //-------------Exit Cek Jumlah Vocab--------

            //     //-------------Cek Vocab-------------
            //     $sql_tmpvocab = "SELECT * FROM tmppropabilityvocab WHERE idvocab=" . $data['id'] . " AND ipclient='" . $ipclient . "'";
            //     $tampil_tmpvocab = $this->db->query($sql_tmpvocab);
            //     $data_tmpvocab = mysqli_fetch_array($tampil_tmpvocab);
            //     //-------------Exit Cek Vocab--------

            //     if ($jumtmpvocab == 0) {
            //         $simpan = "INSERT INTO `tmppropabilityvocab` (`idvocab`, `jumprobability`,`ipclient`) VALUES ('" . $data['id'] . "', '1','" . $ipclient . "')";
            //         $this->db->query($simpan);
            //     } else {
            //         $jumprobability = $data_tmpvocab['jumprobability'] + 1;
            //         $update = "UPDATE `tmppropabilityvocab` SET `jumprobability`=" . $jumprobability . " WHERE (`idvocab`='" . $data['id'] . "') AND (`ipclient`='" . $ipclient . "')";
            //         $this->db->query($update);
            //     }
            // }
        }
        //===========Exit Mencari Berdasarkan data berkata==============


        //===========Mencari Data Profile Peminta HelpDesk============
        $sql = "
				SELECT jenisedc,lokasi,pic FROM edc WHERE idcustomer='" . $idcustomer . "'
			";
        d($idcustomer);
        $tampil = $this->db->query($sql);
        foreach ($tampil->getResult('array') as $data) {
            $jenisedc = $data['jenisedc'];
            $lokasi = $data['lokasi'];
            $pic = $data['pic'];
        }
        // d($jenisedc);
        // while ($data = mysqli_fetch_array($tampil)) {
        //     $departement = $data['dept'];
        //     $kantor = $data['lokasi'];
        //     $server = $data['server'];
        //     $pengadu = $data['nama_user'];
        // }
        //===========Exit Mencari Data Profile Peminta Helpdesk=======

        //===========Memberikan Nilai Bobot Kepada setiap Vocab=======
        $sql = "
        	SELECT
        		a.id,
        		a.jenisedc,
        		a.lokasi,
                a.pic,
                b.jumpprobability
        	FROM
        		edc AS a
        		LEFT JOIN tmppropabilityvocab AS b ON b.idtmpvocab  = a.id AND b.idcustomer = '" . $idcustomer . "'
        	";

        // * $ipclient diganti $idcustomer, tapi kolom ipclient gaada di tabel tmppropabilityvocab
        // $sql = "
        // 	SELECT
        // 		a.idvocab,
        // 		a.pic,
        // 		a.jenisedc,
        // 		a.lokasi,
        //         b.jumpprobability
        // 	FROM
        // 		vocabs AS a
        // 		LEFT JOIN tmppropabilityvocab AS b ON b.idtmpvocab  = a.idvocab AND b.idcustomer = '" . $idcustomer . "'
        // 	";
        $tampil = $this->db->query($sql);
        // d($tampil);
        foreach ($tampil->getResult() as $data) {
            //d($data);
            $bobotjenisedc = 0.3;
            $bobotlokasi = 0.2;
            $bobotpic = 0.3;
            // $bobotpengadu = '0,5';

            $nilaijenisedc = 0;
            $nilailokasi = 0;
            $nilaipic = 0;
            // $nilaipengadu = '0';
            //d($data->jenisedc);
            //d($data->lokasi);
            //d($data->pic);
            if ($data->jenisedc == $jenisedc) {
                $nilaijenisedc = 1;
            }
            if ($data->lokasi == $lokasi) {
                $nilailokasi = 1;
            }
            if ($data->pic == $pic) {
                $nilaipic = 1;
            }
            // if ($data['pengadu'] == $pengadu) {
            //     $nilaipengadu = 1;
            // }
            //d($data->jumpprobability);
            $nilai = (($bobotjenisedc * $nilaijenisedc) + ($bobotlokasi * $nilailokasi) + ($bobotpic * $nilaipic)  + $data->jumpprobability);
            $bobot = $bobotjenisedc + $bobotlokasi + $bobotpic  + $jumdata;

            $hasil = $nilai / $bobot;
            // d($hasil);

            //-------------Cek Jumlah Vocab-------------
            $sql_jumtmpvocab = "SELECT COUNT(*) jum FROM tmppropabilityvocab WHERE idvocab=" . $data->id . " AND idcustomer='" . $idcustomer . "'";
            $tampil_jumtmpvocab = $this->db->query($sql_jumtmpvocab);
            // $data_jumtmpvocab = mysqli_fetch_array($tampil_jumtmpvocab);
            // foreach ($tampil_jumtmpvocab->getResultArray() as $data_jumtmpvocab) {
            //     $data_jumtmpvocab['jum'];
            // }

            foreach ($tampil_jumtmpvocab->getResult('array') as $data_jumtmpvocab) {
                $jumtmpvocab = $data_jumtmpvocab['jum'];
            }


            //d($jumtmpvocab);
            //-------------Exit Cek Jumlah Vocab--------
            if ($hasil == 0) {
                $delete = "DELETE FROM `tmppropabilityvocab` WHERE idvocab=" . $data->id . "";
            } else {
                if ($jumtmpvocab == 0) {
                    // $simpan = "INSERT INTO `tmppropabilityvocab` (`ipclient`,`idvocab`, `jumpprobability`) VALUES ('" . $ipclient . "','" . $data->id . "', '" . $hasil . "')";
                    // $this->db->query($simpan);

                    $builder = $this->db->table('tmppropabilityvocab');
                    $data = [
                        'idcustomer' => $idcustomer,
                        'idvocab' => $data->id,
                        'jumpprobability' => $hasil
                    ];

                    // dd($data);
                    $builder->insert($data);
                } else {
                    $update = "UPDATE `tmppropabilityvocab` SET `jumpprobability`=" . $hasil . " WHERE (`idvocab`='" . $data->id . "') AND (`idcustomer`='" . $idcustomer . "')";
                    $this->db->query($update);
                }
            }
        }
        // while ($data = mysqli_fetch_array($tampil)) {
        //     $bobotdepartement = '0,1';
        //     $bobotkantor = '0,2';
        //     $bobotserver = '0,3';
        //     $bobotpengadu = '0,5';

        //     $nilaidepartement = '0';
        //     $nilaikantor = '0';
        //     $nilaiserver = '0';
        //     $nilaipengadu = '0';

        //     if ($data['departement'] == $departement) {
        //         $nilaidepartement = 1;
        //     }
        //     if ($data['kantor'] == $kantor) {
        //         $nilaikantor = 1;
        //     }
        //     if ($data['server'] == $server) {
        //         $nilaiserver = 1;
        //     }
        //     if ($data['pengadu'] == $pengadu) {
        //         $nilaipengadu = 1;
        //     }

        //     $nilai = (($bobotdepartement * $nilaidepartement) + ($bobotkantor * $nilaikantor) + ($bobotserver * $nilaiserver) + ($bobotpengadu + $nilaipengadu) + $data['jumprobability']);
        //     $bobot = $bobotdepartement + $bobotkantor + $bobotserver + $bobotpengadu + $jumdata;

        //     $hasil = $nilai / $bobot;

        //     //-------------Cek Jumlah Vocab-------------
        //     $sql_jumtmpvocab = "SELECT COUNT(*) jum FROM tmpprobabilityvocab WHERE idvocab=" . $data['id'] . " AND ipclient='" . $ipclient . "'";
        //     $tampil_jumtmpvocab = $this->db->query($sql_jumtmpvocab);
        //     $data_jumtmpvocab = mysqli_fetch_array($tampil_jumtmpvocab);
        //     $jumtmpvocab = $data_jumtmpvocab['jum'];
        //     //-------------Exit Cek Jumlah Vocab--------
        //     if ($hasil == 0) {
        //         $delete = "DELETE FROM `tmpprobabilityvocab` WHERE idvocab=" . $data['id'] . "";
        //     } else {
        //         if ($jumtmpvocab == 0) {
        //             $simpan = "INSERT INTO `tmpprobabilityvocab` (`idvocab`, `jumprobability`,`ipclient`) VALUES ('" . $data['id'] . "', '" . $hasil . "','" . $ipclient . "')";
        //             $this->db->query($simpan);
        //         } else {
        //             $update = "UPDATE `tmpprobabilityvocab` SET `jumprobability`=" . $hasil . " WHERE (`idvocab`='" . $data['id'] . "') AND (`ipclient`='" . $ipclient . "')";
        //             $this->db->query($update);
        //         }
        //     }
        // }
        //==========Exit Memberikan Nilai Bobot Kepada Setiap Vocab=====


        //===========Pemanggilan Data Yang sudah sesuai atau tidak==========
        $sql = "SELECT b.idvocab, b.answer FROM tmppropabilityvocab AS a INNER JOIN vocabs AS b ON b.idvocab = a.idvocab WHERE a.idcustomer='" . $idcustomer . "' ORDER BY a.jumpprobability DESC LIMIT 1";
        $tampil = $this->db->query($sql);

        // $data = mysqli_fetch_array($tampil);
        foreach ($tampil->getResultArray() as $data) {
            //d(trim($data['answer']));

            if (trim($data['answer']) <> '') {
                //$arr=$data['answer'].'<br><br> Mohon Konfirmasi apakah informasi kami benar atau tidak? jika benar ketik `YA` jika salah ketik `TIDAK`, maka kami akan memberikan informasi lagi yang mungkin... ';
                // echo "trim data answer";
                $arr = $data['answer'] . '. Bagaimana, Bisa tidak? jika bisa ketik `YA` tapi jika tidak bisa ketikkan `TIDAK`, Terima Kasih';
                $data = array('idvocab' => $data['idvocab']);
                session()->set('answer', $data);
                session()->set('idvocab', $data['idvocab']);
            } else {
                // $this->db->query("INSERT INTO `askpending` (`ask`,`tglask`, `idcustomer`,`status`) VALUES ('" . $teks . "', '1', '" . date('Y-m-d H:i:s') . "','" . $idcustomer . "')");
                // $getID = $this->db->insert_id();

                // *Revisi => jika pertanyaan tidak ada diknowledge maka otomatis akan dibuatkan ticket 
                // $builder = $this->db->table('askpending');
                // $data = [
                //     'ask' => $teks,
                //     'tglask' => date('Y-m-d H:i:s'),
                //     'idcustomer' => $idcustomer,
                //     'status' => 1
                // ];

                $teks = $hasil;
                // dd($teks);
                $idcustomer = session()->get('idcustomer');
                $email = session()->get('email');
                // d($idcustomer);
                $cekCsProduct = $this->UserModel->cekCsProduct($idcustomer);
                // d($cekCsProduct['csproduct']);
                $csproduct = $cekCsProduct['csproduct'];
                $getProject1 = $this->UserModel->getProject1($idcustomer);
                // d($getProject1);
                $csNama = $this->UserModel->csNama($idcustomer);
                // d($csNama);

                $data = [
                    'csnama' => $csNama['csnama'],
                    'csproduct' => $getProject1['namaproject'],
                    'warantyperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['uatend']))),
                    'contractperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['billstartdate']))),
                    'reportdate'  => date('Y-m-d '),
                    'reportby'  => $csNama['pic'],
                    'problemsummary'  => $teks,
                    'status'  => 'Not Approve',
                    'idcustomer' => $idcustomer
                ];
                // dd($data);

                $builder = $this->db->table('while_ticket');
                if ($builder->insert($data)) {
                    // session()->setFlashdata('pesan', 'Ticket kamu berhasil dibuat');
                    $arr = '<p>Teknisi kami akan segera menangani atas pertanyaan yang anda ajukan. Selanjutnya ticket aduan akan dibuat secara otomatis.';
                    // return redirect()->to(base_url('/user/start_asking'));
                } else {
                    // session()->setFlashdata('failed', 'Ticket kamu belum berhasil dibuat');
                    $arr = '<p>Tiket belum berhasil dibuat. Silakan coba beberapa saat lagi';
                    // return redirect()->to(base_url('/user/start_asking'));
                }

                // dd($data);
                // $getID = $builder->insert($data);
                // $getID = $this->db->insert_id();
                //$arr = '<p>Maaf untuk sementara ini, pertanyaan yang anda ajukan akan kami diskusikan terlebih dahulu dan akan ditindak lanjuti melalui email apabila sudah ada solusinya.<br /> silahkan masukan email anda <input type="text" name="email'.$getID.'" id="email'.$getID.'">&nbsp;<a onclick="simpanemail('.$getID.')" href="#">Kirim</a></p>';	
                // $arr = '<p>Aduh!! Maaf Sepertinya pertanyaan anda tidak ada di dalam databases kami, akan coba kami diskusikan dulu ya kepada team IT, akan kami informasikan kembali apabila sudah. terima kasih</p>. .<br /> silahkan masukan email anda <input type="text" name="email' . $getID . '" id="email' . $getID . '">&nbsp;<a onclick="simpanemail(' . $getID . ')" href="#">Kirim</a></p>
                // ';
            }
        }
        //============Exit Pemanggilan Data yang sesuai atau tidak=========
        // $teks = $tmpkata;
        if ($hasil == 0) {
            $arr = 'Kamu mau nanya apa2?';
        }
        echo $arr;

        $data = array('kataterakhir' => $teks);
        session()->set($data);
    }
}




    //--------------------------------------------------------------------
