<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("guru")) {
            $this->session->set_flashdata('pesan', 'Anda harus login');
            redirect('', 'refresh');
        }
        $this->load->model('Mguru');
    }

    public function index()
    {
        $data = ['title' => 'Mata Pelajaran'];
        $id_tahun = $this->session->userdata('id_tahun');
        $guru = $this->session->userdata('guru');
        $id_guru = $guru['id_guru'];
        $data['mapel'] = $this->Mguru->tampil_mapel_guru_tahun($id_guru, $id_tahun);

        $this->load->view('guru/header', $data);
        $this->load->view('guru/mapel', $data);
        $this->load->view('guru/footer');
    }
}
