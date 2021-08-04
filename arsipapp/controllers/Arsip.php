<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip extends CI_Controller
{
    private $userData;

    public function __construct() {
        parent::__construct();

        $this->load->model("m_model");

        if (!$this->m_model->checkSession()) {
            redirect(base_url("login"));
        }

        $where = array(
            'id_user' => $this->session->userdata("id_user")
        );

        $responses = $this->m_model->getUser($where);

        if ($responses->num_rows() > 0) {
            $this->userData = $responses->result()[0];
        }
        else {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['page'] = 'home';
        $data['title'] = 'E-Arsip';
        $data['userData'] = $this->userData;

        $this->load->view('templates/head', $data);
        $this->load->view('templates/header');
        $this->load->view('arsip/indexpage');
        $this->load->view('templates/footer');
        $this->load->view('templates/foot');
    }

    public function arsipBaru()
    {
        $data['page'] = 'arsipbaru';
        $data['title'] = 'Arsip Baru';
        $data['userData'] = $this->userData;
        $data['sidemenu'] = array(
            array(
                'name' => 'Arsip Baru',
                'icon' => 'folder-plus',
                'url' => base_url("arsip/arsipbaru"),
                'active' => true
            ),
        );

        $this->load->view('templates/head', $data);
        $this->load->view('templates/container-open');
        $this->load->view('templates/sidemenu');
        $this->load->view('templates/header');
        $this->load->view('templates/wrapper-open');
        $this->load->view('templates/content-open');
        $this->load->view('arsip/arsipbaru');
        $this->load->view('templates/content-close');
        $this->load->view('templates/footer');
        $this->load->view('templates/wrapper-close');
        $this->load->view('templates/container-close');
        $this->load->view('templates/foot');
    }

    public function processArsipBaru()
    {
        $dariKepada   = $this->input->post("dari_kepada");
        $alamat       = $this->input->post("alamat");
        $kota         = $this->input->post("kota");
        $noSurat      = $this->input->post("no_surat");
        $tglSurat     = $this->input->post("tgl_surat");
        $indeks       = $this->input->post("indeks");
        $noUrut       = $this->input->post("no_urut");
        $perihal      = $this->input->post("perihal");
        $tglSimpan    = $this->input->post("tgl_simpan");
        $jenisSurat   = $this->input->post("jenis_surat");
        $kerahasiaan  = $this->input->post("kerahasiaan");
        $sistemSimpan = $this->input->post("sistem_simpan");
        $kodeSimpan   = $this->input->post("kode_simpan");
        $isiRingkasan = $this->input->post("isi_ringkasan");
        $catatan      = $this->input->post("catatan");
        $idUser       = $this->userData->id_user;

        $config = array(
            'upload_path'   => './uploads/lampiran/',
            'allowed_types' => 'doc|docx|pdf',
            'max_size'      => 0
        );

        // begin test
            // echo "<pre>";
            // echo $dariKepada.'<br/>';
            // echo $alamat.'<br/>';
            // echo $kota.'<br/>';
            // echo $noSurat.'<br/>';
            // echo $tglSurat.'<br/>';
            // echo $indeks.'<br/>';
            // echo $noUrut.'<br/>';
            // echo $perihal.'<br/>';
            // echo $tglSimpan.'<br/>';
            // echo $jenisSurat.'<br/>';
            // echo $kerahasiaan.'<br/>';
            // echo $sistemSimpan.'<br/>';
            // echo $kodeSimpan.'<br/>';
            // echo $isiRingkasan.'<br/>';
            // echo $catatan.'<br/>';
            // print_r($_FILES);
            // echo "</pre>";
        // end test

        $fail = false;
        $message = "";
        $files = array();

        $fileCount = count($_FILES['lampiran']['name']);
        if (strlen($_FILES['lampiran']['name'][0]) != 0) {
            $this->load->library('upload', $config);

            for ($i=0; $i < $fileCount; $i++) { 
                $_FILES['file']['name']     = $_FILES['lampiran']['name'][$i];
                $_FILES['file']['type']     = $_FILES['lampiran']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['lampiran']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['lampiran']['error'][$i];
                $_FILES['file']['size']     = $_FILES['lampiran']['size'][$i];

                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $config['file_name'] = str_replace(" ", "-", basename($_FILES['file']['name'], '.'.$ext)).date('-ymdHis');
                
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file'))
                {
                    $message = $this->upload->display_errors();
                    redirect(base_url("arsip/arsipbaru?status=-1&message=".$message));
                    $fail = true;
                    break;
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    array_push($files, $this->upload->data()['file_name']);
                }
            }
        }

        if (!$fail) {
            $insertData = array(
                'dari_kepada'   => $dariKepada,
                'alamat'        => $alamat,
                'kota'          => $kota,
                'no_surat'      => $noSurat,
                'tgl_surat'     => $tglSurat,
                'indeks'        => $indeks,
                'no_urut'       => $noUrut,
                'perihal'       => $perihal,
                'tgl_simpan'    => $tglSimpan,
                'jenis_surat'   => $jenisSurat,
                'kerahasiaan'   => $kerahasiaan,
                'sistem_simpan' => $sistemSimpan,
                'kode_simpan'   => $kodeSimpan,
                'isi_ringkasan' => $isiRingkasan,
                'catatan'       => $catatan,
                'id_user'       => $idUser
            );

            $idArsip = $this->m_model->addArsip($insertData);

            foreach ($files as $key => $value) {
                $insertData = array(
                    'nama_file' => $value,
                    'id_arsip' => $idArsip
                );

                $this->m_model->addLampiran($insertData);
            }

            redirect(base_url("arsip/manajemen/".$idArsip."?status=1"));
        }
    }

    public function manajemen($idArsip = null)
    {
        if ($idArsip === null) {
            redirect(base_url());
        }

        $data['page'] = 'manajemen';
        $data['title'] = 'Manajemen Arsip';
        $data['userData'] = $this->userData;
        $data['sidemenu'] = array(
            array(
                'name' => 'Manajemen Arsip',
                'icon' => 'folder',
                'url' => base_url("arsip/manajemen"),
                'active' => true
            ),
        );

        $where['id_arsip'] = $idArsip;

        $data['dataArsip'] = $this->m_model->getArsipData($where);
        if ($data['dataArsip']->num_rows() <= 0) {
            redirect(base_url());
        }
        else {
            $data['dataArsip'] = $data['dataArsip']->result()[0];
        }
        
        $data['dataLampiran'] = $this->m_model->getLampiranData($where);
        if ($data['dataLampiran']->num_rows() <= 0) {
            redirect(base_url());
        } else {
            $data['dataLampiran'] = $data['dataLampiran']->result();
        }

        $data['dipinjam'] = $this->m_model->arsipDipinjam($where);


        $this->load->view('templates/head', $data);
        $this->load->view('templates/container-open');
        $this->load->view('templates/sidemenu');
        $this->load->view('templates/header');
        $this->load->view('templates/wrapper-open');
        $this->load->view('templates/content-open');
        $this->load->view('arsip/manajemen');
        $this->load->view('templates/content-close');
        $this->load->view('templates/footer');
        $this->load->view('templates/wrapper-close');
        $this->load->view('templates/container-close');
        $this->load->view('templates/foot');
    }

    public function test()
    {
        $where['id_arsip'] = 2;
        $dipinjam = $this->m_model->arsipDipinjam($where);
        $pinjam = $this->m_model->getPinjamData($where, true)->result_array();
        $pinjamNum = array_map('current', $pinjam);
        $kembaliNum = $this->m_model->getKembaliData($where = null, $pinjam)->num_rows();

        echo '<pre>';
        print_r($pinjam);
        echo $dipinjam.'<br/>';
        print_r($pinjamNum);
        echo $kembaliNum.'<br/>';
        echo '</pre>';
    }

    public function processManajemen()
    {
        $idArsip      = $this->input->post("id_arsip");
        $dariKepada   = $this->input->post("dari_kepada");
        $alamat       = $this->input->post("alamat");
        $kota         = $this->input->post("kota");
        $noSurat      = $this->input->post("no_surat");
        $tglSurat     = $this->input->post("tgl_surat");
        $indeks       = $this->input->post("indeks");
        $noUrut       = $this->input->post("no_urut");
        $perihal      = $this->input->post("perihal");
        $tglSimpan    = $this->input->post("tgl_simpan");
        $jenisSurat   = $this->input->post("jenis_surat");
        $kerahasiaan  = $this->input->post("kerahasiaan");
        $sistemSimpan = $this->input->post("sistem_simpan");
        $kodeSimpan   = $this->input->post("kode_simpan");
        $isiRingkasan = $this->input->post("isi_ringkasan");
        $catatan      = $this->input->post("catatan");
        $removeFile   = $this->input->post("remove_file");
        $idUser       = $this->userData->id_user;

        $config = array(
            'upload_path'   => './uploads/lampiran/',
            'allowed_types' => 'doc|docx|pdf',
            'max_size'      => 0
        );

        // begin test
            // echo "<pre>";
            // echo $idArsip.'<br/>';
            // echo $dariKepada.'<br/>';
            // echo $alamat.'<br/>';
            // echo $kota.'<br/>';
            // echo $noSurat.'<br/>';
            // echo $tglSurat.'<br/>';
            // echo $indeks.'<br/>';
            // echo $noUrut.'<br/>';
            // echo $perihal.'<br/>';
            // echo $tglSimpan.'<br/>';
            // echo $jenisSurat.'<br/>';
            // echo $kerahasiaan.'<br/>';
            // echo $sistemSimpan.'<br/>';
            // echo $kodeSimpan.'<br/>';
            // echo $isiRingkasan.'<br/>';
            // echo $catatan.'<br/>';
            // print_r($_FILES);
            // print_r($removeFile);
            // echo "</pre>";
        // end test

        $fail = false;
        $message = "";
        $files = array();

        $fileCount = count($_FILES['lampiran']['name']);
        if (strlen($_FILES['lampiran']['name'][0]) != 0) {
            $this->load->library('upload', $config);

            for ($i=0; $i < $fileCount; $i++) { 
                $_FILES['file']['name']     = $_FILES['lampiran']['name'][$i];
                $_FILES['file']['type']     = $_FILES['lampiran']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['lampiran']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['lampiran']['error'][$i];
                $_FILES['file']['size']     = $_FILES['lampiran']['size'][$i];

                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $config['file_name'] = str_replace(" ", "-", basename($_FILES['file']['name'], '.'.$ext)).date('-ymdHis');
                
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file'))
                {
                    $message = $this->upload->display_errors();
                    redirect(base_url("arsip/manajemen/".$idArsip."?status=-1&message=".$message));
                    $fail = true;
                    break;
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    array_push($files, $this->upload->data()['file_name']);
                }
            }
        }

        if (!$fail) {
            $updateData = array(
                'dari_kepada'   => $dariKepada,
                'alamat'        => $alamat,
                'kota'          => $kota,
                'no_surat'      => $noSurat,
                'tgl_surat'     => $tglSurat,
                'indeks'        => $indeks,
                'no_urut'       => $noUrut,
                'perihal'       => $perihal,
                'tgl_simpan'    => $tglSimpan,
                'jenis_surat'   => $jenisSurat,
                'kerahasiaan'   => $kerahasiaan,
                'sistem_simpan' => $sistemSimpan,
                'kode_simpan'   => $kodeSimpan,
                'isi_ringkasan' => $isiRingkasan,
                'catatan'       => $catatan,
                'id_user'       => $idUser
            );

            $affRows = $this->m_model->updateArsip($updateData, $idArsip); ///

            if ($affRows < 0) {
                redirect(base_url("arsip/manajemen/".$idArsip."?status=-1&message='Update arsip gagal'"));
            }
            foreach ($files as $key => $value) {
                $insertData = array(
                    'nama_file' => $value,
                    'id_arsip' => $idArsip
                );

                $this->m_model->addLampiran($insertData);
            }

            foreach ($removeFile as $key => $value) {
                $where = array(
                    'id_lampiran' => $key
                );

                $affRows = $this->m_model->deleteLampiran($where);
                if ($affRows < 0) {
                    redirect(base_url("arsip/manajemen/".$idArsip."?status=-1&message='Update lampiran arsip gagal'"));
                }
            }

            redirect(base_url("arsip/manajemen/".$idArsip."?status=1"));
        }
    }

    public function buatIndeks($id = null)
    {
        if ($id === null) {
            redirect(base_url());
        }

        $where['id_arsip'] = $id;
        $data['dataArsip'] = $this->m_model->getArsipData($where);
        if ($data['dataArsip']->num_rows() > 0) {
            $data['dataArsip'] = $data['dataArsip']->result()[0];
        }
        else {
            redirect(base_url());
        }

        $this->load->library('Pdf');
        $this->load->view("arsip/kartuindeks", $data);
        // $this->load->view("test2", $data);
    }

    public function buatDisposisi($id = null)
    {
        if ($id === null) {
            redirect(base_url());
        }

        $where['id_arsip'] = $id;
        $data['dataArsip'] = $this->m_model->getArsipData($where);
        if ($data['dataArsip']->num_rows() > 0) {
            $data['dataArsip'] = $data['dataArsip']->result()[0];
        }
        else {
            redirect(base_url());
        }

        $data['page'] = 'buatdisposisi';
        $data['title'] = 'Buat Kartu Disposisi';
        $data['userData'] = $this->userData;
        $data['sidemenu'] = array(
            array(
                'name' => 'Manajemen Arsip',
                'icon' => 'folder',
                'url' => base_url("arsip/manajemen/$id"),
                'active' => false
            ),
        );

        $this->load->view('templates/head', $data);
        $this->load->view('templates/container-open');
        $this->load->view('templates/sidemenu');
        $this->load->view('templates/header');
        $this->load->view('templates/wrapper-open');
        $this->load->view('templates/content-open');
        $this->load->view('arsip/buatdisposisi');
        $this->load->view('templates/content-close');
        $this->load->view('templates/footer');
        $this->load->view('templates/wrapper-close');
        $this->load->view('templates/container-close');
        $this->load->view('templates/foot');
    }

    public function cetakDisposisi()
    {
        $data['idArsip']         = $this->input->post("id_arsip");
        $data['indeks']          = $this->input->post("indeks");
        $data['kodeSimpan']      = $this->input->post("kode_simpan");
        $data['tglSurat']        = $this->input->post("tgl_surat");
        $data['noSurat']         = $this->input->post("no_surat");
        $data['dariKepada']      = $this->input->post("dari_kepada");
        $data['isiRingkasan']    = $this->input->post("isi_ringkasan");
        $data['tglSimpan']       = $this->input->post("tgl_simpan");
        $data['tglPenyelesaian'] = $this->input->post("tgl_penyelesaian");
        $data['isiDisposisi']    = $this->input->post("isi_disposisi");
        $data['kepada']          = $this->input->post("kepada");
        $data['dikembalikanKe']  = $this->input->post("dikembalikan_ke");

        if ($data['idArsip'] === null) {
            redirect(base_url());
        }

        $this->load->library('Pdf');
        $this->load->view("arsip/cetakdisposisi", $data);

        //begin test
            // echo '<pre>';
            // echo $indeks.'<br/>';
            // echo $kodeSimpan.'<br/>';
            // echo $tglSurat.'<br/>';
            // echo $noSurat.'<br/>';
            // echo $dariKepada.'<br/>';
            // echo $isiRingkasan.'<br/>';
            // echo $tglSimpan.'<br/>';
            // echo $tglPenyelesaian.'<br/>';
            // echo $isiDisposisi.'<br/>';
            // print_r($kepada);
            // echo $dikembalikanKe.'<br/>';
            // echo '</pre>';
        //end test
    }

    public function pinjamArsip($id)
    {
        if ($id === null) {
            redirect(base_url());
        }

        $where['id_arsip'] = $id;
        $data['dataArsip'] = $this->m_model->getArsipData($where);
        if ($data['dataArsip']->num_rows() > 0) {
            $data['dataArsip'] = $data['dataArsip']->result()[0];
        }
        else {
            redirect(base_url());
        }

        $data['page'] = 'pinjamarsip';
        $data['title'] = 'Pinjam Arsip';
        $data['userData'] = $this->userData;
        $data['sidemenu'] = array(
            array(
                'name' => 'Manajemen Arsip',
                'icon' => 'folder',
                'url' => base_url("arsip/manajemen/$id"),
                'active' => false
            ),
        );

        $this->load->view('templates/head', $data);
        $this->load->view('templates/container-open');
        $this->load->view('templates/sidemenu');
        $this->load->view('templates/header');
        $this->load->view('templates/wrapper-open');
        $this->load->view('templates/content-open');
        $this->load->view('arsip/pinjamarsip');
        $this->load->view('templates/content-close');
        $this->load->view('templates/footer');
        $this->load->view('templates/wrapper-close');
        $this->load->view('templates/container-close');
        $this->load->view('templates/foot');
    }

    public function processPinjam()
    {
        $idArsip       = $this->input->post("id_arsip");
        $namaPeminjam  = $this->input->post("nama_peminjam");
        $tglPinjam     = $this->input->post("tgl_pinjam");
        $batasWaktu    = $this->input->post("batas_waktu");
        $kondisiPinjam = $this->input->post("kondisi_pinjam");

        //begin test
            // echo '<pre>';
            // echo $idArsip.'<br/>';
            // echo $namaPeminjam.'<br/>';
            // echo $tglPinjam.'<br/>';
            // echo $batasWaktu.'<br/>';
            // echo $kondisiPinjam.'<br/>';
            // echo '</pre>';
        //end test

        $insertData = array(
            'id_arsip'       => $idArsip,
            'nama_peminjam'  => $namaPeminjam,
            'tgl_pinjam'     => $tglPinjam,
            'batas_waktu'    => $batasWaktu,
            'kondisi_pinjam' => $kondisiPinjam
        );

        $affRows = $this->m_model->addPinjam($insertData);
        if ($affRows <= 0) {
            redirect(base_url("arsip/manajemen/$idArsip?status=-1&message='Proses pinjam arsip gagal!'"));
        }
        else {
            redirect(base_url("arsip/manajemen/$idArsip?status=1"));
        }
    }

    public function cetakPinjam($id)
    {
        if ($id === null) {
            redirect(base_url());
        }

        $where['id_arsip'] = $id;
        $data['dataArsip'] = $this->m_model->getArsipData($where);
        if ($data['dataArsip']->num_rows() > 0) {
            $data['dataArsip'] = $data['dataArsip']->result()[0];
        }
        else {
            redirect(base_url());
        }

        $data['dataPinjam'] = $this->m_model->getPinjam($where);
        if ($data['dataPinjam']->num_rows() > 0) {
            $data['dataPinjam'] = $data['dataPinjam']->result()[0];
        }
        else {
            redirect(base_url());
        }

        $this->load->library('Pdf');
        $this->load->view("arsip/kartupinjam", $data);
    }

    public function pengembalian($id = null)
    {
        if ($id === null) {
            redirect(base_url());
        }

        $where['id_arsip'] = $id;
        $data['dataArsip'] = $this->m_model->getArsipData($where);
        if ($data['dataArsip']->num_rows() > 0) {
            $data['dataArsip'] = $data['dataArsip']->result()[0];
        }
        else {
            redirect(base_url());
        }

        $data['dataPinjam'] = $this->m_model->getPinjam($where);
        if ($data['dataPinjam']->num_rows() > 0) {
            $data['dataPinjam'] = $data['dataPinjam']->result()[0];
        }
        else {
            redirect(base_url());
        }

        $data['page'] = 'pengembalian';
        $data['title'] = 'Pengembalian Arsip';
        $data['userData'] = $this->userData;
        $data['sidemenu'] = array(
            array(
                'name' => 'Manajemen Arsip',
                'icon' => 'folder',
                'url' => base_url("arsip/manajemen/$id"),
                'active' => false
            ),
        );

        $where = array(
            'id_user' => $data['dataArsip']->id_user
        );
        $data['petugas'] = $this->m_model->getUser($where);
        if ($data['petugas']->num_rows() > 0) {
            $data['petugas'] = $data['petugas']->result()[0]->nama;
        }
        else {
            $data['petugas'] = '';
        }

        $this->load->view('templates/head', $data);
        $this->load->view('templates/container-open');
        $this->load->view('templates/sidemenu');
        $this->load->view('templates/header');
        $this->load->view('templates/wrapper-open');
        $this->load->view('templates/content-open');
        $this->load->view('arsip/pengembalian');
        $this->load->view('templates/content-close');
        $this->load->view('templates/footer');
        $this->load->view('templates/wrapper-close');
        $this->load->view('templates/container-close');
        $this->load->view('templates/foot');
    }

    public function processKembali()
    {
        $idArsip         = $this->input->post("id_arsip");   
        $idPinjam        = $this->input->post("id_pinjam");
        $tgl_kembali     = $this->input->post("tgl_kembali");
        $kondisi_kembali = $this->input->post("kondisi_kembali");
        
        $insertData = array(
            'id_pinjam'       => $idPinjam,
            'tgl_kembali'     => $tgl_kembali,
            'kondisi_kembali' => $kondisi_kembali,
        );

        $affRows = $this->m_model->addKembali($insertData);
        if ($affRows <= 0) {
            redirect(base_url("arsip/manajemen/$idArsip?status=-1&message='Proses pinjam arsip gagal!'"));
        }
        else {
            redirect(base_url("arsip/manajemen/$idArsip?status=1"));
        }
    }

    public function rekapMasuk()
    {
        $where['jenis_surat'] = 'M';
        $data['dataArsip'] = $this->m_model->getArsipData($where)->result();
        
        $this->load->library('Pdf');
        $this->load->view('arsip/rekapmasuk', $data);
    }

    public function rekapKeluar()
    {
        $where['jenis_surat'] = 'K';
        $data['dataArsip'] = $this->m_model->getArsipData($where)->result();
        
        $this->load->library('Pdf');
        $this->load->view('arsip/rekapkeluar', $data);
    }

    public function pencarian()
    {
        $data['page'] = 'pencarian';
        $data['title'] = 'Pencarian';
        $data['userData'] = $this->userData;
        $data['sidemenu'] = array(
            array(
                'name' => 'Pencarian',
                'icon' => 'search',
                'url' => base_url("arsip/pencarian"),
                'active' => true
            ),
        );

        $this->load->view('templates/head', $data);
        $this->load->view('templates/container-open');
        $this->load->view('templates/sidemenu');
        $this->load->view('templates/header');
        $this->load->view('templates/wrapper-open');
        $this->load->view('templates/content-open');
        $this->load->view('arsip/pencarian');
        $this->load->view('templates/content-close');
        $this->load->view('templates/footer');
        $this->load->view('templates/wrapper-close');
        $this->load->view('templates/container-close');
        $this->load->view('templates/foot');
    }

    public function processCari()
    {
        $dariKepada = $this->input->post("dari_kepada");
        $jenisSurat = $this->input->post("jenis_surat");
        $noSurat    = $this->input->post("no_surat");
        $alamat     = $this->input->post("alamat");
        $kodeSimpan = $this->input->post("kode_simpan");
        $perihal    = $this->input->post("perihal");
        $tglSurat   = $this->input->post("tgl_surat");

        $where = array();

        if ($dariKepada !== null && strlen($dariKepada) != 0) {
            $where['dari_kepada'] = $dariKepada;
        }

        if ($jenisSurat !== null && strlen($jenisSurat) != 0) {
            $where['jenis_surat'] = $jenisSurat;
        }

        if ($noSurat !== null && strlen($noSurat) != 0) {
            $where['no_surat'] = $noSurat;
        }

        if ($alamat !== null && strlen($alamat) != 0) {
            $where['alamat'] = $alamat;
        }

        if ($kodeSimpan !== null && strlen($kodeSimpan) != 0) {
            $where['kode_simpan'] = $kodeSimpan;
        }

        if ($perihal !== null && strlen($perihal) != 0) {
            $where['perihal'] = $perihal;
        }

        if ($tglSurat !== null && strlen($tglSurat) != 0) {
            $where['tgl_surat'] = $tglSurat;
        }

        $this->bukuAgenda($where);
    }

    public function bukuAgenda($where = null)
    {
        $data['page'] = 'bukuagenda';
        $data['title'] = 'Buku Agenda';
        $data['userData'] = $this->userData;
        $data['sidemenu'] = array(
            array(
                'name' => 'Buku Agenda',
                'icon' => 'folder-open',
                'url' => base_url("arsip/bukuagenda"),
                'active' => true
            ),
        );

        if ($where === null || count($where) <= 0) {
            $data['dataArsip'] = $this->m_model->getArsipData()->result();
        }
        else {
            $data['dataArsip'] = $this->m_model->getArsipData($where)->result();
        }

        $this->load->view('templates/head', $data);
        $this->load->view('templates/container-open');
        $this->load->view('templates/sidemenu');
        $this->load->view('templates/header');
        $this->load->view('templates/wrapper-open');
        $this->load->view('templates/content-open');
        $this->load->view('arsip/bukuagenda');
        $this->load->view('templates/content-close');
        $this->load->view('templates/footer');
        $this->load->view('templates/wrapper-close');
        $this->load->view('templates/container-close');
        $this->load->view('templates/foot');
    }

    public function rekapBuku()
    {
     
        $data['dataArsip'] = $this->m_model->getArsipData()->result();
        
        $this->load->library('Pdf');
        $this->load->view('arsip/rekapbuku', $data);
    }

    public function rekapPinjam()
    {
        $data['dataPinjam'] = $this->m_model->getVPinjam()->result();
        
        $this->load->library('Pdf');
        // $this->load->view('arsip/rekapbuku', $data);
        $this->load->view('arsip/rekappinjam', $data);
    }

    public function userSettings()
    {
        $data['page'] = 'usersettings';
        $data['title'] = 'Pengaturan Akun';
        $data['userData'] = $this->userData;
        $data['sidemenu'] = array(
            array(
                'name' => 'Pengaturan',
                'icon' => 'cog',
                'url' => base_url("arsip/usersettings"),
                'active' => true
            ),
        );

        $this->load->view('templates/head', $data);
        $this->load->view('templates/container-open');
        $this->load->view('templates/sidemenu');
        $this->load->view('templates/header');
        $this->load->view('templates/wrapper-open');
        $this->load->view('templates/content-open');
        $this->load->view('arsip/usersettings');
        $this->load->view('templates/content-close');
        $this->load->view('templates/footer');
        $this->load->view('templates/wrapper-close');
        $this->load->view('templates/container-close');
        $this->load->view('templates/foot');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url("login"));
    }
}
