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
            'title' => 'Start Asking'
        ];
        return view('start_asking/index', $data);
    }

    public function simpanemail()
    {
        $getid = $this->input->get('getid');
        $email = $this->input->get('email');
        $this->db->query("UPDATE `askpending` SET `email`='" . $email . "' WHERE (`id`='" . $getid . "')");
    }

    public function caripertanyaan()
    {
        echo "test";
        //-----mengambil data yang di kirim dan mengembalikannya
        $q = strtolower($_GET["q"]);
        if (!$q) return;

        //-----Query untuk mencari data yang dikirimkan berdasarkan npm atau nama
        $sql = "SELECT * FROM vocab WHERE ask LIKE '%" . $q . "%'";
        $tampil = "SELECT * FROM vocab WHERE ask LIKE '%" . $q . "%'";

        //-----Menampilkan data dari hasil query
        while ($data = mysqli_fetch_array($tampil)) {
            echo $data['ask'] . "\n";
        }
    }

    public function tanyajawab()
    {
        echo "test1";
        $teks = $this->input->get('tanya');
        var_dump($teks);
        $teks = strtolower($teks);
        $idvocab = $this->session->userdata('idvocab');
        $ipclient = $this->session->userdata('ipclient');
        $tesklama = $this->session->userdata('kataterakhir');

        //=====Konfirmasi Benar atau tidaknya sebuah jawaban=====
        if ($teks == 'ya') {
            if ($idvocab <> '') {
                $sql = "SELECT * FROM vocab WHERE id='" . $idvocab . "'";
                $tampil =  $this->db->query($sql);
                $data = mysqli_fetch_array($tampil);

                $totalask = $data['tolask'] + 1;
                $update = "UPDATE `vocab` SET `tolask`='" . $totalask . "' WHERE (`id`='" . $idvocab . "')";
                $this->db->query($update);

                $data = array('idvocab' => '');
                $this->session->set_userdata($data);

                echo "Syukur deh kalo sudah bisa.. kalo ada apa-apa lagi silahkan saja hubungi kami kembali ya? terima kasih";
            } else {
                echo "Ya, Apakah ada yang bisa kami bantu?";
            }
            exit;
        } elseif ($teks == 'tidak') {
            if ($idvocab <> '') {
                $hapus = "DELETE FROM tmpprobabilityvocab WHERE idvocab=" . $idvocab . " AND ipclient='" . $ipclient . "'";
                $this->db->query($hapus);

                $sql = "SELECT b.id, b.answer FROM tmpprobabilityvocab AS a INNER JOIN vocab AS b ON b.id = a.idvocab WHERE a.ipclient='" . $ipclient . "' ORDER BY a.jumprobability DESC";
                $tampil = $this->db->query($sql);
                $data = mysqli_fetch_array($tampil);
                if (trim($data['answer']) <> '') {
                    $arr = $data['answer'] . '<br><br>Bagaimana, Bisa tidak? jika bisa ketik `YA` tapi jika tidak bisa ketikkan `TIDAK`, Terima Kasih';
                    $data = array('idvocab' => $data['id']);
                    $this->session->set_userdata($data);
                } else {
                    $this->db->query("INSERT INTO `askpending` (`ask`, `status`,`tglask`,`ipclient`) VALUES ('" . $tesklama . "', '1', '" . date('Y-m-d H:i:s') . "','" . $ipclient . "')");
                    $getID = $this->db->insert_id();
                    $arr = '<p>Maaf untuk sementara ini, pertanyaan yang anda ajukan akan kami diskusikan terlebih dahulu dan akan ditindak lanjuti melalui email apabila sudah ada solusinya.<br /> silahkan masukan email anda <input type="text" name="email' . $getID . '" id="email' . $getID . '">&nbsp;<a onclick="simpanemail(' . $getID . ')" href="#">Kirim</a></p>';

                    $data = array('idvocab' => '');
                    $this->session->set_userdata($data);
                }
                echo $arr;
            } else {
                echo "Tidak kenapa? <br> Apakah ada yang bisa kami bantu?";
            }
            exit;
        }
        //======Exit Konfirmasi Benar atau tidaknya sebuah jawaban=====


        if ($teks) {
            //=====Kamus kata untuk menyamakan atau menyetarakan kata=============
            $correctword = explode(" ", $teks);
            $jumdata = count($correctword);

            //-----Pengecekan Kata Minimal Harus Lebih dari 3 kata-----
            if ($jumdata < 3) {
                $arr = "Maaf Coba Masukkan Kembali Pertanyaan Anda, karena kami masih tidak paham maksud anda. Terima kasih";
                echo $arr;
                exit;
            }
            //-----Exit Kata Minimal-----

            $kata = '';
            for ($i = 0; $i < $jumdata; $i++) {
                $sql = "SELECT correctword FROM correctword WHERE word='" . $correctword[$i] . "'";
                $tampil = $this->db->query($sql);
                $data = mysqli_fetch_array($tampil);
                if (trim($data['correctword']) <> '') {
                    $kata .= $data['correctword'] . " ";
                } else {
                    $kata .= $correctword[$i] . " ";
                }
            }
            $teks = trim($kata);
            //=====Exit Kamus Kata===============

            //==========Mencari berdasarkan data yang berkemungkinan terbesar berdasarkan kata=====
            $this->db->query("DELETE FROM tmpprobabilityvocab WHERE ipclient='" . $ipclient . "'");
            $correctword = explode(" ", $teks);
            $jumdata = count($correctword);
            $kata = '';
            for ($i = 0; $i < $jumdata; $i++) {
                $sql = "SELECT * FROM vocab WHERE MATCH(ask) AGAINST('" . $correctword[$i] . "' IN BOOLEAN MODE)";
                $tampil = $this->db->query($sql);
                while ($data = mysqli_fetch_array($tampil)) {
                    //-------------Cek Jumlah Vocab-------------
                    $sql_jumtmpvocab = "SELECT COUNT(*) jum FROM tmpprobabilityvocab WHERE idvocab=" . $data['id'] . " AND ipclient='" . $ipclient . "'";
                    $tampil_jumtmpvocab = $this->db->query($sql_jumtmpvocab);
                    $data_jumtmpvocab = mysqli_fetch_array($tampil_jumtmpvocab);
                    $jumtmpvocab = $data_jumtmpvocab['jum'];
                    //-------------Exit Cek Jumlah Vocab--------

                    //-------------Cek Vocab-------------
                    $sql_tmpvocab = "SELECT * FROM tmpprobabilityvocab WHERE idvocab=" . $data['id'] . " AND ipclient='" . $ipclient . "'";
                    $tampil_tmpvocab = $this->db->query($sql_tmpvocab);
                    $data_tmpvocab = mysqli_fetch_array($tampil_tmpvocab);
                    //-------------Exit Cek Vocab--------

                    if ($jumtmpvocab == 0) {
                        $simpan = "INSERT INTO `tmpprobabilityvocab` (`idvocab`, `jumprobability`,`ipclient`) VALUES ('" . $data['id'] . "', '1','" . $ipclient . "')";
                        $this->db->query($simpan);
                    } else {
                        $jumprobability = $data_tmpvocab['jumprobability'] + 1;
                        $update = "UPDATE `tmpprobabilityvocab` SET `jumprobability`=" . $jumprobability . " WHERE (`idvocab`='" . $data['id'] . "') AND (`ipclient`='" . $ipclient . "')";
                        $this->db->query($update);
                    }
                }
            }
            //===========Exit Mencara Berdasarkan data berkata==============


            //===========Mencari Data Profile Peminta HelpDesk============
            $sql = "
				SELECT dept,lokasi,`server`,nama_user FROM komputer WHERE IP='" . $ipclient . "'
			";
            $tampil = $this->db->query($sql);
            while ($data = mysqli_fetch_array($tampil)) {
                $departement = $data['dept'];
                $kantor = $data['lokasi'];
                $server = $data['server'];
                $pengadu = $data['nama_user'];
            }
            //===========Exit Mencari Data Profile Peminta Helpdesk=======

            //===========Memberikan Nilai Bobot Kepada setiap Vocab=======
            $sql = "
			SELECT
				a.id,
				a.departement,
				a.kantor,
				a.`server`,
				a.pengadu,
				b.jumprobability
			FROM
				vocab AS a
				LEFT JOIN tmpprobabilityvocab AS b ON b.idvocab = a.id AND b.ipclient = '" . $ipclient . "'
			";
            $tampil = $this->db->query($sql);
            while ($data = mysqli_fetch_array($tampil)) {
                $bobotdepartement = '0,1';
                $bobotkantor = '0,2';
                $bobotserver = '0,3';
                $bobotpengadu = '0,5';

                $nilaidepartement = '0';
                $nilaikantor = '0';
                $nilaiserver = '0';
                $nilaipengadu = '0';

                if ($data['departement'] == $departement) {
                    $nilaidepartement = 1;
                }
                if ($data['kantor'] == $kantor) {
                    $nilaikantor = 1;
                }
                if ($data['server'] == $server) {
                    $nilaiserver = 1;
                }
                if ($data['pengadu'] == $pengadu) {
                    $nilaipengadu = 1;
                }

                $nilai = (($bobotdepartement * $nilaidepartement) + ($bobotkantor * $nilaikantor) + ($bobotserver * $nilaiserver) + ($bobotpengadu + $nilaipengadu) + $data['jumprobability']);
                $bobot = $bobotdepartement + $bobotkantor + $bobotserver + $bobotpengadu + $jumdata;

                $hasil = $nilai / $bobot;

                //-------------Cek Jumlah Vocab-------------
                $sql_jumtmpvocab = "SELECT COUNT(*) jum FROM tmpprobabilityvocab WHERE idvocab=" . $data['id'] . " AND ipclient='" . $ipclient . "'";
                $tampil_jumtmpvocab = $this->db->query($sql_jumtmpvocab);
                $data_jumtmpvocab = mysqli_fetch_array($tampil_jumtmpvocab);
                $jumtmpvocab = $data_jumtmpvocab['jum'];
                //-------------Exit Cek Jumlah Vocab--------
                if ($hasil == 0) {
                    $delete = "DELETE FROM `tmpprobabilityvocab` WHERE idvocab=" . $data['id'] . "";
                } else {
                    if ($jumtmpvocab == 0) {
                        $simpan = "INSERT INTO `tmpprobabilityvocab` (`idvocab`, `jumprobability`,`ipclient`) VALUES ('" . $data['id'] . "', '" . $hasil . "','" . $ipclient . "')";
                        $this->db->query($simpan);
                    } else {
                        $update = "UPDATE `tmpprobabilityvocab` SET `jumprobability`=" . $hasil . " WHERE (`idvocab`='" . $data['id'] . "') AND (`ipclient`='" . $ipclient . "')";
                        $this->db->query($update);
                    }
                }
            }
            //==========Exit Memberikan Nilai Bobot Kepada Setiap Vocab=====


            //===========Pemanggilan Data Yang sudah sesuai atau tidak==========
            $sql = "SELECT b.id, b.answer FROM tmpprobabilityvocab AS a INNER JOIN vocab AS b ON b.id = a.idvocab WHERE a.ipclient='" . $ipclient . "' ORDER BY a.jumprobability DESC";
            $tampil = $this->db->query($sql);
            $data = mysqli_fetch_array($tampil);
            if (trim($data['answer']) <> '') {
                //$arr=$data['answer'].'<br><br> Mohon Konfirmasi apakah informasi kami benar atau tidak? jika benar ketik `YA` jika salah ketik `TIDAK`, maka kami akan memberikan informasi lagi yang mungkin... ';
                $arr = $data['answer'] . '<br><br>Bagaimana, Bisa tidak? jika bisa ketik `YA` tapi jika tidak bisa ketikkan `TIDAK`, Terima Kasih';
                $data = array('idvocab' => $data['id']);
                $this->session->set_userdata($data);
            } else {
                $this->db->query("INSERT INTO `askpending` (`ask`, `status`,`tglask`,`ipclient`) VALUES ('" . $teks . "', '1', '" . date('Y-m-d H:i:s') . "','" . $ipclient . "')");
                $getID = $this->db->insert_id();
                //$arr = '<p>Maaf untuk sementara ini, pertanyaan yang anda ajukan akan kami diskusikan terlebih dahulu dan akan ditindak lanjuti melalui email apabila sudah ada solusinya.<br /> silahkan masukan email anda <input type="text" name="email'.$getID.'" id="email'.$getID.'">&nbsp;<a onclick="simpanemail('.$getID.')" href="#">Kirim</a></p>';	
                $arr = '<p>Aduh!! Maaf Sepertinya pertanyaan anda tidak ada di dalam databases kami, akan coba kami diskusikan dulu ya kepada team IT, akan kami informasikan kembali apabila sudah. terima kasih</p>
				';
            }
            //============Exit Pemanggilan Data yang sesuai atau tidak=========
        } else {
            $arr = 'Kamu mau nanya ap?';
        }
        echo $arr;

        $data = array('kataterakhir' => $teks);
        $this->session->set_userdata($data);
    }

    //--------------------------------------------------------------------

}
