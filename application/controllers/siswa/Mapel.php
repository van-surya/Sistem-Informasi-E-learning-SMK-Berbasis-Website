<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
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
        $data = ['title' => 'Mata Pelajaran'];
        $siswa = $this->session->userdata('siswa');
        $id_siswa = $siswa['id_siswa'];
        $data['mapel'] = $this->Msiswa->tampil_mapel_siswa($id_siswa);

        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/mapel', $data);
        $this->load->view('siswa/footer');
    }
}
