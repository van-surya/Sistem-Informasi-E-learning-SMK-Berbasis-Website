<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mguru extends CI_Model
{

    public function login_guru($inputan)
    {
        $username = $inputan['username'];
        $password = $inputan['password'];
        $password = sha1($password);

        //cek ke tb petugas ada atau tdk data  dgn username dan password tsb.
        $this->db->where('nip_guru', $username);
        $this->db->where('password_guru', $password);
        $ambil = $this->db->get('guru');

        //cek dlm bentuk array
        $guru = $ambil->row_array();

        //jk kosong
        if (empty($guru)) {
            return "gagal";
        } else {
            //menyimpan akun pelogin disession sbg bukti jika sudah login
            $this->db->where('status_th_ajaran', "Aktif");
            $tahun = $this->db->get('th_ajaran')->row_array();

            $this->session->set_userdata("id_tahun", $tahun['id_tahun']);
            $this->session->set_userdata("guru", $guru);
            return "sukses";
        }
    }

    function ubah_profil($inputan, $id_guru)
    {
        // jika inputan['password_guru'] kosong
        if (empty($inputan['password_guru'])) {
            // buang dari array inputan agar tidak di update
            unset($inputan['password_guru']);
        } else {

            // ambil pass dari inputan
            $pass_inputan = $inputan['password_guru'];

            // enkripsi pakai SHA1
            $pass_enkrip = sha1($pass_inputan);

            // masukan pass yg sudah di enkrip ke dalam array inputan index password_guru
            $inputan['password_guru'] = $pass_enkrip;
        }

        // cek apakah ada file yang di upload
        // kalau tidak kosong, jalankan proses upload foto/ubah foto
        if (!empty($_FILES['foto_guru']['name'])) {

            $config['upload_path'] = './assets/img/guru/';
            $config['allowed_types'] = 'gif|png|jpg|jpeg';
            $this->upload->initialize($config);

            //proses upload
            $ngupload = $this->upload->do_upload("foto_guru");

            //mendapatkan nama foto yg diupload
            if ($ngupload) {
                $inputan["foto_guru"] = $this->upload->data("file_name");

                // cari file lampiran lama 
                $guru = $this->detail_guru($id_guru);
                $foto_guru_lama = $guru['foto_guru'];

                // lokasi file lama 
                $lokasi = FCPATH . "assets/img/guru/$foto_guru_lama";
                // cek apakah ada file lama di folder trstb
                if (file_exists($lokasi) and !empty($foto_guru_lama)) {
                    // kalau ada filenya
                    // hapus file lama dari folder assets/guru
                    unlink($lokasi);
                }
            }
        }

        $this->db->where('id_guru', $id_guru);
        $this->db->update('guru', $inputan);

        // ambil data guru yg sedang barusan di ubah
        $guru = $this->detail_guru($id_guru);
        // update session guru dengan data guru yang ter update
        $this->session->set_userdata('guru', $guru);
    }

    function detail_guru($id_guru)
    {
        $this->db->where('id_guru', $id_guru);
        $ambil = $this->db->get('guru');

        return $ambil->row_array();
    }

    function tampil_mapel_guru_tahun($id_guru, $id_tahun)
    {
        $this->db->where('id_guru', $id_guru);
        $this->db->where('th_ajaran.id_tahun', $id_tahun);
        $this->db->join('perkelasan', 'perkelasan.id_perkelasan = mengajar.id_perkelasan', 'left');
        $this->db->join('mapel', 'mapel.id_mapel = mengajar.id_mapel', 'left');
        $this->db->join('kelas', 'kelas.id_kelas = perkelasan.id_kelas', 'left');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan', 'left');
        $this->db->join('th_ajaran', 'th_ajaran.id_tahun = perkelasan.id_tahun', 'left');
        $ambil = $this->db->get('mengajar');
        return $ambil->result_array();
    }

    function detail_mengajar($id_mengajar)
    {
        $this->db->where('id_mengajar', $id_mengajar);
        $this->db->join('perkelasan', 'perkelasan.id_perkelasan = mengajar.id_perkelasan', 'left');
        $this->db->join('mapel', 'mapel.id_mapel = mengajar.id_mapel', 'left');
        $this->db->join('kelas', 'kelas.id_kelas = perkelasan.id_kelas', 'left');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan', 'left');
        $this->db->join('th_ajaran', 'th_ajaran.id_tahun = perkelasan.id_tahun', 'left');
        $ambil = $this->db->get('mengajar');
        return $ambil->row_array();
    }
    function jumlah_topik_siswa($id_mengajar)
    {
        $ambil = $this->db->query("SELECT COUNT(id_topik) as jumlah FROM
        topik WHERE id_mengajar='$id_mengajar'");
        return $ambil->row_array();
    }

    function tampil_topik_mengajar($id_mengajar, $posisi = null, $batas = null)
    {
        $this->db->order_by('topik.tgl_dibuat', 'DESC');
        $this->db->where('id_mengajar', $id_mengajar);
        $ambil = $this->db->get('topik', $batas, $posisi);
        return $ambil->result_array();
    }

    function simpan_topik($inputan)
    {
        $inputan['tgl_dibuat'] = date('Y-m-d H:i:s');
        $this->db->insert('topik', $inputan);
    }

    function ubah_topik($inputan, $id_topik)
    {
        $this->db->where('id_topik', $id_topik);
        $this->db->update('topik', $inputan);
    }

    function detail_topik($id_topik)
    {
        $this->db->where('id_topik', $id_topik);
        $ambil = $this->db->get('topik');
        $detail = $ambil->row_array();
        return $detail;
    }

    function hapus_materi($id_materi)
    {
        //hapus data

        //dapatkan dulu data materi berdasarkan id
        $this->db->where('id_materi', $id_materi);
        $ambil = $this->db->get('materi');
        $materi = $ambil->row_array();

        $nama_file = $materi['file_materi'];

        //jk file ada, maka dihapus
        if (!empty($nama_file) && file_exists(FCPATH . "assets/materi/" . $nama_file)) {
            unlink(FCPATH . "assets/materi/" . $nama_file);
        }

        $this->db->where('id_materi', $id_materi);
        $this->db->delete('materi');
    }

    // guru
    function simpan_materi($inputan)
    {
        // jika tidak upload file, skip proses upload
        if (!empty($_FILES['file_materi']['name'])) {
            $config['upload_path'] = './assets/materi/';
            $config['allowed_types'] = 'gif|png|jpg|zip|rar|pdf|doc|docx|xlsm|xlsx|csv|xls';
            $this->upload->initialize($config);
            $ngupload = $this->upload->do_upload('file_materi');
            if ($ngupload) {
                $inputan['file_materi'] = $this->upload->data('file_name');
            }
        }
        $this->db->insert('materi', $inputan);
    }


    function detail_materi($id_topik)
    {
        $this->db->where('id_topik', $id_topik);
        $ambil = $this->db->get('materi');
        $detail = $ambil->row_array();
        return $detail;
    }

    function tampil_materi($id_materi)
    {
        $this->db->where('id_materi', $id_materi);
        $ambil = $this->db->get('materi');
        $detail = $ambil->row_array();
        return $detail;
    }

    function detail_ubah_materi($id_materi)
    {
        $this->db->where('id_materi', $id_materi);
        $ambil = $this->db->get('materi');
        $detail = $ambil->row_array();
        return $detail;
    }

    function ubah_materi($inputan, $id_materi)
    {
        // cek apakah ada file lampiran yang di upload
        // jika tidak ada, lewati proses upload
        if (!empty($_FILES['file_materi']['name'])) {
            $config['upload_path'] = './assets/materi/';
            $config['allowed_types'] = 'gif|png|jpg|zip|rar|pdf|doc|docx|xlsm|xlsx|csv|xls';
            $this->upload->initialize($config);
            $ngupload = $this->upload->do_upload('file_materi');
            if ($ngupload) {
                $inputan['file_materi'] = $this->upload->data('file_name');
                $materi = $this->detail_ubah_materi($id_materi);
                $file_lama = $materi['file_materi'];
                // lokasi file lama 
                $lokasi = FCPATH . "assets/materi/$file_lama";
                // cek apakah ada file lama di folder trstb
                if (file_exists($lokasi) and !empty($file_lama)) {
                    // kalau ada filenya
                    // hapus file lama dari folder assets/topik
                    unlink($lokasi);
                }
            }
        }

        $this->db->where('id_materi', $id_materi);
        $this->db->update('materi', $inputan);
    }


    function hapus_topik($id_topik)
    {
        $this->db->where('id_topik', $id_topik);
        $this->db->delete("topik");
    }

    // tugas



    function tampil_tugas($id_tugas)
    {
        $this->db->where('id_tugas', $id_tugas);
        $ambil = $this->db->get('tugas');
        $detail = $ambil->row_array();
        return $detail;
    }

    function tampil_tugas_siswa($id_topik)
    {
        $this->db->where('topik.id_topik', $id_topik);
        $this->db->join('topik', 'tugas.id_topik = topik.id_topik', 'left');
        $this->db->join('mengajar', 'topik.id_mengajar = mengajar.id_mengajar', 'left');
        $this->db->join('perkelasan_detail', 'mengajar.id_perkelasan = perkelasan_detail.id_perkelasan', 'left');
        $this->db->join('siswa', 'perkelasan_detail.id_siswa = siswa.id_siswa', 'left');
        $siswa = $this->db->get('tugas')->result_array();


        $semuadata = array();

        foreach ($siswa as $key => $value) {
            $this->db->where('id_siswa', $value['id_siswa']);
            $this->db->where('id_tugas', $value['id_tugas']);
            $value["jawaban"] = $this->db->get('jawaban')->row_array();
            $semuadata[] = $value;
        }

        return $semuadata;
    }

    function detail_tugas($id_topik)
    {
        $this->db->where('id_topik', $id_topik);
        $ambil = $this->db->get('tugas');
        $detail = $ambil->row_array();
        return $detail;
    }


    function simpan_tugas($inputan)
    {
        // jika tidak upload file, skip proses upload
        if (!empty($_FILES['file_tugas']['name'])) {
            $config['upload_path'] = './assets/tugas/';
            $config['allowed_types'] = 'gif|png|jpg|zip|rar|pdf|doc|docx|xlsm|xlsx|csv|xls';
            $this->upload->initialize($config);
            $ngupload = $this->upload->do_upload('file_tugas');
            if ($ngupload) {
                $inputan['file_tugas'] = $this->upload->data('file_name');
            }
        }
        $this->db->insert('tugas', $inputan);
    }

    function hapus_tugas($id_tugas)
    {
        //dapatkan dulu data tugas berdasarkan id
        $this->db->where('id_tugas', $id_tugas);
        $ambil = $this->db->get('tugas');
        $tugas = $ambil->row_array();

        $nama_file = $tugas['file_tugas'];

        //jk file ada, maka dihapus
        if (!empty($nama_file) && file_exists(FCPATH . "assets/tugas/" . $nama_file)) {
            unlink(FCPATH . "assets/tugas/" . $nama_file);
        }

        $this->db->where('id_tugas', $id_tugas);
        $this->db->delete('tugas');
    }

    function detail_ubah_tugas($id_tugas)
    {
        $this->db->where('id_tugas', $id_tugas);
        $ambil = $this->db->get('tugas');
        $detail = $ambil->row_array();
        return $detail;
    }

    function ubah_tugas($inputan, $id_tugas)
    {
        // cek apakah ada file lampiran yang di upload
        // jika tidak ada, lewati proses upload
        if (!empty($_FILES['file_tugas']['name'])) {
            $config['upload_path'] = './assets/tugas/';
            $config['allowed_types'] = 'gif|png|jpg|zip|rar|pdf|doc|docx|xlsm|xlsx|csv|xls';
            $this->upload->initialize($config);
            $ngupload = $this->upload->do_upload('file_tugas');
            if ($ngupload) {
                $inputan['file_tugas'] = $this->upload->data('file_name');
                $tugas = $this->detail_ubah_tugas($id_tugas);
                $file_lama = $tugas['file_tugas'];
                // lokasi file lama 
                $lokasi = FCPATH . "assets/tugas/$file_lama";
                if (file_exists($lokasi) and !empty($file_lama)) {
                    // kalau ada filenya
                    // hapus file lama dari folder assets/topik
                    unlink($lokasi);
                }
            }
        }

        $this->db->where('id_tugas', $id_tugas);
        $this->db->update('tugas', $inputan);
    }


    // jawaban tugas
    function tampil_jawaban($id_tugas)
    {

        $this->db->join('siswa', 'siswa.id_siswa = jawaban.id_siswa', 'left');
        $this->db->where('id_tugas', $id_tugas);
        $ambil = $this->db->get('jawaban');

        return $ambil->result_array();
    }

    function input_nilai_jawaban_tugas($inputan)
    {
        $id_tugas = $inputan['id_tugas'];
        $id_siswa = $inputan['id_siswa'];
        $nilai = $inputan['nilai_jawaban'];

        $this->db->where('id_tugas', $id_tugas);
        $this->db->where('id_siswa', $id_siswa);
        $this->db->set('nilai_jawaban', $nilai);
        $this->db->update('jawaban');
        // mengupdate ke tbl nilai (klo blm ada maka menginsert)

        $this->db->where('id_topik', $inputan['id_topik']);
        $topik = $this->db->get('topik')->row_array();
        $id_mengajar = $topik['id_mengajar'];

        $this->db->where('id_mengajar', $id_mengajar);
        $mengajar = $this->db->get('mengajar')->row_array();
        $id_perkelasan = $mengajar['id_perkelasan'];

        // daptkan id perkelasan detail 
        $this->db->where('id_perkelasan', $id_perkelasan);
        $this->db->where('id_siswa', $inputan['id_siswa']);
        $perkelasan_detail = $this->db->get('perkelasan_detail')->row_array();
        $id_perkelasan_detail  = $perkelasan_detail['id_perkelasan_detail'];

        $this->db->where('id_mengajar', $id_mengajar);
        $this->db->where('id_perkelasan_detail', $id_perkelasan_detail);
        $nilai = $this->db->get('nilai')->row_array();

        $id_siswa = $inputan['id_siswa'];
        $this->db->where('topik.id_mengajar', $id_mengajar);
        $this->db->join('topik', 'topik.id_topik = tugas.id_topik', 'left');
        $tugases = $this->db->get('tugas')->result_array();
        $total_tugas = 0;
        $rata = 0;
        $jumlah_tugas = count($tugases);
        foreach ($tugases as $kuy => $tugas) {
            $id_tugas = $tugas['id_tugas'];
            $this->db->where('id_siswa', $id_siswa);
            $this->db->where('id_tugas', $id_tugas);
            $tugas['jawaban'] = $this->db->get('jawaban')->row_array();

            $total_tugas += !empty($tugas['jawaban']) ? $tugas['jawaban']['nilai_jawaban'] : 0;
        }
        $rata = $total_tugas / $jumlah_tugas;

        if (empty($nilai)) {
            $mlebu['id_mengajar'] = $id_mengajar;
            $mlebu['id_perkelasan_detail'] = $id_perkelasan_detail;
            $mlebu['rata_rata_nilai'] = $rata;
            $this->db->insert('nilai', $mlebu);
        } else {
            $this->db->where('id_perkelasan_detail', $id_perkelasan_detail);
            $this->db->where('id_mengajar', $id_mengajar);
            $this->db->set('rata_rata_nilai', $rata);
            $this->db->update('nilai');
        }
    }

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


    function detail_perkelasan_detail($id_perkelasan, $id_siswa)
    {
        $this->db->where('id_perkelasan', $id_perkelasan);
        $this->db->where('id_siswa', $id_siswa);
        $ambil = $this->db->get('perkelasan_detail');
        return $ambil->row_array();
    }

    function tampil_nilai_tugas_siswa($id_mengajar)
    {
        $this->db->where('mengajar.id_mengajar', $id_mengajar);
        $this->db->join('mengajar', 'mengajar.id_perkelasan = perkelasan_detail.id_perkelasan', 'left');
        $this->db->join('siswa', 'siswa.id_siswa = perkelasan_detail.id_siswa', 'left');
        $siswas = $this->db->get('perkelasan_detail')->result_array();

        $semuadata = array();
        foreach ($siswas as $key => $siswa) {
            $id_siswa = $siswa['id_siswa'];
            $this->db->where('topik.id_mengajar', $id_mengajar);
            $this->db->join('topik', 'topik.id_topik = tugas.id_topik', 'left');
            $tugases = $this->db->get('tugas')->result_array();
            $siswa['total_tugas'] = 0;
            $siswa['rata'] = 0;
            $siswa['jumlah_tugas'] = count($tugases);
            foreach ($tugases as $kuy => $tugas) {
                $id_tugas = $tugas['id_tugas'];
                $this->db->where('id_siswa', $id_siswa);
                $this->db->where('id_tugas', $id_tugas);
                $tugas['jawaban'] = $this->db->get('jawaban')->row_array();

                $siswa['total_tugas'] += !empty($tugas['jawaban']['nilai_jawaban']) ? $tugas['jawaban']['nilai_jawaban'] : 0;
                $siswa['tugas'][] = $tugas;
            }
            $siswa["rata"] = $siswa['jumlah_tugas'] > 0 ? $siswa['total_tugas'] / $siswa['jumlah_tugas'] : 0;
            $semuadata[] = $siswa;
        }
        return $semuadata;
    }
    function tampil_tugas_mengajar($id_mengajar)
    {
        $this->db->where('topik.id_mengajar', $id_mengajar);
        $this->db->join('topik', 'topik.id_topik = tugas.id_topik', 'left');
        return $this->db->get('tugas')->result_array();
    }
    function tampil_notifikasi_jawaban()
    {
        $guru = $this->session->userdata('guru');
        $id_guru = $guru['id_guru'];
        $id_tahun = $this->session->userdata('id_tahun');

        $this->db->where('mengajar.id_guru', $id_guru);
        $this->db->where('perkelasan.id_tahun', $id_tahun);
        $this->db->where('jawaban.nilai_jawaban', '');
        $this->db->join('siswa', 'siswa.id_siswa = jawaban.id_siswa', 'left');
        $this->db->join('tugas', 'tugas.id_tugas = jawaban.id_tugas', 'left');
        $this->db->join('topik', 'topik.id_topik = tugas.id_topik', 'left');
        $this->db->join('mengajar', 'mengajar.id_mengajar = topik.id_mengajar', 'left');
        $this->db->join('mapel', 'mapel.id_mapel = mengajar.id_mapel', 'left');
        $this->db->join('perkelasan', 'perkelasan.id_perkelasan = mengajar.id_perkelasan', 'left');
        $jawaban = $this->db->get('jawaban')->result_array();
        return $jawaban;
    }
}

/* End of file Mguru.php */