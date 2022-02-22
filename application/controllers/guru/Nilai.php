<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("guru")) {
            $this->session->set_flashdata('pesan', 'Anda harus login');
            redirect('', 'refresh');
        }
        $this->load->model('Mguru');
    }

    public function index()
    {
        $data = ['title' => 'Nilai'];
        $id_tahun = $this->session->userdata('id_tahun');
        $guru = $this->session->userdata('guru');
        $id_guru = $guru['id_guru'];
        $data['mapel'] = $this->Mguru->tampil_mapel_guru_tahun($id_guru, $id_tahun);

        $this->load->view('guru/header', $data);
        $this->load->view('guru/nilai', $data);
        $this->load->view('guru/footer');
    }
    public function detail($id_mengajar)
    {
        $data = ['title' => 'Detail Nilai'];
        $data['mengajar'] = $this->Mguru->detail_mengajar($id_mengajar);
        $data['tugas_siswa'] = $this->Mguru->tampil_nilai_tugas_siswa($id_mengajar);
        $data['tugas'] = $this->Mguru->tampil_tugas_mengajar($id_mengajar);

        //proses mengkirimkan data dari formulir ke fungsi
        $inputan = $this->input->post();
        if ($inputan) {
            $this->Mguru->simpan_nilai($id_mengajar, $data['mengajar']['id_perkelasan'], $inputan);
            redirect('guru/nilai/detail/' . $id_mengajar, 'refresh');
        }
        $this->load->view('guru/header', $data);
        $this->load->view('guru/detailnilai', $data);
        $this->load->view('guru/footer');
    }
}
