<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi extends CI_Controller
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

	public function detail($id_topik, $id_materi)
	{
		$data['detail'] = $this->Mguru->tampil_materi($id_materi);
		$data['title'] = $data['detail']['judul_materi'];

		$this->load->view('guru/header', $data);
		$this->load->view('guru/materi', $data);
		$this->load->view('guru/footer');
	}

	public function tambah()
	{
		$inputan = $this->input->post();

		$this->form_validation->set_rules('judul_materi', 'Judul Materi', 'required|max_length[100]');
		$this->form_validation->set_rules('deskripsi_materi', 'Deskripsi Materi', 'required');
		// cek apakah form validasi berjalan, dan hasilnya valid? 
		if ($this->form_validation->run() == TRUE) {
			$this->Mguru->simpan_materi($inputan);
			$this->session->set_flashdata('pesan', 'Materi berhasil ditambah!');
			redirect('guru/topik/detail/' . $inputan['id_topik'], 'refresh');
		} else {
			$this->session->set_flashdata('errors_materi', validation_errors());
			redirect('guru/topik/detail/' . $inputan['id_topik'], 'refresh');
		}
	}
	public function hapus_materi()
	{
		$idnya = $this->input->post("id");
		$this->Mguru->hapus_materi($idnya);
	}

	public function ubah($id_topik, $id_materi)
	{
		$inputan = $this->input->post();
		$this->form_validation->set_rules('judul_materi', 'Judul Materi', 'required|max_length[100]');
		$this->form_validation->set_rules('deskripsi_materi', 'Deskripsi Materi', 'required');
		// cek apakah form validasi berjalan, dan hasilnya valid? 
		if ($this->form_validation->run() == TRUE) {

			$this->Mguru->ubah_materi($inputan, $id_materi);
			$this->session->set_flashdata('pesan', 'Materi berhasil diubah!');
			redirect('guru/topik/detail/' . $inputan['id_topik'], 'refresh');
		}
		$this->session->set_flashdata('errors_ubahmateri', validation_errors());
		redirect('guru/topik/detail/' . $inputan['id_topik'], 'refresh');
	}
}

/* End of file Materi.php */
/* Location: ./application/controllers/guru/Materi.php */