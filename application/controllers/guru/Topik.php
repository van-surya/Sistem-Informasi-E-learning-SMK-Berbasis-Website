<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Topik extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("guru")) {
            $this->session->set_flashdata('pesan', 'Anda harus login');
            redirect('', 'refresh');
        }
        $this->load->model('Mguru');
    }
    public function index($id_mengajar, $halaman = 1)
    {
        $data = ['title' => 'Topik'];
        //pagination
        $batas = 4;
        $posisi = ($halaman - 1) * $batas;


        $data['halaman'] = $halaman;
        $data_jumlah = $this->Mguru->jumlah_topik_siswa($id_mengajar);
        $data['jumlah_halaman'] = ceil($data_jumlah['jumlah'] / $batas);

        $data['mengajar'] = $this->Mguru->detail_mengajar($id_mengajar);
        $data['topik'] = $this->Mguru->tampil_topik_mengajar($id_mengajar, $posisi, $batas);

        $this->load->view('guru/header', $data);
        $this->load->view('guru/topik', $data);
        $this->load->view('guru/footer');
    }

    public function tambah()
    {
        $inputan = $this->input->post();

        // buat aturan/rule validasi
        $this->form_validation->set_rules('judul_topik', 'Judul Topik', 'required|max_length[100]');
        $this->form_validation->set_rules('deskripsi_topik', 'Deskripsi Topik', 'required|max_length[300]');
        $this->form_validation->set_rules('topik_mulai', 'Diberikan', 'required');
        $this->form_validation->set_rules('topik_berakhir', 'Batas', 'required');

        // cek apakah form validasi berjalan, dan hasilnya valid? 
        if ($this->form_validation->run() == TRUE) {

            $this->Mguru->simpan_topik($inputan);
            $this->session->set_flashdata('pesan', 'Topik berhasil ditambah!');
            redirect('guru/topik/index/' . $inputan['id_mengajar'], 'refresh');
        } else {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('guru/topik/index/' . $inputan['id_mengajar'], 'refresh');
        }
    }

    public function detail($id_topik)
    {
        $data['topik'] = $this->Mguru->detail_topik($id_topik);
        $data['materi'] = $this->Mguru->detail_materi($id_topik);
        $data['tugas'] = $this->Mguru->detail_tugas($id_topik);
        $data['title'] = $data['topik']['judul_topik'];

        $this->load->view('guru/header', $data);
        $this->load->view('guru/detailtopik', $data);
        $this->load->view('guru/footer');
    }

    public function terpilih()
    {
        $id_topik = $this->input->post('id');
        $this->session->set_userdata("topik_terpilih", $id_topik);
    }

    public function hapus_topik()
    {
        $idnya = $this->input->post("id");
        $this->Mguru->hapus_topik($idnya);
    }

    public function ubah($id_mengajar, $id_topik)
    {
        $inputan = $this->input->post();

        $this->form_validation->set_rules('judul_topik', 'Judul Topik', 'required|max_length[100]');
        $this->form_validation->set_rules('deskripsi_topik', 'Deskripsi Topik', 'required|max_length[300]');
        $this->form_validation->set_rules('topik_mulai', 'Diberikan', 'required');
        $this->form_validation->set_rules('topik_berakhir', 'Batas', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->Mguru->ubah_topik($inputan, $id_topik);
            $this->session->set_flashdata('pesan', 'Topik berhasil diubah!');
            redirect('guru/topik/index/' . $id_mengajar);
        }
        $this->session->set_flashdata('errors_ubah', validation_errors());
        redirect('guru/topik/index/' . $id_mengajar);
    }
}
