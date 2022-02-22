<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas extends CI_Controller
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

	public function detail($id_topik, $id_tugas)
	{
		// ambil detail tugas

		$data['detail'] = $this->Mguru->tampil_tugas($id_tugas);
		// ambil data jawaban per tugas
		$data['siswa'] = $this->Mguru->tampil_tugas_siswa($id_topik);

		$data['jawaban'] = $this->Mguru->tampil_jawaban($id_tugas);
		$data['title'] = $data['detail']['judul_tugas'];
		$this->load->view('guru/header', $data);
		$this->load->view('guru/tugas', $data);
		$this->load->view('guru/footer');
	}

	public function tambah()
	{
		$inputan = $this->input->post();

		$this->form_validation->set_rules('judul_tugas', 'Judul Tugas', 'required|max_length[100]');
		$this->form_validation->set_rules('deskripsi_tugas', 'Deskripsi Tugas', 'required');
		// cek apakah form validasi berjalan, dan hasilnya valid? 
		if ($this->form_validation->run() == TRUE) {
			$this->Mguru->simpan_tugas($inputan);
			$this->session->set_flashdata('pesan', 'Tugas berhasil ditambah!');
			redirect('guru/topik/detail/' . $inputan['id_topik'], 'refresh');
		} else {
			$this->session->set_flashdata('errors_tugas', validation_errors());
			redirect('guru/topik/detail/' . $inputan['id_topik'], 'refresh');
		}
	}

	public function input_nilai()
	{
		$inputan = $this->input->post();
		$id_topik = $inputan['id_topik'];
		$id_tugas = $inputan['id_tugas'];
		$id_siswa = $inputan['id_siswa'];
		$this->Mguru->input_nilai_jawaban_tugas($inputan,);
		$this->session->set_flashdata('pesan', 'Nilai berhasil di inputkan.');
		redirect("guru/tugas/detail/$id_topik/$id_tugas");
	}

	public function hapus_tugas()
	{
		$idnya = $this->input->post("id");
		$this->Mguru->hapus_tugas($idnya);
	}
	public function ubah($id_topik, $id_tugas)
	{
		$inputan = $this->input->post();

		$this->form_validation->set_rules('judul_tugas', 'Judul Tugas', 'required|max_length[100]');
		$this->form_validation->set_rules('deskripsi_tugas', 'Deskripsi Tugas', 'required');

		if ($this->form_validation->run() == TRUE) {
			$this->Mguru->ubah_tugas($inputan, $id_tugas);
			$this->session->set_flashdata('pesan', 'Tugas berhasil diubah!');
			redirect('guru/topik/detail/' . $inputan['id_topik'], 'refresh');
		}
		$this->session->set_flashdata('errors_ubahtugas', validation_errors());
		redirect('guru/topik/detail/' . $inputan['id_topik'], 'refresh');
	}
}

/* End of file Tugas.php */
/* Location: ./application/controllers/guru/Tugas.php */