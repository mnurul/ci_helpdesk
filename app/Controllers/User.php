<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TicketModel;
use App\Models\TicketsModelM;
use App\Models\TeknisiModel;
use App\Models\VocabsModel;
use CodeIgniter\I18n\Time;


class User extends BaseController
{


    protected $UserModel;
    protected $TicketModel;
    protected $TicketsModelM;
    protected $TeknisiModel;
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
        $this->TicketsModelM = new TicketsModelM();
        $this->TeknisiModel = new TeknisiModel();
        $this->VocabsModel = new VocabsModel();
        $email = \Config\Services::email();
        $this->form_validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $this->pager = \Config\Services::pager();
    }

    public function index()
    {
        $search = $this->request->getVar('search');
        $idcs = session()->get('idcustomer');
        $tampil = 2;
        $mulai = 0;
        $jumlah = $this->TicketModel->where('idcustomer', $idcs)->findAll();
        $count = count($jumlah);
        if ($search == null) {

            // Agar data tidak dimulai dari nol saat diklik 1 atau 2
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $mulai = ($tampil * $page) - $tampil;
            }

            $ticketcs = $this->TicketModel->where('idcustomer', $idcs)->findAll($tampil, $mulai);
        } else {


            $sql = "SELECT * FROM while_ticket  WHERE idcustomer='" . $idcs . "' AND (problemsummary 
            LIKE '%$search%' OR reportby LIKE '%$search%' OR noticket LIKE '%$search%')";
            $ticketcs = $this->db->query($sql)->getResult('array');
        }



        // // Agar data tidak dimulai dari nol saat diklik 1 atau 2
        // if (isset($_GET['page'])) {
        //     $page = $_GET['page'];
        //     $mulai = ($tampil * $page) - $tampil;
        // }

        // $jumlah = $this->TicketModel->where('idcustomer', $idcs)->findAll();
        // $count = count($jumlah);
        // $ticketcs = $this->TicketModel->where('idcustomer', $idcs)->findAll($tampil, $mulai);


        $data = [
            'title' => 'View Ticket Status',
            'count' => $count,

            'pager' => $this->pager,
            'idcs' => $ticketcs,
            'tampil' => $tampil,
            'total' => $count
        ];
        return view('v_ticket_status/index', $data);
    }

    public function detail_t_status($noticket)
    {

        $sql = "SELECT * FROM tickets  WHERE noticket 
        LIKE '$noticket%'";
        $t_status = $this->db->query($sql)->getResult('array');



        $data = [
            'title' => 'Detail Waiting for Close',
            't_status' => $t_status
        ];
        return view('detail_t_status/index', $data);
    }

    public function create_ticket()
    {
        $csnama = $this->UserModel->joinCs();
        $namaProject = $this->UserModel->namaProject();
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
            $iduser = session()->get('iduser');
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



        $data = [
            'title' => 'Start Asking',

        ];
        return view('start_asking/index', $data);
    }

    public function auto()
    {
        if (isset($_GET['term'])) {
            $result = $this->VocabsModel->search($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->ask;
                echo json_encode($arr_result);
            }
        }
    }

    public function simpanemail()
    {
        $getid = $this->input->get('getid');
        $email = $this->request->getVar('email');
        $this->db->query("UPDATE `askpending` SET `email`='" . $email . "' WHERE (`id`='" . $getid . "')");
    }

    // public function caripertanyaan()
    // {
    //     echo "caripertanyaan";
    //     //-----mengambil data yang di kirim dan mengembalikannya
    //     $q = strtolower($_GET["q"]);
    //     if (!$q) return;

    //     //-----Query untuk mencari data yang dikirimkan berdasarkan npm atau nama
    //     $sql = "SELECT * FROM vocabs WHERE ask LIKE '%" . $q . "%'";
    //     $tampil = "SELECT * FROM vocabs WHERE ask LIKE '%" . $q . "%'";

    //     //-----Menampilkan data dari hasil query
    //     while ($data = mysqli_fetch_array($tampil)) {
    //         echo $data['ask'] . "\n";
    //     }
    // }

    public function tanyajawab()
    {
        $tanya = $this->request->getVar('tanya');
        $teks = strtolower($tanya);





        $correctword = explode(" ", $teks);
        $jumdata = count($correctword);

        //-----Pengecekan Kata Minimal Harus Lebih dari 3 kata-----
        $arr = "|";
        if ($jumdata < 3) {
            if ($teks == "ya") {
                $idvocab = session()->get('idvocab');
                if ($idvocab <> '') {
                    $sql = "SELECT * FROM vocabs WHERE idvocab='" . $idvocab . "'";
                    $tampil =  $this->db->query($sql);

                    foreach ($tampil->getResult('array') as $data) {
                        $totalask = $data['tolask'] + 1;
                    }
                    $update = "UPDATE `vocabs` SET `tolask`='" . $totalask . "' WHERE (`idvocab`='" . $idvocab . "')";
                    $this->db->query($update);

                    $data = array('idvocab' => '');
                    session()->set($data);


                    echo "Syukur deh kalo sudah bisa.. kalo ada apa-apa lagi silahkan saja hubungi kami kembali ya? terima kasih";
                } elseif ($idvocab == '') {
                    echo "Ya, Apakah ada yang bisa kami bantu?";
                }
                exit;
            } elseif ($teks == "tidak") {
                $idvocab = session()->get('idvocab');
                $idcustomer = session()->get('idcustomer');
                $tmpteks = session()->get('ask');



                if ($idvocab <> '') {
                    $hapus = "DELETE FROM tmppropabilityvocab WHERE idvocab='" . $idvocab . "' AND idcustomer='" . $idcustomer . "'";
                    $this->db->query($hapus);


                    $sql = "SELECT b.idvocab, b.answer,a.jumpprobability FROM tmppropabilityvocab AS a INNER JOIN vocabs AS b ON b.idvocab = a.idvocab WHERE a.idcustomer='" . $idcustomer . "' ORDER BY a.jumpprobability DESC LIMIT 1";
                    $tampil = $this->db->query($sql);


                    if (count($tampil->getResult('array')) == 0) {

                        $idcustomer = session()->get('idcustomer');
                        $email = session()->get('email');
                        $cekCsProduct = $this->UserModel->cekCsProduct($idcustomer);
                        $csproduct = $cekCsProduct['csproduct'];
                        $getProject1 = $this->UserModel->getProject1($idcustomer);
                        $csNama = $this->UserModel->csNama($idcustomer);

                        $data = [
                            'csnama' => $csNama['csnama'],
                            'csproduct' => $getProject1['namaproject'],
                            'warantyperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['uatend']))),
                            'contractperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['billstartdate']))),
                            'reportdate'  => date('Y-m-d '),
                            'reportby'  => $csNama['pic'],
                            'problemsummary'  => $tmpteks,
                            'status'  => 'Not Approve',
                            'idcustomer' => $idcustomer
                        ];

                        $builder = $this->db->table('while_ticket');
                        if ($builder->insert($data)) {
                            $arr = '<p>Teknisi kami akan segera menangani atas pertanyaan yang anda ajukan. Selanjutnya ticket aduan akan dibuat secara otomatis.';
                        } else {
                            $arr = '<p>Tiket belum berhasil dibuat. Silakan coba beberapa saat lagi';
                        }

                        $data = array('idvocab' => '');
                        session()->set($data);
                    } else {
                        foreach ($tampil->getResult('array') as $data) {

                            if ($data['jumpprobability'] >= 0.70000000) {
                                $arr = $data['answer'] . '. Bagaimana, Bisa tidak? jika bisa ketik `YA` tapi jika tidak bisa ketikkan `TIDAK`, Terima Kasih456';
                                $data = array('idvocab' => $data['idvocab']);
                                session()->set($data);
                            } else {
                                $idcustomer = session()->get('idcustomer');

                                $cekCsProduct = $this->UserModel->cekCsProduct($idcustomer);
                                $dataProject1 = $this->UserModel->getProject1($idcustomer);
                                $csNama = $this->UserModel->csNama($idcustomer);

                                $data = [
                                    'csnama' => $csNama['csnama'],
                                    'csproduct' => $dataProject1['namaproject'],
                                    'warantyperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($dataProject1['uatend']))),
                                    'contractperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($dataProject1['billstartdate']))),
                                    'reportdate'  => date('Y-m-d '),
                                    'reportby'  => $csNama['pic'],
                                    'problemsummary'  => $tmpteks,
                                    'status'  => 'Not Approve',
                                    'idcustomer' => $idcustomer
                                ];

                                $builder = $this->db->table('while_ticket');
                                if ($builder->insert($data)) {
                                    $arr = '<p>Teknisi kami akan segera menangani atas pertanyaan yang anda ajukan. Selanjutnya ticket aduan akan dibuat secara otomatis.';
                                } else {
                                    $arr = '<p>Tiket belum berhasil dibuat. Silakan coba beberapa saat lagi';
                                }
                                $data = array('idvocab' => '');
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
            $kata = '';
            $tmpkata = '';
            for ($i = 0; $i < $jumdata; $i++) {
                $query = $this->db->query("SELECT correctword FROM correctword WHERE word='" . $correctword[$i] . "'");
                if (count($query->getResult('array')) == 0) {
                    $tmpkata .= $correctword[$i] . " ";
                    //  .= => $hasil = $hasil + $correctword[$i]
                } else {
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
        }
        $cekVocabs = $this->UserModel->cekVocabs($tmpkata);
        session()->set('ask', $tmpkata);


        $idcustomer = session()->get('idcustomer');

        //==========Mencari berdasarkan data yang berkemungkinan terbesar berdasarkan kata=====
        $builder = $this->db->table('tmppropabilityvocab');
        $builder->where('idcustomer ', $idcustomer);
        $builder->delete();

        $teks = trim($tmpkata);
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
                foreach ($tampil_jumtmpvocab->getResult('array') as $data_jumtmpvocab) {
                    $jumtmpvocab = $data_jumtmpvocab['jum'];
                }
                //-------------Exit Cek Jumlah Vocab--------

                //-------------Cek Vocab-------------
                $jumprobability = 0;
                $tmpVar = 0;
                $sql_tmpvocab = "SELECT * FROM tmppropabilityvocab WHERE idvocab=" . $data['idvocab'] . " AND idcustomer='" . $idcustomer . "'";
                $tampil_tmpvocab = $this->db->query($sql_tmpvocab);
                foreach ($tampil_tmpvocab->getResult('array') as $data_tmpvocab) {
                    $tmpVar = $data_tmpvocab['jumpprobability'];
                }

                if ($jumtmpvocab == 0) {


                    $builder = $this->db->table('tmppropabilityvocab');
                    $insert = [
                        'idcustomer' => $idcustomer,
                        'idvocab' => $data['idvocab'],
                        'jumpprobability' => 1
                    ];

                    $builder->insert($insert);
                } else {

                    $jumprobability = $tmpVar + 1;

                    $builder = $this->db->table('tmppropabilityvocab');
                    $builder->set('jumpprobability', $jumprobability);
                    $builder->where('idvocab', $data['idvocab']);
                    $builder->where('idcustomer', $idcustomer);
                    $builder->update();
                }
            }
        }


        //===========Mencari Data Profile Peminta HelpDesk============
        $sql = "
				SELECT jenisedc,lokasi,pic FROM edc WHERE idcustomer='" . $idcustomer . "'
			";
        $tampil = $this->db->query($sql);
        foreach ($tampil->getResult('array') as $data) {
            $jenisedc = $data['jenisedc'];
            $lokasi = $data['lokasi'];
            $pic = $data['pic'];
        }

        //===========Exit Mencari Data Profile Peminta Helpdesk=======

        //===========Memberikan Nilai Bobot Kepada setiap Vocab=======

        $sql = "
        	SELECT
        		a.idvocab,
                a.pic,
                a.answer,
        		a.jenisedc,
                a.lokasi,
                b.idcustomer,
                b.jumpprobability
        	FROM
        		vocabs AS a
        		LEFT JOIN tmppropabilityvocab AS b ON b.idvocab  = a.idvocab AND b.idcustomer = '" . $idcustomer . "'
        	";
        $tampil = $this->db->query($sql);
        foreach ($tampil->getResult() as $data) {
            $bobotjenisedc = 0.3;
            $bobotlokasi = 0.2;
            $bobotpic = 0.1;

            $nilaijenisedc = 0;
            $nilailokasi = 0;
            $nilaipic = 0;
            if ($data->jenisedc == $jenisedc) {
                $nilaijenisedc = 1;
            }
            if ($data->lokasi == $lokasi) {
                $nilailokasi = 1;
            }
            if ($data->pic == $pic) {
                $nilaipic = 1;
            }
            $nilai = (($bobotjenisedc * $nilaijenisedc) + ($bobotlokasi * $nilailokasi) + ($bobotpic * $nilaipic));
            $nilai = $nilai  + $data->jumpprobability;
            $bobot = $bobotjenisedc + $bobotlokasi + $bobotpic  + $jumdata;

            $hasil = $nilai / $bobot;
            // dd($hasil);

            //-------------Cek Jumlah Vocab-------------
            $sql_jumtmpvocab = "SELECT COUNT(*) jum FROM tmppropabilityvocab WHERE idvocab=" . $data->idvocab . " AND idcustomer='" . $idcustomer . "'";
            $tampil_jumtmpvocab = $this->db->query($sql_jumtmpvocab);

            foreach ($tampil_jumtmpvocab->getResult('array') as $data_jumtmpvocab) {
                $jumtmpvocab = $data_jumtmpvocab['jum'];
            }
            //-------------Exit Cek Jumlah Vocab--------
            if ($hasil == 0) {
                $builder = $this->db->table('tmppropabilityvocab');
                $builder->where('idvocab', $data->idvocab);
                $builder->delete();
                $arr = '<p>Keluhan kamu tidak dapat dimenegrti.';
            } else {
                if ($jumtmpvocab == 0) {
                    $builder = $this->db->table('tmppropabilityvocab');
                    $insert = [
                        'idcustomer' => $idcustomer,
                        'idvocab' => $data->idvocab,
                        'jumpprobability' => $hasil
                    ];
                    $builder->insert($insert);
                } else {


                    $builder = $this->db->table('tmppropabilityvocab');
                    $builder->set('jumpprobability', $hasil);
                    $builder->where('idvocab', $data->idvocab);
                    $builder->where('idcustomer', $idcustomer);
                    $builder->update();
                }
            }
        }
        //==========Exit Memberikan Nilai Bobot Kepada Setiap Vocab=====


        //===========Pemanggilan Data Yang sudah sesuai atau tidak==========
        $sql = "SELECT b.idvocab, b.answer,a.jumpprobability FROM tmppropabilityvocab AS a INNER JOIN vocabs AS b ON b.idvocab = a.idvocab WHERE a.idcustomer='" . $idcustomer . "' ORDER BY a.jumpprobability DESC LIMIT 1";
        $tampil = $this->db->query($sql);

        foreach ($tampil->getResult('array') as $data) {
            $tmpteks = session()->get('ask');
            // dd($data['jumpprobability']);

            if ($data['jumpprobability'] >= 0.30000000) {
                $arr = $data['answer'] . '. Bagaimana, Bisa tidak? jika bisa ketik `YA` tapi jika tidak bisa ketikkan `TIDAK`, Terima Kasih123';
                $data = array('idvocab' => $data['idvocab']);
                session()->set($data);
            } else if ($data['jumpprobability'] == 0) {
                $arr = '<p>Keluhan kamu tidak dapat dimenegrti.';
            } else {
                $idcustomer = session()->get('idcustomer');
                $email = session()->get('email');
                $cekCsProduct = $this->UserModel->cekCsProduct($idcustomer);
                $csproduct = $cekCsProduct['csproduct'];
                $getProject1 = $this->UserModel->getProject1($idcustomer);
                $csNama = $this->UserModel->csNama($idcustomer);

                $data = [
                    'csnama' => $csNama['csnama'],
                    'csproduct' => $getProject1['namaproject'],
                    'warantyperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['uatend']))),
                    'contractperiod'  => date('Y-m-d', strtotime("+2 years", strtotime($getProject1['billstartdate']))),
                    'reportdate'  => date('Y-m-d '),
                    'reportby'  => $csNama['pic'],
                    'problemsummary'  => $tmpteks,
                    'status'  => 'Not Approve',
                    'idcustomer' => $idcustomer
                ];

                $builder = $this->db->table('while_ticket');
                if ($builder->insert($data)) {
                    $arr = '<p>Teknisi kami akan segera menangani atas pertanyaan yang anda ajukan. Selanjutnya ticket aduan akan dibuat secara otomatis123.';
                } else {
                    $arr = '<p>Tiket belum berhasil dibuat. Silakan coba beberapa saat lagi';
                }
                $data = array('idvocab' => '');
                session()->set($data);
            }
        }

        //============Exit Pemanggilan Data yang sesuai atau tidak=========
        $teks = $tmpkata;
        if ($teks == "") {
            $arr = 'Kamu mau nanya apa2?';
        }
        echo $arr;

        $data = array('kataterakhir' => $teks);
        session()->set('kataterakhir', $data);
    }
}






    //--------------------------------------------------------------------
