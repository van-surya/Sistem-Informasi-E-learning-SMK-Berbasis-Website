<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mpetugas');
		$this->load->model('Mguru');
		$this->load->model('Msiswa');
	}
 
	public function index()
	{
		//mendapatkan inputan dr form formulir login
		$inputan = $this->input->post();

		if ($inputan) {
			$hasilp = $this->Mpetugas->login_petugas($inputan);
			if ($hasilp == "sukses") {
				$this->session->set_flashdata('pesan', 'Selamat Datang Di E-learning SMK Piri 1 Yogyakarta');
				redirect('petugas/beranda', 'refresh');
			} else {
				$hasilg = $this->Mguru->login_guru($inputan);
				if ($hasilg == "sukses") {
					$this->session->set_flashdata('pesan', 'Selamat Datang Di E-learning SMK Piri 1 Yogyakarta');
					redirect('guru/beranda', 'refresh');
				} else {
					$hasils = $this->Msiswa->login_siswa($inputan);
					if ($hasils == "sukses") {
						$this->session->set_flashdata('pesan', 'Selamat Datang Di E-learning SMK Piri 1 Yogyakarta');
						redirect('siswa/beranda', 'refresh');
					} else {
						$this->session->set_flashdata('pesan', 'Login Gagal, Cek Username dan Password Anda');
						redirect('', 'refresh');
					}
				}
			}
		}

		$this->load->view('Login');
	}
}
