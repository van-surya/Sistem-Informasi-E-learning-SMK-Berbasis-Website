<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tahunajaran extends CI_Controller
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
        $data['title'] = 'Data Tahun Ajaran';
        $data['th_ajaran'] = $this->Mpetugas->tampil_tahunajaran();
        $this->load->view('petugas/header', $data);
        $this->load->view('petugas/tahunajaran', $data);
        $this->load->view('petugas/footer');
    }

    public function tambah()
    {
        $inputan = $this->input->post();
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required|is_unique[th_ajaran.tahun_ajaran]');
        $this->form_validation->set_rules('status_th_ajaran', 'Status', 'required');

        if ($this->form_validation->run() == TRUE) {
            $hasil =  $this->Mpetugas->simpan_tahunajaran($inputan);
            if ($hasil == "sukses") {
                $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            } else {
                $this->session->set_flashdata('pesan_gagal', 'Gagal, data sudah ada');
            }
            redirect('petugas/tahunajaran', 'refresh');
        }
        $this->session->set_flashdata('errors', validation_errors());
        redirect('petugas/tahunajaran', 'refresh');
    }


    public function hapus_tahunajaran()
    {
        $idnya = $this->input->post("id");
        $this->Mpetugas->hapus_tahunajaran($idnya);
    }

    public function terpilih()
    {
        $id_tahun = $this->input->post('id');
        $this->session->set_userdata("tahunajaran_terpilih", $id_tahun);
    }


    public function ubah($id_tahun)
    {
        $inputan = $this->input->post();
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');
        $this->form_validation->set_rules('status_th_ajaran', 'Status', 'required');

        if ($this->form_validation->run() == TRUE) {
            $hasil = $this->Mpetugas->ubah_tahunajaran($inputan, $id_tahun);
            if ($hasil == 'sukses') {
                $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
                redirect('petugas/tahunajaran', 'refresh');
            } else {
                $this->session->set_flashdata('errors_ubah', 'Data sudah ada');
                redirect('petugas/tahunajaran', 'refresh');
            }
        } else {
            $this->session->set_flashdata('errors_ubah', validation_errors());
            redirect('petugas/tahunajaran', 'refresh');
        }
    }

    public function settahun()
    {
        if ($this->input->post('id_tahun')) {

            $id_tahun = $this->input->post('id_tahun');
            $semester = $this->input->post('semester');
            $balik = $this->input->post('balik');

            $this->session->set_userdata('id_tahun', $id_tahun);
            $this->session->set_userdata('semester', $semester);
            redirect($balik, 'refresh');
        }
    }
}
/* End of file Tahunajaran.php */
/* Location: ./application/controllers/petugas/Tahunajaran.php */