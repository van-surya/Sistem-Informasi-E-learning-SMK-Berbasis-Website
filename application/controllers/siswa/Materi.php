<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("siswa")) {
            $this->session->set_flashdata('pesan', 'Anda harus login');
            redirect('', 'refresh');
        }
        $this->load->model('Msiswa');
    }

    public function detail($id_topik, $id_materi)
    {
        // ambil detail materi
        $data['detail'] = $this->Msiswa->detail_materi($id_materi);
        // ambil data jawaban per materi
        $data['title'] = $data['detail']['judul_materi'];
        $this->load->view('siswa/header', $data);
        $this->load->view('siswa/materi', $data);
        $this->load->view('siswa/footer');
    }
}

/* End of file Materi.php */
/* Location: ./application/controllers/guru/Materi.php */