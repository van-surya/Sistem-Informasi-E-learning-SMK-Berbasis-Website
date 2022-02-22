<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Forumdiskusi extends CI_Controller
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

    public function index($id_mengajar)
    {
        $inputan = $this->input->post();
        if ($inputan) {

            $this->Msiswa->kirim_pesan_diskusi($id_mengajar, $inputan);
            $this->session->set_flashdata('pesan', 'Pesan berhasil terkirim!');
            redirect("siswa/forumdiskusi/index/$id_mengajar");
        }
        $data['title'] = 'Forum Diskusi';
        $data['detail'] = $this->Msiswa->detail_mengajar($id_mengajar);
        // ambil daftar chat per id_mengajar
        $data['diskusi'] = $this->Msiswa->tampil_diskusi($id_mengajar);
        $this->load->view('siswa/header', $data);
        $this->load->view('forumdiskusi', $data);
        $this->load->view('siswa/footer');
    }
}
