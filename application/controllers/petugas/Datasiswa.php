<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Datasiswa extends CI_Controller
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
        $data['title'] = 'Data Siswa';
        $data['siswa'] = $this->Mpetugas->tampil_siswa();
        $this->load->view('petugas/header', $data);
        $this->load->view('petugas/datasiswa', $data);
        $this->load->view('petugas/footer');
    }

    public function tambah()
    {
        $inputan = $this->input->post();
        $this->form_validation->set_rules('nis', 'Nis', 'required|exact_length[6]|is_unique[siswa.nis]');
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('email_siswa', 'Email Siswa', 'required|valid_email|is_unique[siswa.email_siswa]');
        $this->form_validation->set_rules('password_siswa', 'Password', 'required');
        $this->form_validation->set_rules('tgl_lahir_siswa', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jk_siswa', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('agama_siswa', 'Agama', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->Mpetugas->simpan_siswa($inputan);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('petugas/datasiswa', 'refresh');
        }
        $this->session->set_flashdata('errors_tambah', validation_errors());
        redirect('petugas/datasiswa', 'refresh');
    }


    public function hapus_siswa()
    {
        $idnya = $this->input->post("id");
        $this->Mpetugas->hapus_siswa($idnya);
    }

    public function terpilih()
    {
        $id_siswa = $this->input->post('id');
        $this->session->set_userdata("siswa_terpilih", $id_siswa);
    }

    public function ubah($id_siswa)
    {
        $inputan = $this->input->post();
        $detail = $this->Mpetugas->detail_siswa($id_siswa);

        if ($inputan['nis'] == $detail['nis']) {
            $this->form_validation->set_rules('nis', 'Nis', 'required|exact_length[6]');
        } else {
            $this->form_validation->set_rules('nis', 'Nis', 'required|exact_length[6]|is_unique[siswa.nis]');
        }

        if ($inputan['email_siswa'] == $detail['email_siswa']) {
            $this->form_validation->set_rules('email_siswa', 'Email', 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email_siswa', 'Email', 'required|valid_email|is_unique[siswa.email_siswa]');
        }

        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('tgl_lahir_siswa', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jk_siswa', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('agama_siswa', 'Agama', 'required');
        if ($this->form_validation->run() == TRUE) {
            $this->Mpetugas->ubah_siswa($inputan, $id_siswa);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('petugas/datasiswa', 'refresh');
        }
        $this->session->set_flashdata('errors_ubah', validation_errors());
        redirect('petugas/datasiswa', 'refresh');
    }
}
/* End of file Datasiswa.php */
/* Location: ./application/controllers/petugas/Datasiswa.php */