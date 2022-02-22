<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Msiswa extends CI_Model
{

    public function login_siswa($inputan)
    {
        $username = $inputan['username'];
        $password = $inputan['password'];
        $password = sha1($password);

        //cek ke tb petugas ada atau tdk data  dgn username dan password tsb.
        $this->db->where('nis', $username);
        $this->db->where('password_siswa', $password);
        $ambil = $this->db->get('siswa');

        //cek dlm bentuk array
        $siswa = $ambil->row_array();

        //jk kosong
        if (empty($siswa)) {
            return "gagal";
        } else {
            $this->db->where('status_th_ajaran', "Aktif");
            $tahun = $this->db->get('th_ajaran')->row_array();
            //menyimpan akun pelogin disession sbg bukti jika sudah login
            $this->session->set_userdata("id_tahun", $tahun['id_tahun']);
            $this->session->set_userdata("siswa", $siswa);
            return "sukses";
        }
    }

    function ubah_profil($inputan, $id_siswa)
    {
        // jika inputan['password_siswa'] kosong
        if (empty($inputan['password_siswa'])) {
            // buang dari array inputan agar tidak di update
            unset($inputan['password_siswa']);
        } else {
            // ambil pass dari inputan
            $pass_inputan = $inputan['password_siswa'];
            // enkripsi pakai SHA1
            $pass_enkrip = sha1($pass_inputan);
            // masukan pass yg sudah di enkrip ke dalam array inputan index password_siswa
            $inputan['password_siswa'] = $pass_enkrip;
        }
        // cek apakah ada file yang di upload
        // kalau tidak kosong, jalankan proses upload foto/ubah foto
        if (!empty($_FILES['foto_siswa']['name'])) {
            $config['upload_path'] = './assets/img/siswa/';
            $config['allowed_types'] = 'gif|png|jpg|jpeg';
            $this->upload->initialize($config);
            //proses upload
            $ngupload = $this->upload->do_upload("foto_siswa");
            //mendapatkan nama foto yg diupload
            if ($ngupload) {
                $inputan["foto_siswa"] = $this->upload->data("file_name");
                // cari file lampiran lama 
                $siswa = $this->detail_siswa($id_siswa);
                $foto_siswa_lama = $siswa['foto_siswa'];
                // lokasi file lama 

                // lokasi file lama 
                $lokasi = FCPATH . "assets/img/siswa/$foto_siswa_lama";
                // cek apakah ada file lama di folder trstb
                if (file_exists($lokasi) and !empty($foto_siswa_lama)) {
                    // hapus file lama dari folder assets/siswa
                    unlink($lokasi);
                }
            }
        }

        $this->db->where('id_siswa', $id_siswa);
        $this->db->update('siswa', $inputan);
        // ambil data siswa yg sedang barusan di ubah
        $siswa = $this->detail_siswa($id_siswa);
        // update session siswa dengan data siswa yang ter update
        $this->session->set_userdata('siswa', $siswa);
    }

    function detail_siswa($id_siswa)
    {
        $this->db->where('id_siswa', $id_siswa);
        $ambil = $this->db->get('siswa');
        return $ambil->row_array();
    }

    function tampil_mapel_siswa($id_siswa)
    {
        $this->db->join('perkelasan', 'perkelasan.id_perkelasan = mengajar.id_perkelasan', 'left');
        $this->db->join('perkelasan_detail', 'perkelasan_detail.id_perkelasan = perkelasan.id_perkelasan', 'left');
        $this->db->join('mapel', 'mapel.id_mapel = mengajar.id_mapel', 'left');
        $this->db->join('guru', 'guru.id_guru = mengajar.id_guru', 'left');
        $this->db->join('kelas', 'kelas.id_kelas = perkelasan.id_kelas', 'left');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan', 'left');
        $this->db->join('th_ajaran', 'th_ajaran.id_tahun = perkelasan.id_tahun', 'left');
        $this->db->where('id_siswa', $id_siswa);
        $ambil = $this->db->get('mengajar');
        return $ambil->result_array();
    }

    function tampil_topik_siswa($id_mengajar, $posisi = null, $batas = null)
    {
        $this->db->where('topik.topik_mulai <', date('Y-m-d H:i:s'));
        $this->db->order_by('topik.tgl_dibuat', 'DESC');
        $this->db->where('id_mengajar', $id_mengajar);
        $ambil = $this->db->get('topik', $batas, $posisi);
        return $ambil->result_array();
    }

    function jumlah_topik_siswa($id_mengajar)
    {
        $ambil = $this->db->query("SELECT COUNT(id_topik) as jumlah FROM
        topik WHERE id_mengajar='$id_mengajar'");
        return $ambil->row_array();
    }

    function detail_mengajar($id_mengajar)
    {
        $this->db->where('id_mengajar', $id_mengajar);
        $this->db->join('perkelasan', 'perkelasan.id_perkelasan = mengajar.id_perkelasan', 'left');
        $this->db->join('guru', 'guru.id_guru = mengajar.id_guru', 'left');
        $this->db->join('mapel', 'mapel.id_mapel = mengajar.id_mapel', 'left');
        $this->db->join('kelas', 'kelas.id_kelas = perkelasan.id_kelas', 'left');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan', 'left');
        $this->db->join('th_ajaran', 'th_ajaran.id_tahun = perkelasan.id_tahun', 'left');
        $ambil = $this->db->get('mengajar');
        return $ambil->row_array();
    }
    function detail_topik($id_topik)
    {
        $this->db->where('id_topik', $id_topik);
        $ambil = $this->db->get('topik');
        $detail = $ambil->row_array();
        return $detail;
    }
    //materi
    function tampil_materi($id_topik)
    {
        $this->db->where('id_topik', $id_topik);
        $ambil = $this->db->get('materi');
        return $ambil->row_array();
    }
    function detail_materi($id_materi)
    {
        $this->db->where('id_materi', $id_materi);
        $ambil = $this->db->get('materi');
        return $ambil->row_array();
    }
    //tugas
    function tampil_tugas($id_topik)
    {
        $this->db->where('id_topik', $id_topik);
        $ambil = $this->db->get('tugas');
        return $ambil->row_array();
    }
    function detail_tugas($id_tugas)
    {
        $this->db->where('id_tugas', $id_tugas);
        $ambil = $this->db->get('tugas');
        return $ambil->row_array();
    }

    //forumdiskusi
    function tampil_diskusi($id_mengajar)
    {
        $this->db->join('siswa', 'siswa.id_siswa = forum_diskusi.id_pengirim_siswa', 'left');
        $this->db->join('guru', 'guru.id_guru = forum_diskusi.id_pengirim_guru', 'left');
        $this->db->where('id_mengajar', $id_mengajar);

        // order = urutan
        $this->db->order_by('forum_diskusi.tanggal_diskusi', 'ASC');

        $ambil = $this->db->get('forum_diskusi');

        return $ambil->result_array();
    }

    function kirim_pesan_diskusi($id_mengajar, $inputan)
    {
        $inputan['id_mengajar'] = $id_mengajar;
        $inputan['tanggal_diskusi'] = date("Y-m-d H:i:s");

        $this->db->insert('forum_diskusi', $inputan);
    }


    function tampil_nilai($id_siswa, $id_mengajar)
    {
        $data = array();
        $this->db->join('topik', 'topik.id_topik = tugas.id_topik', 'left');
        $this->db->join('mengajar', 'mengajar.id_mengajar = topik.id_mengajar', 'left');
        $this->db->where('mengajar.id_mengajar', $id_mengajar);

        $ambil = $this->db->get('tugas');
        $data_tugas = $ambil->result_array();

        foreach ($data_tugas as $key => $value) {
            $this->db->where('id_siswa', $id_siswa);
            $this->db->where('id_tugas', $value['id_tugas']);
            $ambil_jawaban = $this->db->get('jawaban');
            $data_jawaban = $ambil_jawaban->row_array();

            $data[$key] = $value;
            if (!empty($data_jawaban) and !empty($data_jawaban['nilai_jawaban'])) {
                $data[$key]['nilai'] = $data_jawaban['nilai_jawaban'];
            } elseif (!empty($data_jawaban) and empty($data_jawaban['nilai_jawaban'])) {
                $data[$key]['nilai'] = "";
            } else {
                $data[$key]['nilai'] = 0;
            }
        }
        return $data;
    }

    function tampil_rata_rata_nilai($id_siswa, $id_mengajar, $id_tahun)
    {
        $data = array();
        $this->db->join('perkelasan_detail', 'perkelasan_detail.id_perkelasan_detail = nilai.id_perkelasan_detail', 'left');
        $this->db->join('perkelasan', 'perkelasan.id_perkelasan = perkelasan_detail.id_perkelasan', 'left');
        $this->db->where('id_mengajar', $id_mengajar);
        $this->db->where('id_siswa', $id_siswa);
        $this->db->where('id_tahun', $id_tahun);
        $ambil = $this->db->get('nilai');
        $data  = $ambil->row_array();
        return $data;
    }

    function simpan_jawaban($inputan)
    {
        $config['upload_path'] = './assets/jawaban/';
        $config['allowed_types'] = 'gif|png|jpg|zip|rar|pdf|doc|docx|xlsm|xlsx|csv|xls';

        $this->upload->initialize($config);
        $ngupload = $this->upload->do_upload('file_jawaban');
        if ($ngupload) {
            $inputan['file_jawaban'] = $this->upload->data('file_name');
        }
        $inputan['tgl_jawaban'] = date('Y-m-d H:i:s');
        $this->db->insert('jawaban', $inputan);
    }

    function hapus_jawaban($id_jawaban)
    {
        $this->db->where('id_jawaban', $id_jawaban);
        $ambil = $this->db->get('jawaban');
        $jawaban = $ambil->row_array();
        $nama_file = $jawaban['file_jawaban'];
        //jk file ada, maka dihapus
        if (!empty($nama_file) && file_exists(FCPATH . "assets/jawaban/" . $nama_file)) {
            unlink(FCPATH . "assets/jawaban/" . $nama_file);
        }
        $this->db->where('id_jawaban', $id_jawaban);
        $this->db->delete('jawaban');
    }

    function tampil_jawaban($id_tugas)
    {
        $siswa = $this->session->userdata('siswa');
        $id_siswa = $siswa['id_siswa'];
        // $this->db->join('siswa', 'siswa.id_siswa = jawaban.id_siswa', 'left');
        $this->db->where('id_tugas', $id_tugas);
        $this->db->where('id_siswa', $id_siswa);
        $ambil = $this->db->get('jawaban');
        return $ambil->row_array();
    }

    function detail_jawaban($id_jawaban)
    {
        $this->db->where('id_jawaban', $id_jawaban);
        $ambil = $this->db->get('jawaban');
        return $ambil->row_array();
    }

    function ubah_jawaban($inputan, $id_jawaban)
    {
        // cek apakah ada file lampiran yang di upload
        // jika tidak ada, lewati proses upload
        if (!empty($_FILES['file_jawaban']['name'])) {
            $config['upload_path'] = './assets/jawaban/';
            $config['allowed_types'] = 'gif|png|jpg|zip|rar|pdf|doc|docx|xlsm|xlsx|csv|xls';
            $this->upload->initialize($config);
            $ngupload = $this->upload->do_upload('file_jawaban');
            if ($ngupload) {
                $inputan['file_jawaban'] = $this->upload->data('file_name');
                $jawaban = $this->detail_jawaban($id_jawaban);
                $file_lama = $jawaban['file_jawaban'];
                // lokasi file lama 

                // lokasi file lama 
                $lokasi = FCPATH . "assets/jawaban/$file_lama";
                // cek apakah ada file lama di folder trstb
                if (file_exists($lokasi) and !empty($file_lama)) {
                    // kalau ada filenya
                    // hapus file lama dari folder assets/topik
                    unlink($lokasi);
                }
            }
        }
        $inputan['tgl_jawaban'] = date('Y-m-d H:i:s');
        $this->db->where('id_jawaban', $id_jawaban);
        $this->db->update('jawaban', $inputan);
    }
    function detail_kelas($id_siswa)
    {
        $this->db->join('perkelasan', 'perkelasan.id_perkelasan = perkelasan_detail.id_perkelasan', 'left');
        $this->db->join('kelas', 'kelas.id_kelas = perkelasan.id_kelas', 'left');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan', 'left');
        $this->db->join('th_ajaran', 'th_ajaran.id_tahun = perkelasan.id_tahun', 'left');
        $this->db->where('status_th_ajaran', "Aktif");
        $this->db->where('id_siswa', $id_siswa);
        $ambil = $this->db->get('perkelasan_detail');
        return $ambil->row_array();
    }

    function tampil_notifikasi_topik()
    {
        $siswa = $this->session->userdata('siswa');
        $id_siswa = $siswa['id_siswa'];
        $id_tahun =  $this->session->userdata('id_tahun');

        $this->db->where('perkelasan.id_tahun', $id_tahun);
        $this->db->where('perkelasan_detail.id_siswa', $id_siswa);

        $this->db->where('topik.topik_mulai <', date('Y-m-d H:i:s'));
        $this->db->where('topik.topik_berakhir >', date('Y-m-d H:i:s'));

        $this->db->order_by('topik.topik_mulai', 'ASC');
        $this->db->join('mengajar', 'mengajar.id_mengajar = topik.id_mengajar', 'left');
        $this->db->join('mapel', 'mapel.id_mapel = mengajar.id_mapel', 'left');
        $this->db->join('perkelasan', 'perkelasan.id_perkelasan = mengajar.id_perkelasan', 'left');
        $this->db->join('perkelasan_detail', 'perkelasan_detail.id_perkelasan = perkelasan.id_perkelasan', 'left');

        $not = $this->db->get('topik')->result_array();
        return $not;

        // echo "<pre>";
        // print_r($not);
        // print_r($this->db->last_query());

        // echo "<pre>";
    }
}
