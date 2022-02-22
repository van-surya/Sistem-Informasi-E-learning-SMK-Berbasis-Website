<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{

    public function index()
    {
        //menghapus session petugas login
        $this->session->unset_userdata("guru");
        $this->session->sess_destroy();
        redirect('', 'refresh');
    }
}
/* End of file logout.php */
/* Location: ./application/controllers/petugas/logout.php */