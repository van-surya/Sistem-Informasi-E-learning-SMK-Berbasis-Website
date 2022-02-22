<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas extends CI_Controller
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

    public function detail($id_topik, $id_tugas)
    {
        // ambil detail tugas
        $data['detail'] = $this->Msiswa->detail_tugas($id_tugas);
        $data['jawaban'] = $this->Msiswa->tampil_jawaban($id_tugas);
        // ambil data jawaban per tugas
        $data['title'] = $data['detail']['judul_tugas'];
        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/tugas', $data);
        $this->load->view('siswa/footer');
    }

    public function kirim($id_topik)
    {
        $inputan = $this->input->post();

        if ($inputan) {

            $this->Msiswa->simpan_jawaban($inputan);
            $this->session->set_flashdata('pesan', 'Jawaban berhasil dikirim!');
            $this->session->set_userdata('tampilaksi', 'Jawaban anda sudah terkumpul');
            redirect('siswa/tugas/detail/' . $id_topik . '/' . $inputan['id_tugas']);
        } else {
            redirect('siswa/tugas/detail/' . $id_topik . '/' . $inputan['id_tugas']);
        }
    }

    public function hapus_jawaban()
    {
        $idnya = $this->input->post("id");
        $this->Msiswa->hapus_jawaban($idnya);
    }

    public function ubah($id_topik, $id_jawaban)
    {
        $inputan = $this->input->post();
        if ($inputan) {
            $this->Msiswa->ubah_jawaban($inputan, $id_jawaban);
            $this->session->set_flashdata('pesan', 'Jawaban berhasil diubah!');
            redirect('siswa/tugas/detail/' . $id_topik . '/' . $inputan['id_tugas']);
        }
        $this->session->set_flashdata('pesan', 'Jawaban gagal diubah !');
        redirect('siswa/tugas/detail/' . $id_topik . '/' . $inputan['id_tugas']);
    }
}

/* End of file Tugas.php */
/* Location: ./application/controllers/siswa/Tugas.php */