<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dataguru extends CI_Controller
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
        $data['title'] = 'Data Guru';
        $data['guru'] = $this->Mpetugas->tampil_guru();
        $this->load->view('petugas/header', $data);
        $this->load->view('petugas/dataguru', $data);
        $this->load->view('petugas/footer');
    }

    public function tambah()
    {
        $inputan = $this->input->post();
        // //buat rule
        $this->form_validation->set_rules('nip_guru', 'Nip', 'required|numeric|min_length[16]|max_length[18]|is_unique[guru.nip_guru]');
        $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('email_guru', 'Email Guru', 'required|valid_email|is_unique[guru.email_guru]');
        $this->form_validation->set_rules('password_guru', 'Password', 'required');
        $this->form_validation->set_rules('jk_guru', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('agama_guru', 'Agama', 'required');
        //cek from validasi berjalan & hasil valid

        if ($this->form_validation->run() == TRUE) {
            $this->Mpetugas->simpan_guru($inputan);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('petugas/dataguru', 'refresh');
        }
        $this->session->set_flashdata('errors_tambah', validation_errors());
        redirect('petugas/dataguru', 'refresh');
    }

    public function hapus_guru()
    {
        $idnya = $this->input->post("id");
        $this->Mpetugas->hapus_guru($idnya);
    }

    public function terpilih()
    {
        $id_guru = $this->input->post('id');
        $this->session->set_userdata("guru_terpilih", $id_guru);
    }
    public function ubah($id_guru)
    {
        $inputan = $this->input->post();

        $detail = $this->Mpetugas->detail_guru($id_guru);
        // jika inputan nip guru dari form sama dengan data dia sebelumnya
        // maka is_unique tidak diberlakukan
        // jika sebaliknya, is_unique diberlakukan
        if ($inputan['nip_guru'] == $detail['nip_guru']) {
            $this->form_validation->set_rules('nip_guru', 'Nip', 'required|numeric|min_length[16]|max_length[18]');
        } else {
            $this->form_validation->set_rules('nip_guru', 'Nip', 'required|numeric|min_length[16]|max_length[18]|is_unique[guru.nip_guru]');
        }
        if ($inputan['email_guru'] == $detail['email_guru']) {
            $this->form_validation->set_rules('email_guru', 'Email Guru', 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email_guru', 'Email Guru', 'required|valid_email|is_unique[guru.email_guru]');
        }

        $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('jk_guru', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('agama_guru', 'Agama', 'required');
        //cek from validasi berjalan & hasil valid
        if ($this->form_validation->run() == TRUE) {
            $this->Mpetugas->ubah_guru($inputan, $id_guru);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('petugas/dataguru', 'refresh');
        }
        $this->session->set_flashdata('errors_ubah', validation_errors());
        redirect('petugas/dataguru', 'refresh');
    }
}
/* End of file Dataguru.php */
/* Location: ./application/controllers/petugas/Dataguru.php */