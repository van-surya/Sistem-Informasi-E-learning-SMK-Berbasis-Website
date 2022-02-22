<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tahunajaran extends CI_Controller
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

    public function settahun()
    {
        if ($this->input->post('id_tahun')) {

            $id_tahun = $this->input->post('id_tahun');
            $balik = $this->input->post('balik');

            $this->session->set_userdata('id_tahun', $id_tahun);
            redirect($balik, 'refresh');
        }
    }
}
/* End of file Tahunajaran.php */
/* Location: ./application/controllers/petugas/Tahunajaran.php */