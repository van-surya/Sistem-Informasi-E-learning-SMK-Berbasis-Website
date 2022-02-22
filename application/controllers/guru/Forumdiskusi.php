<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Forumdiskusi extends CI_Controller
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

    public function index($id_mengajar)
    {
        $inputan = $this->input->post();
        if ($inputan) {
            // print_r($inputan); die;
            $this->Mguru->kirim_pesan_diskusi($id_mengajar, $inputan);
            $this->session->set_flashdata('pesan', 'Pesan berhasil terkirim!');
            redirect("guru/forumdiskusi/index/$id_mengajar");
        }
        $data['title'] = 'Forum Diskusi';
        $data['detail'] = $this->Mguru->detail_mengajar($id_mengajar);
        // ambil daftar chat per id_mengajar
        $data['diskusi'] = $this->Mguru->tampil_diskusi($id_mengajar);
        $this->load->view('guru/header', $data);
        $this->load->view('forumdiskusi', $data);
        $this->load->view('guru/footer');
    }
}
