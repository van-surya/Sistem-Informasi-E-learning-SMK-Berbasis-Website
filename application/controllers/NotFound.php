<?php

defined('BASEPATH') or exit('No direct script access allowed');

class NotFound extends CI_Controller
{

    public function index()
    {
        $data['title'] = '404';
        $this->load->view('404', $data);
    }
}
        
    /* End of file  NotFound.php */
