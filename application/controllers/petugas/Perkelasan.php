<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perkelasan extends CI_Controller
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
        $data['perkelasan'] =  $this->Mpetugas->tampil_perkelasan();
        $data['kelas'] = $this->Mpetugas->tampil_kelas();
        $data['jurusan'] = $this->Mpetugas->tampil_jurusan();
        $data['th_ajaran'] = $this->Mpetugas->tampil_tahunajaran();
        $data['title'] = 'Data Perkelasan';
        $this->load->view('petugas/header', $data);
        $this->load->view('petugas/perkelasan', $data);
        $this->load->view('petugas/footer');
    }

    public function tambah()
    {
        $inputan = $this->input->post();
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('id_tahun', 'Tahun Ajaran', 'required');

        if ($this->form_validation->run() == TRUE) {
            $hasil = $this->Mpetugas->simpan_perkelasan($inputan);
            if ($hasil == "sukses") {
                $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('pesan_gagal', 'Data sudah ada');
            }
            redirect('petugas/perkelasan', 'refresh');
        }
        $this->session->set_flashdata('errors', validation_errors());
        redirect('petugas/perkelasan', 'refresh');
    }

    public function hapus_perkelasan()
    {
        $idnya = $this->input->post("id");
        $this->Mpetugas->hapus_perkelasan($idnya);
    }

    public function terpilih()
    {
        $id_perkelasan = $this->input->post('id');
        $this->session->set_userdata("perkelasan_terpilih", $id_perkelasan);
    }

    public function ubah($id_perkelasan)
    {
        $inputan = $this->input->post();
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('id_tahun', 'Tahun Ajaran', 'required');

        if ($this->form_validation->run() == TRUE) {
            $hasil = $this->Mpetugas->ubah_perkelasan($inputan, $id_perkelasan);
            if ($hasil == 'sukses') {
                $this->session->set_flashdata('pesan', 'Data berhasil diperbarui!');
                redirect('petugas/perkelasan', 'refresh');
            } else {
                $this->session->set_flashdata('errors_ubah', 'Data sudah ada');
                redirect('petugas/perkelasan', 'refresh');
            }
        } else {
            $this->session->set_flashdata('errors_ubah', validation_errors());
            redirect('petugas/perkelasan', 'refresh');
        }
    }


    public function detail($id_perkelasan)
    {
        $inputan = $this->input->post();
        if ($inputan) {
            $this->Mpetugas->pindah_perkelasan($inputan);
            $this->session->set_flashdata('pesan', 'Siswa telah pindah kelas');

            redirect('petugas/perkelasan/detail/' . $id_perkelasan, 'refresh');
        }
        $data['tanpa_kelas'] = $this->Mpetugas->tampil_siswa_tanpa_kelas();
        $data['perkelasan'] = $this->Mpetugas->tampil_perkelasan_detail();
        $data['kelas'] = $this->Mpetugas->detail_perkelasan($id_perkelasan);
        $data['siswa'] = $this->Mpetugas->siswa_perkelasan($id_perkelasan);
        $data['title'] = "Detail kelas " . $data['kelas']['jenjang'] . $data['kelas']['singkatan_jurusan'] . $data['kelas']['rombel'];

        $this->load->view('petugas/header', $data);
        $this->load->view('petugas/detail_perkelasan', $data);
        $this->load->view('petugas/footer');
    }

    public function hapus_detail($id_perkelasan_detail, $id_perkelasan)
    {
        $this->Mpetugas->hapus_detailperkelasan($id_perkelasan_detail);
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        //err
        redirect('petugas/perkelasan/detail/' . $id_perkelasan, 'refresh');
    }

    public function tambah_detailperkelasan()
    {
        $inputan = $this->input->post();

        if ($inputan) {
            $id_perkelasan = $inputan['id_perkelasan'];
            $siswas = $inputan['id_siswa'];
            $this->Mpetugas->simpan_detail_perkelasan($id_perkelasan, $siswas);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
            redirect('petugas/perkelasan/detail/' . $id_perkelasan, 'refresh');
        }
    }
}

/* End of file Perkelasan.php */
/* Location: ./application/controllers/petugas/Perkelasan.php */