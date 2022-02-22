<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
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
        $data['title'] = 'Data Mata Pelajaran';
        $data['mapel'] = $this->Mpetugas->tampil_mapel();
        $this->load->view('petugas/header', $data);
        $this->load->view('petugas/mapel', $data);
        $this->load->view('petugas/footer');
    }

    public function tambah()
    {
        $inputan = $this->input->post();
        $this->form_validation->set_rules('kode_mapel', 'Kode Mata pelajaran', 'required|is_unique[mapel.kode_mapel]');
        $this->form_validation->set_rules('nama_mapel', 'Nama Mata pelajaran', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->Mpetugas->simpan_mapel($inputan);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('petugas/mapel', 'refresh');
        }
        $this->session->set_flashdata('errors', validation_errors());
        redirect('petugas/mapel', 'refresh');
    }


    public function hapus_mapel()
    {
        $idnya = $this->input->post("id");
        $this->Mpetugas->hapus_mapel($idnya);
    }

    public function terpilih()
    {
        $id_mapel = $this->input->post('id');
        $this->session->set_userdata("mapel_terpilih", $id_mapel);
    }

    public function ubah($id_mapel)
    {
        $inputan = $this->input->post();
        $detail = $this->Mpetugas->detail_mapel($id_mapel);

        if ($inputan['kode_mapel'] == $detail['kode_mapel']) {
            $this->form_validation->set_rules('kode_mapel', 'Kode Mata pelajaran', 'required');
        } else {
            $this->form_validation->set_rules('kode_mapel', 'Kode Mata pelajaran', 'required|is_unique[mapel.kode_mapel]');
        }
        $this->form_validation->set_rules('nama_mapel', 'Nama Mata pelajaran', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->Mpetugas->ubah_mapel($inputan, $id_mapel);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('petugas/mapel', 'refresh');
        }
        $this->session->set_flashdata('errors_ubah', validation_errors());
        redirect('petugas/mapel', 'refresh');
    }
}
/* End of file Mapel.php */
/* Location: ./application/controllers/petugas/Mapel.php */