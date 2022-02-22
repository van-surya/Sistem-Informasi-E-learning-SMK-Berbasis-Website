<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
        $data['title'] = 'Data Kelas';
        $data['kelas'] = $this->Mpetugas->tampil_kelas();
        $data['jurusan'] = $this->Mpetugas->tampil_jurusan();
        $this->load->view('petugas/header', $data);
        $this->load->view('petugas/kelas', $data);
        $this->load->view('petugas/footer');
    }

    public function tambah()
    {
        $inputan = $this->input->post();
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required');
        $this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('rombel', 'Rombel', 'required|numeric|exact_length[1]');

        if ($this->form_validation->run() == TRUE) {
            $hasil = $this->Mpetugas->simpan_kelas($inputan);
            if ($hasil == 'sukses') {
                $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            } else {
                $this->session->set_flashdata('pesan_gagal', 'Data sudah ada');
            }
            redirect('petugas/kelas', 'refresh');
        }
        $this->session->set_flashdata('errors', validation_errors());
        redirect('petugas/kelas', 'refresh');
    }


    public function hapus_kelas()
    {
        $idnya = $this->input->post("id");
        $this->Mpetugas->hapus_kelas($idnya);
    }

    public function terpilih()
    {
        $id_kelas = $this->input->post('id');
        $this->session->set_userdata("kelas_terpilih", $id_kelas);
    }

    public function ubah($id_kelas)
    {
        $inputan = $this->input->post();
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required');
        $this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('rombel', 'Rombel', 'required');

        if ($this->form_validation->run() == TRUE) {
            $hasil = $this->Mpetugas->ubah_kelas($inputan, $id_kelas);
            if ($hasil == 'sukses') {
                $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
                redirect('petugas/kelas', 'refresh');
            } else {
                $this->session->set_flashdata('errors_ubah', 'Data sudah ada');
                redirect('petugas/kelas', 'refresh');
            }
        } else {
            $this->session->set_flashdata('errors_ubah', validation_errors());
            redirect('petugas/kelas', 'refresh');
        }
    }
}
/* End of file Kelas.php */
/* Location: ./application/controllers/petugas/Kelas.php */
