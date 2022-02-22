<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
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
    public function index()
    {
        $data = ['title' => 'Beranda'];
        $siswa = $this->session->userdata('siswa');
        $id_siswa = $siswa['id_siswa'];
        $data['notifikasi'] = $this->Msiswa->tampil_notifikasi_topik();
        $data['kelas'] = $this->Msiswa->detail_kelas($id_siswa);

        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/beranda', $data);
        $this->load->view('siswa/footer');
    }

    public function terpilih()
    {
        $id_siswa = $this->input->post('id');
        $this->session->set_userdata("profile_terpilih", $id_siswa);
    }

    public function ubahprofil($id_siswa)
    {
        $inputan = $this->input->post();
        $detail = $this->Msiswa->detail_siswa($id_siswa);

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

        $this->form_validation->set_rules('nama_siswa', 'Nama', 'required|alpha_numeric_spaces');
        if ($this->form_validation->run() == TRUE) {
            $this->Msiswa->ubah_profil($inputan, $id_siswa);

            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('siswa/beranda', 'refresh');
        }
        $this->session->set_flashdata('errors_ubah', validation_errors());
        redirect('siswa/beranda', 'refresh');
    }
}
