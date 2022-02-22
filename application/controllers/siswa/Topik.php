<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Topik extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("siswa")) {
            $this->session->set_flashdata('pesan', 'Anda harus login');
            redirect('', 'refresh');
        }
        $this->load->model('Msiswa');
    }
    public function index($id_mengajar, $halaman = 1)
    {

        $data = ['title' => 'Topik'];
        $batas = 4;
        $posisi = ($halaman - 1) * $batas;


        $data['halaman'] = $halaman;
        $data_jumlah = $this->Msiswa->jumlah_topik_siswa($id_mengajar);
        $data['jumlah_halaman'] = ceil($data_jumlah['jumlah'] / $batas);

        $data['mengajar'] = $this->Msiswa->detail_mengajar($id_mengajar);
        $data['topik'] = $this->Msiswa->tampil_topik_siswa($id_mengajar, $posisi, $batas);

        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/topik', $data);
        $this->load->view('siswa/footer');
    }
    public function detail($id_topik)
    {

        $data['topik'] = $this->Msiswa->detail_topik($id_topik);
        $data['materi'] = $this->Msiswa->tampil_materi($id_topik);
        $data['tugas'] = $this->Msiswa->tampil_tugas($id_topik);
        $data['title'] = $data['topik']['judul_topik'];

        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/detailtopik', $data);
        $this->load->view('siswa/footer');
    }
}
