<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
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
        $data['title'] = 'Beranda';
        $data['jumlah_guru'] = $this->Mpetugas->hitung_guru();
        $data['jumlah_siswa'] = $this->Mpetugas->hitung_siswa();
        $data['jumlah_jurusan'] = $this->Mpetugas->hitung_jurusan();
        $data['jumlah_kelas'] = $this->Mpetugas->hitung_kelas();
        $this->load->view('petugas/header', $data);
        $this->load->view('petugas/beranda', $data);
        $this->load->view('petugas/footer');
    }
    public function terpilih()
    {
        $id_petugas = $this->input->post('id');
        $this->session->set_userdata("profile_terpilih", $id_petugas);
    }
    public function ubahprofil($id_petugas)
    {
        $inputan = $this->input->post();
        $detail = $this->Mpetugas->detail_petugas($id_petugas);

        if ($inputan['nip_petugas'] == $detail['nip_petugas']) {
            $this->form_validation->set_rules('nip_petugas', 'Nip Petugas', 'required|exact_length[18]');
        } else {
            $this->form_validation->set_rules('nip_petugas', 'Nip Petugas', 'required|exact_length[18]|is_unique[petugas.nip_petugas]');
        }

        if ($inputan['email_petugas'] == $detail['email_petugas']) {
            $this->form_validation->set_rules('email_petugas', 'Email Petugas', 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email_petugas', 'Email Petugas', 'required|valid_email|is_unique[petugas.email_petugas]');
        }
        if ($inputan['username'] == $detail['username']) {
            $this->form_validation->set_rules('username', 'Username', 'required');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[petugas.username]');
        }

        $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|alpha_numeric_spaces');
        if ($this->form_validation->run() == TRUE) {
            $this->Mpetugas->ubah_profil($inputan, $id_petugas);

            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('petugas/beranda', 'refresh');
        }
        $this->session->set_flashdata('errors_ubah', validation_errors());
        redirect('petugas/beranda', 'refresh');
    }
}
/* End of file Beranda.php */
/* Location: ./application/controllers/petugas/Beranda.php */
