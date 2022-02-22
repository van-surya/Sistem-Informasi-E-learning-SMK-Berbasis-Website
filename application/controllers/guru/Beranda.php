<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
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
        $data = ['title' => 'Beranda'];
        $data['notifikasi'] = $this->Mguru->tampil_notifikasi_jawaban();
        $this->load->view('guru/header', $data);
        $this->load->view('guru/beranda', $data);
        $this->load->view('guru/footer');
    }
    public function terpilih()
    {
        $id_guru = $this->input->post('id');
        $this->session->set_userdata("profile_terpilih", $id_guru);
    }
    public function ubahprofil($id_guru)
    {
        $inputan = $this->input->post();
        $detail = $this->Mguru->detail_guru($id_guru);

        if ($inputan['nip_guru'] == $detail['nip_guru']) {
            $this->form_validation->set_rules('nip_guru', 'Nip', 'required|min_length[16]|max_length[18]');
        } else {
            $this->form_validation->set_rules('nip_guru', 'Nip', 'required|min_length[16]|max_length[18]|is_unique[guru.nip_guru]');
        }
        if ($inputan['email_guru'] == $detail['email_guru']) {
            $this->form_validation->set_rules('email_guru', 'Email', 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email_guru', 'Email', 'required|valid_email|is_unique[guru.email_guru]');
        }

        $this->form_validation->set_rules('nama_guru', 'Nama', 'required|alpha_numeric_spaces');
        if ($this->form_validation->run() == TRUE) {
            $this->Mguru->ubah_profil($inputan, $id_guru);

            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('guru/beranda', 'refresh');
        }
        $this->session->set_flashdata('errors_ubah', validation_errors());
        redirect('guru/beranda', 'refresh');
    }
}
