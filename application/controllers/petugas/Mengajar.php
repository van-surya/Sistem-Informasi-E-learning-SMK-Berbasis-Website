<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mengajar extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('Mpetugas');

		if (!$this->session->userdata("petugas")) {
			$this->session->set_flashdata('pesan', 'Anda harus login');
			redirect('', 'refresh');
		}
	}

	public function index()
	{
		$data['mengajar'] =  $this->Mpetugas->tampil_mengajar();
		$data['guru'] = $this->Mpetugas->tampil_guru();
		$data['mapel'] = $this->Mpetugas->tampil_mapel();
		$data['perkelasan'] = $this->Mpetugas->tampil_perkelasan();

		$data['title'] = 'Data Mengajar';

		$this->load->view('petugas/header', $data);
		$this->load->view('petugas/mengajar');
		$this->load->view('petugas/footer');
	}

	public function tambah()
	{
		$inputan = $this->input->post();
		$this->form_validation->set_rules('id_guru', 'Guru', 'required');
		$this->form_validation->set_rules('id_mapel', 'Mata pelajaran', 'required');
		$this->form_validation->set_rules('id_perkelasan', 'Kelas', 'required');

		if ($this->form_validation->run() == TRUE) {
			$hasil = $this->Mpetugas->simpan_mengajar($inputan);
			if ($hasil == 'sukses') {
				$this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
			} else {
				$this->session->set_flashdata('pesan_gagal', 'Data sudah ada');
			}
			redirect('petugas/mengajar', 'refresh');
		}
		$this->session->set_flashdata('errors', validation_errors());
		redirect('petugas/mengajar', 'refresh');
	}



	public function hapus_mengajar()
	{
		$idnya = $this->input->post("id");
		$this->Mpetugas->hapus_mengajar($idnya);
	}

	public function terpilih()
	{
		$id_mengajar = $this->input->post('id');
		$this->session->set_userdata("mengajar_terpilih", $id_mengajar);
	}

	public function ubah($id_mengajar)
	{
		$inputan = $this->input->post();
		$this->form_validation->set_rules('id_guru', 'Guru', 'required');
		$this->form_validation->set_rules('id_mapel', 'Mata pelajaran', 'required');
		$this->form_validation->set_rules('id_perkelasan', 'Kelas', 'required');

		if ($this->form_validation->run() == TRUE) {
			$hasil = $this->Mpetugas->ubah_mengajar($inputan, $id_mengajar);
			if ($hasil == 'sukses') {
				$this->session->set_flashdata('pesan', 'Data berhasil diperbarui!');
				redirect('petugas/mengajar', 'refresh');
			} else {
				$this->session->set_flashdata('errors_ubah', 'Data sudah ada');
				redirect('petugas/mengajar', 'refresh');
			}
		} else {
			$this->session->set_flashdata('errors_ubah', validation_errors());
			redirect('petugas/mengajar', 'refresh');
		}
	}
}
 
/* End of file Mengajar.php */
/* Location: ./application/controllers/petugas/Mengajar.php */