<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
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
        $data['title'] = 'Data Jurusan';
        $data['jurusan'] = $this->Mpetugas->tampil_jurusan();
        $this->load->view('petugas/header', $data);
        $this->load->view('petugas/jurusan', $data);
        $this->load->view('petugas/footer');
    }

    public function tambah()
    {
        $inputan = $this->input->post();
        $this->form_validation->set_rules('kode_jurusan', 'Kode Jurusan', 'required|exact_length[4]|is_unique[jurusan.kode_jurusan]');
        $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required');
        $this->form_validation->set_rules('singkatan_jurusan', 'Singkatan', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->Mpetugas->simpan_jurusan($inputan);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('petugas/jurusan', 'refresh');
        }
        $this->session->set_flashdata('errors', validation_errors());
        redirect('petugas/jurusan', 'refresh');
    }

    public function hapus_jurusan()
    {
        $idnya = $this->input->post("id");
        $this->Mpetugas->hapus_jurusan($idnya);
    }

    public function terpilih()
    {
        $id_jurusan = $this->input->post('id');
        $this->session->set_userdata("jurusan_terpilih", $id_jurusan);
    }


    public function ubah($id_jurusan)
    {
        $inputan = $this->input->post();
        $detail = $this->Mpetugas->detail_jurusan($id_jurusan);

        if ($inputan['kode_jurusan'] == $detail['kode_jurusan']) {
            $this->form_validation->set_rules('kode_jurusan', 'Kode jurusan', 'required|exact_length[4]');
        } else {
            $this->form_validation->set_rules('kode_jurusan', 'Kode jurusan', 'required|exact_length[4]|is_unique[jurusan.kode_jurusan]');
        }
        $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required');
        $this->form_validation->set_rules('singkatan_jurusan', 'Singkatan', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->Mpetugas->ubah_jurusan($inputan, $id_jurusan);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('petugas/jurusan', 'refresh');
        }
        $this->session->set_flashdata('errors_ubah', validation_errors());
        redirect('petugas/jurusan', 'refresh');
    }
}
/* End of file Jurusan.php */
/* Location: ./application/controllers/petugas/Jurusan.php */