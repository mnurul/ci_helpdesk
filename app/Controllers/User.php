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
    // public function index()
    // {
    //     $data = [
    //         'title' => 'Home User'
    //     ];
    //     return view('user/index', $data);
    // }

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
            // $ticketcs = $this->TicketModel->search_myassigment($search, $idcs);

            // Agar data tidak dimulai dari nol saat diklik 1 atau 2
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $mulai = ($tampil * $page) - $tampil;
            }

            // $ticketcs = $this->TeknisiModel->findAll($tampil, $mulai);
            $ticketcs = $this->TicketModel->where('idcustomer', $idcs)->findAll($tampil, $mulai);
            // $status_ticket = $this->TicketModel->status_ticket($idcs);
            // dd($idcs);
            // dd($ticketcs);
            // $sql = "SELECT * FROM v_ticket  WHERE idcustomer='" . $idcs . "'";
            // $status_ticket = $this->db->query($sql)->getResult('array');
            // dd($ticketcs);
        } else {
            // $while_ticket = $this->TicketModel;
            // $ticketcs = $this->TicketModel->where('idcustomer', $idcs)->like('csnama', $search)->orLike('csproduct', $search)->orLike('reportby', $search)->like('problemsummary', $search)->orLike('problemdetail', $search)->orLike('status', $search)->findAll();
            // $ticketcs = $this->TicketModel->search_myassigment($search, $idcs);

            $sql = "SELECT * FROM while_ticket  WHERE idcustomer='" . $idcs . "' AND (problemsummary 
            LIKE '%$search%' OR reportby LIKE '%$search%' OR noticket LIKE '%$search%')";
            $ticketcs = $this->db->query($sql)->getResult('array');
        }

        // $tampil = 2;
        // $mulai = 0;

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
            // 'count' => $this->db->table('while_ticket')->like('idcsutomer', $idcs)->count(),
            'count' => $count,
            // 'while_ticket' => $while_ticket->paginate(3, 'while_ticket'),
            // 'pager' => $this->TicketModel->pager,
            'pager' => $this->pager,
            'idcs' => $ticketcs,
            // 'status_ticket' => $status_ticket,
            'tampil' => $tampil,
            'total' => $count
        ];
        return view('v_ticket_status/index', $data);
    }

    public function detail_t_status($noticket)
    {
        // $noticket = $this->request->getVar('noticket');

        // $t_status = $this->TicketModel->getTicketStatus($noticket);
        $sql = "SELECT * FROM tickets  WHERE noticket 
        LIKE '$noticket%'";
        $t_status = $this->db->query($sql)->getResult('array');
        // dd($ticketcs);
        // dd($t_status);


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

        $cekVocabs = $this->UserModel->cekVocabs($teks);

        $tesklama = session()->get('kataterakhir');

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
                // $idcustomer = session()->get('idcustomer1');
                $idcustomer = session()->get('idcustomer');
                $ask = session()->get('ask');


                if ($idvocab <> '') {
                    $hapus = "DELETE FROM tmppropabilityvocab WHERE idvocab='" . $idvocab . "' AND idcustomer='" . $idcustomer . "'";
                    $this->db->query($hapus);


                    $sql = "SELECT b.idvocab, b.answer FROM tmppropabilityvocab AS a INNER JOIN vocabs AS b ON b.idvocab = a.idvocab WHERE a.idcustomer='" . $idcustomer . "' ORDER BY a.jumpprobability DESC";
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
                            'problemsummary'  => $ask,
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
                            if (trim($data['answer']) == '') {
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
                                    'problemsummary'  => $teks,
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
                                $arr = $data['answer'] . '. Bagaimana, Bisa tidak? jika bisa ketik `YA` tapi jika tidak bisa ketikkan `TIDAK`, Terima Kasih456';
                                $data = array('idvocab' => $data['idvocab']);
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

        if ((isset($cekVocabs['idvocab']) != 0) && (isset($cekVocabs['idcustomer']) != 0)) {
            $idvocab = $cekVocabs['idvocab'];
            //$idcustomer = $cekVocabs['idcustomer'];
            $idcustomer = session()->get('idcustomer');
            session()->set('idcustomer1', $cekVocabs['idcustomer']);
            session()->set('idvocab1', $cekVocabs['idvocab']);
            session()->set('ask', $cekVocabs['ask']);
        } else {
            $teks = $tmpkata;
            $idcustomer = session()->get('idcustomer');
            $email = session()->get('email');
            $cekCsProduct = $this->UserModel->cekCsProduct($idcustomer);
            $csproduct = $cekCsProduct['csproduct'];
            $getProject1 = $this->UserModel->getProject1($idcustomer);
            $csNama = $this->UserModel->csNama($idcustomer);

            // *Revisi => jika pertanyaan tidak ada diknowledge maka otomatis akan dibuatkan ticket 
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

            $builder = $this->db->table('while_ticket');
            if ($builder->insert($data)) {
                $arr = '<p>Teknisi kami akan segera menangani atas pertanyaan yang anda ajukan. Selanjutnya ticket aduan akan dibuat secara otomatis.';
            } else {
                $arr = '<p>Tiket belum berhasil dibuat. Silakan coba beberapa saat lagi';
            }
            $data = array('idvocab' => '');
            session()->set($data);
            return $arr;
        };

        //==========Mencari berdasarkan data yang berkemungkinan terbesar berdasarkan kata=====
        // $this->db->query("DELETE FROM tmppropabilityvocab WHERE idcustomer='" . $idcustomer . "'");
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
                    //$jumprobability = $jumprobability + $data_tmpvocab['jumpprobability'];
                }

                if ($jumtmpvocab == 0) {
                    // $simpan = "INSERT INTO `tmppropabilityvocab` (`idvocab`, `jumpprobability`,`idcustomer`) VALUES ('" . $data['idvocab'] . "', '1','" . $idcustomer . "')";
                    // $this->db->query($simpan);

                    $builder = $this->db->table('tmppropabilityvocab');
                    $insert = [
                        'idcustomer' => $idcustomer,
                        'idvocab' => $data['idvocab'],
                        'jumpprobability' => 1
                    ];

                    $builder->insert($insert);
                } else {
                    // $update = "UPDATE `tmppropabilityvocab` SET `jumpprobability`=" . $jumprobability . " WHERE (`idvocab`='" . $data['idvocab'] . "') AND (`idcustomer`='" . $idcustomer . "')";
                    // $this->db->query($update);
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
        // $sql = "
        // 	SELECT
        // 		a.id,
        // 		a.jenisedc,
        // 		a.lokasi,
        //         a.pic,
        //         b.jumpprobability
        // 	FROM
        // 		edc AS a
        // 		LEFT JOIN tmppropabilityvocab AS b ON b.idtmpvocab  = a.id AND b.idcustomer = '" . $idcustomer . "'
        // 	";

        // * $ipclient diganti $idcustomer, tapi kolom ipclient gaada di tabel tmppropabilityvocab
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
            // d($hasil);

            //-------------Cek Jumlah Vocab-------------
            $sql_jumtmpvocab = "SELECT COUNT(*) jum FROM tmppropabilityvocab WHERE idvocab=" . $data->idvocab . " AND idcustomer='" . $idcustomer . "'";
            $tampil_jumtmpvocab = $this->db->query($sql_jumtmpvocab);

            foreach ($tampil_jumtmpvocab->getResult('array') as $data_jumtmpvocab) {
                $jumtmpvocab = $data_jumtmpvocab['jum'];
            }
            //-------------Exit Cek Jumlah Vocab--------
            if ($hasil == 0) {
                // $delete = "DELETE FROM `tmppropabilityvocab` WHERE idvocab=" . $data->idvocab . "";
                $builder = $this->db->table('tmppropabilityvocab');
                $builder->where('idvocab', $data->idvocab);
                $builder->delete();
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
                    // $update = "UPDATE `tmppropabilityvocab` SET `jumpprobability`=" . $hasil . " WHERE (`idvocab`='" . $data->idvocab . "') AND (`idcustomer`='" . $idcustomer . "')";
                    // $this->db->query($update);

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
            if (trim($data['answer']) <> '') {
                $arr = $data['answer'] . '. Bagaimana, Bisa tidak? jika bisa ketik `YA` tapi jika tidak bisa ketikkan `TIDAK`, Terima Kasih';
                $data = array('idvocab' => $data['idvocab']);
                session()->set('answer', $data);
                session()->set('idvocab', $data['idvocab']);
            } else {
                $teks = $tmpkata;
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
                    'problemsummary'  => $teks,
                    'status'  => 'Not Approve',
                    'idcustomer' => $idcustomer
                ];

                $builder = $this->db->table('while_ticket');
                if ($builder->insert($data)) {
                    $arr = '<p>Teknisi kami akan segera menangani atas pertanyaan yang anda ajukan. Selanjutnya ticket aduan akan dibuat secara otomatis.';
                } else {
                    $arr = '<p>Tiket belum berhasil dibuat. Silakan coba beberapa saat lagi';
                }
            }
        }

        //============Exit Pemanggilan Data yang sesuai atau tidak=========
        $teks = $tmpkata;
        if ($teks == "") {
            $arr = 'Kamu mau nanya apa2?';
        }
        echo $arr;

        $data = array('kataterakhir' => $teks);
        // session()->set($data);
        session()->set('kataterakhir', $data);
    }
}






    //--------------------------------------------------------------------
