<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("siswa")) {
            $this->session->set_flashdata('pesan', 'Anda harus login');
            redirect('', 'refresh');
        }
        $this->load->model('Msiswa');
    }

    public function index()
    {
        $data = ['title' => 'Nilai'];
        $siswa = $this->session->userdata('siswa');
        $id_siswa = $siswa['id_siswa'];
        $data['mapel'] = $this->Msiswa->tampil_mapel_siswa($id_siswa);

        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/nilai', $data);
        $this->load->view('siswa/footer');
    }

    public function detail($id_mengajar)
    {
        $siswa = $this->session->userdata('siswa');
        $id_siswa = $siswa['id_siswa'];
        $data['title'] = 'Nilai';
        $data['mengajar'] = $this->Msiswa->detail_mengajar($id_mengajar);
        $data['nilai'] = $this->Msiswa->tampil_nilai($id_siswa, $id_mengajar);
        $data['rata_rata'] = $this->Msiswa->tampil_rata_rata_nilai($id_siswa, $id_mengajar, $this->session->userdata("id_tahun"));

        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/detailnilai', $data);
        $this->load->view('siswa/footer');
    }
}
