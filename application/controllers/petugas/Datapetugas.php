<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Datapetugas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Mpetugas');
        if (!$this->session->userdata("petugas")) {
            $this->session->set_flashdata('pesan', 'Anda harus login');
            redirect('', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Petugas';
        $data['petugas'] = $this->Mpetugas->tampil_petugas();
        $this->load->view('petugas/header', $data);
        $this->load->view('petugas/datapetugas', $data);
        $this->load->view('petugas/footer');
    }

    public function tambah()
    {

        $inputan = $this->input->post();
        // //buat rule
        $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('nip_petugas', 'Nip Petugas', 'required|numeric|min_length[16]|max_length[18]|is_unique[petugas.nip_petugas]');
        $this->form_validation->set_rules('username', 'Username Petugas', 'required|is_unique[petugas.username]');
        $this->form_validation->set_rules('email_petugas', 'Email Petugas', 'required|valid_email|is_unique[petugas.email_petugas]');
        $this->form_validation->set_rules('password_petugas', 'Password', 'required');
        if ($this->form_validation->run() == TRUE) {
            $this->Mpetugas->simpan_petugas($inputan);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('petugas/datapetugas', 'refresh');
        }
        $this->session->set_flashdata('errors', validation_errors());
        redirect('petugas/datapetugas', 'refresh');
    }

    public function hapus_petugas()
    {
        $idnya = $this->input->post("id");
        $this->Mpetugas->hapus_petugas($idnya);
    }

    public function terpilih()
    {
        $id_petugas = $this->input->post('id');
        $this->session->set_userdata("petugas_terpilih", $id_petugas);
    }

    public function ubah($id_petugas)
    {
        $inputan = $this->input->post();
        $detail = $this->Mpetugas->detail_petugas($id_petugas);

        if ($inputan['nip_petugas'] == $detail['nip_petugas']) {
            $this->form_validation->set_rules('nip_petugas', 'Nip Petugas', 'required|min_length[16]|max_length[18]');
        } else {
            $this->form_validation->set_rules('nip_petugas', 'Nip Petugas', 'required|min_length[16]|max_length[18]|is_unique[petugas.nip_petugas]');
        }

        if ($inputan['email_petugas'] == $detail['email_petugas']) {
            $this->form_validation->set_rules('email_petugas', 'Email Petugas', 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email_petugas', 'Email Petugas', 'required|valid_email|is_unique[petugas.email_petugas]');
        }
        if ($inputan['username'] == $detail['username']) {
            $this->form_validation->set_rules('username', 'Username Petugas', 'required');
        } else {
            $this->form_validation->set_rules('username', 'Username Petugas', 'required|is_unique[petugas.username]');
        }
        $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|alpha_numeric_spaces');
        if ($this->form_validation->run() == TRUE) {
            $this->Mpetugas->ubah_petugas($inputan, $id_petugas);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('petugas/datapetugas', 'refresh');
        }
        $this->session->set_flashdata('errors_ubah', validation_errors());
        redirect('petugas/datapetugas', 'refresh');
    }
}
/* End of file Datapetugas.php */
/* Location: ./application/controllers/petugas/Datapetugas.php */