<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mpetugas extends CI_Model
{

    // fung log
    public function login_petugas($inputan)
    {
        $username = $inputan['username'];
        $password = $inputan['password'];
        $password = sha1($password);
        //cek ke tb petugas ada atau tdk data  dgn username dan password tsb.
        $this->db->where('username', $username);
        $this->db->where('password_petugas', $password);
        $ambil = $this->db->get('petugas');

        //cek dlm bentuk array
        $petugas = $ambil->row_array();

        //jk kosong
        if (empty($petugas)) {
            return "gagal";
        } else {
            //menyimpan akun pelogin disession sbg bukti jika sudah login
            $this->session->set_userdata("petugas", $petugas);
            return "sukses";
        }
    }
    // tutup fung log

    function ubah_profil($inputan, $id_petugas)
    {
        // jika inputan['password_guru'] kosong
        if (empty($inputan['password_petugas'])) {
            // buang dari array inputan agar tidak di update
            unset($inputan['password_petugas']);
        } else {

            // ambil pass dari inputan
            $pass_inputan = $inputan['password_petugas'];

            // enkripsi pakai SHA1
            $pass_enkrip = sha1($pass_inputan);

            // masukan pass yg sudah di enkrip ke dalam array inputan index password_guru
            $inputan['password_petugas'] = $pass_enkrip;
        }

        // cek apakah ada file yang di upload
        // kalau tidak kosong, jalankan proses upload foto/ubah foto
        if (!empty($_FILES['foto_petugas']['name'])) {

            $config['upload_path'] = './assets/img/petugas/';
            $config['allowed_types'] = 'gif|png|jpg|jpeg';
            $this->upload->initialize($config);

            //proses upload
            $ngupload = $this->upload->do_upload("foto_petugas");

            //mendapatkan nama foto yg diupload
            if ($ngupload) {
                $inputan["foto_petugas"] = $this->upload->data("file_name");

                // cari file lampiran lama 
                $petugas = $this->detail_petugas($id_petugas);
                $foto_petugas_lama = $petugas['foto_petugas'];

                // lokasi file lama 
                $lokasi = FCPATH . "assets/img/petugas/$foto_petugas_lama";
                // cek apakah ada file lama di folder trstb
                if (file_exists($lokasi) and !empty($foto_petugas_lama)) {
                    // kalau ada filenya
                    // hapus file lama dari folder assets/petugas
                    unlink($lokasi);
                }
            }
        }

        $this->db->where('id_petugas', $id_petugas);
        $this->db->update('petugas', $inputan);

        // ambil data petugas yg sedang barusan di ubah
        $petugas = $this->detail_petugas($id_petugas);
        // update session petugas dengan data petugas yang ter update
        $this->session->set_userdata('petugas', $petugas);
    }

    // fung petugas
    function detail_petugas($id_petugas)
    {
        $this->db->where('id_petugas', $id_petugas);
        $ambil = $this->db->get('petugas');
        return $ambil->row_array();
    }

    function tampil_petugas()
    {
        $ambil = $this->db->get('petugas');
        return $ambil->result_array();
    }

    function simpan_petugas($inputan)
    {
        //config library upload
        $config['upload_path'] = './assets/img/petugas/';
        $config['allowed_types'] = 'gif|png|jpg';
        $this->upload->initialize($config);

        // ambil pass dari inputan
        $pass_inputan = $inputan['password_petugas'];

        // enkripsi pakai SHA1
        $pass_enkrip = sha1($pass_inputan);

        // masukan pass yg sudah di enkrip ke dalam array inputan index password_petugas
        $inputan['password_petugas'] = $pass_enkrip;

        //proses upload
        $this->upload->do_upload("foto_petugas");

        //mendapatkan nama foto yg diupload
        $inputan["foto_petugas"] = $this->upload->data("file_name");

        //query insert ke tabel guru
        $this->db->insert('petugas', $inputan);
    }

    function hapus_petugas($id_petugas)
    {
        //hapus data

        //untuk mengapus file photo bth nama file
        //dapatkan dulu data petugas berdasarkan id
        $this->db->where('id_petugas', $id_petugas);
        $ambil = $this->db->get('petugas');
        $petugas = $ambil->row_array();

        $nama_foto = $petugas['foto_petugas'];

        //jk file ada, maka dihapus
        if (!empty($nama_foto) && file_exists(FCPATH . "assets/img/petugas/" . $nama_foto)) {
            unlink(FCPATH . "assets/img/petugas/" . $nama_foto);
        }

        $this->db->where('id_petugas', $id_petugas);
        $this->db->delete('petugas');
    }

    function ubah_petugas($inputan, $id_petugas)
    {
        // jika inputan['password_guru'] kosong
        if (empty($inputan['password_petugas'])) {
            // buang dari array inputan agar tidak di update
            unset($inputan['password_petugas']);
        } else {

            // ambil pass dari inputan
            $pass_inputan = $inputan['password_petugas'];

            // enkripsi pakai SHA1
            $pass_enkrip = sha1($pass_inputan);

            // masukan pass yg sudah di enkrip ke dalam array inputan index password_guru
            $inputan['password_petugas'] = $pass_enkrip;
        }

        // cek apakah ada file yang di upload
        // kalau tidak kosong, jalankan proses upload foto/ubah foto
        if (!empty($_FILES['foto_petugas']['name'])) {

            $config['upload_path'] = './assets/img/petugas/';
            $config['allowed_types'] = 'gif|png|jpg|jpeg';
            $this->upload->initialize($config);

            //proses upload
            $ngupload = $this->upload->do_upload("foto_petugas");

            //mendapatkan nama foto yg diupload
            if ($ngupload) {
                $inputan["foto_petugas"] = $this->upload->data("file_name");

                // cari file lampiran lama 
                $petugas = $this->detail_petugas($id_petugas);
                $foto_petugas_lama = $petugas['foto_petugas'];

                // lokasi file lama 
                $lokasi = FCPATH . "assets/img/petugas/$foto_petugas_lama";
                // cek apakah ada file lama di folder trstb
                if (file_exists($lokasi) and !empty($foto_petugas_lama)) {

                    // kalau ada filenya
                    // hapus file lama dari folder assets/petugas
                    unlink($lokasi);
                }
            }
        }

        $this->db->where('id_petugas', $id_petugas);
        $this->db->update('petugas', $inputan);

        // ambil data petugas yg sedang barusan di ubah
        $petugas = $this->detail_petugas($id_petugas);
    }

    // tutup fung petugas

    // fung guru
    function detail_guru($id_guru)
    {
        $this->db->where('id_guru', $id_guru);
        $ambil = $this->db->get('guru');
        return $ambil->row_array();
    }

    function tampil_guru()
    {
        $ambil = $this->db->get('guru');
        return $ambil->result_array();
    }

    function simpan_guru($inputan)
    {
        //config library upload
        $config['upload_path'] = './assets/img/guru/';
        $config['allowed_types'] = 'gif|png|jpg';
        $this->upload->initialize($config);

        // ambil pass dari inputan
        $pass_inputan = $inputan['password_guru'];

        // enkripsi pakai SHA1
        $pass_enkrip = sha1($pass_inputan);

        // masukan pass yg sudah di enkrip ke dalam array inputan index password_guru
        $inputan['password_guru'] = $pass_enkrip;

        //proses upload
        $this->upload->do_upload("foto_guru");

        //mendapatkan nama foto yg diupload
        $inputan["foto_guru"] = $this->upload->data("file_name");

        //query insert ke tabel guru
        $this->db->insert('guru', $inputan);
    }

    function hapus_guru($id_guru)
    {
        //hapus data

        //untuk mengapus file photo bth nama file
        //dapatkan dulu data guru berdasarkan id
        $this->db->where('id_guru', $id_guru);
        $ambil = $this->db->get('guru');
        $guru = $ambil->row_array();

        $nama_foto = $guru['foto_guru'];

        //jk file ada, maka dihapus
        if (!empty($nama_foto) && file_exists(FCPATH . "assets/img/guru/" . $nama_foto)) {
            unlink(FCPATH . "assets/img/guru/" . $nama_foto);
        }

        $this->db->where('id_guru', $id_guru);
        $this->db->delete('guru');
    }

    function ubah_guru($inputan, $id_guru)
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
    }
    // tutup fung guru

    // fung siswa
    function detail_siswa($id_siswa)
    {
        $this->db->where('id_siswa', $id_siswa);
        $ambil = $this->db->get('siswa');
        return $ambil->row_array();
    }

    function tampil_siswa()
    {
        $ambil = $this->db->get('siswa');
        return $ambil->result_array();
    }

    function simpan_siswa($inputan)
    {
        //config library upload
        $config['upload_path'] = './assets/img/siswa/';
        $config['allowed_types'] = 'gif|png|jpg';
        $this->upload->initialize($config);

        // ambil pass dari inputan
        $pass_inputan = $inputan['password_siswa'];

        // enkripsi pakai SHA1
        $pass_enkrip = sha1($pass_inputan);

        // masukan pass yg sudah di enkrip ke dalam array inputan index password_siswa
        $inputan['password_siswa'] = $pass_enkrip;

        //proses upload
        $this->upload->do_upload("foto_siswa");

        //mendapatkan nama foto yg diupload
        $inputan["foto_siswa"] = $this->upload->data("file_name");

        //query insert ke tabel siswa
        $this->db->insert('siswa', $inputan);
    }

    function hapus_siswa($id_siswa)
    {
        //hapus data

        //untuk mengapus file photo bth nama file
        //dapatkan dulu data siswa berdasarkan id
        $this->db->where('id_siswa', $id_siswa);
        $ambil = $this->db->get('siswa');
        $siswa = $ambil->row_array();

        $nama_foto = $siswa['foto_siswa'];

        //jk file ada, maka dihapus
        if (!empty($nama_foto) && file_exists(FCPATH . "assets/img/siswa/" . $nama_foto)) {
            unlink(FCPATH . "assets/img/siswa/" . $nama_foto);
        }

        $this->db->where('id_siswa', $id_siswa);
        $this->db->delete('siswa');
    }

    function ubah_siswa($inputan, $id_siswa)
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

            if ($ngupload) {
                $inputan["foto_siswa"] = $this->upload->data("file_name");

                // cari file lampiran lama 
                $siswa = $this->detail_siswa($id_siswa);
                $foto_siswa_lama = $siswa['foto_siswa'];

                // lokasi file lama 
                $lokasi = FCPATH . "assets/img/siswa/$foto_siswa_lama";
                // cek apakah ada file lama di folder trstb
                if (file_exists($lokasi) and !empty($foto_siswa_lama)) {

                    unlink($lokasi);
                }
            }
        }

        $this->db->where('id_siswa', $id_siswa);
        $this->db->update('siswa', $inputan);

        $siswa = $this->detail_siswa($id_siswa);
    }
    // tutup fung siswa

    // fung kelas
    function tampil_kelas()
    {
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan', 'left');
        $ambil = $this->db->get('kelas');
        return $ambil->result_array();
    }

    function simpan_kelas($inputan)
    {
        $jenjang = $inputan['jenjang'];
        $id_jurusan = $inputan['id_jurusan'];
        $rombel = $inputan['rombel'];

        $this->db->where('jenjang', $jenjang);
        $this->db->where('id_jurusan', $id_jurusan);
        $this->db->where('rombel', $rombel);
        $kelas = $this->db->get('kelas')->row_array();
        if (empty($kelas)) {
            $this->db->insert('kelas', $inputan);
            return 'sukses';
        } else {
            return 'gagal';
        }
    }

    function hapus_kelas($id_kelas)
    {
        $this->db->where('id_kelas', $id_kelas);
        $this->db->delete('kelas');
    }

    function ubah_kelas($inputan, $id_kelas)
    {
        $this->db->where('kode_kelas', $inputan['kode_kelas']);
        $this->db->where('id_jurusan', $inputan['id_jurusan']);
        $this->db->where('rombel', $inputan['rombel']);

        $kelas = $this->db->get('kelas')->row_array();
        if (empty($kelas)) {
            $this->db->where('id_kelas', $id_kelas);
            $this->db->update('kelas', $inputan);
            return 'sukses';
        } else {
            return 'gagal';
        }
    }
    // tutup fung kelas

    // fung jurusan
    function detail_jurusan($id_jurusan)
    {
        $this->db->where('id_jurusan', $id_jurusan);
        $ambil = $this->db->get('jurusan');
        return $ambil->row_array();
    }
    function tampil_jurusan()
    {
        $ambil = $this->db->get('jurusan');
        return $ambil->result_array();
    }

    function simpan_jurusan($inputan)
    {
        $this->db->insert('jurusan', $inputan);
    }

    function hapus_jurusan($id_jurusan)
    {
        $this->db->where('id_jurusan', $id_jurusan);
        $this->db->delete('jurusan');
    }

    function ubah_jurusan($inputan, $id_jurusan)
    {
        $this->db->where('id_jurusan', $id_jurusan);
        $this->db->update('jurusan', $inputan);
    }
    // tutup fung jurusan

    // fung mapel
    function detail_mapel($id_mapel)
    {
        $this->db->where('id_mapel', $id_mapel);
        $ambil = $this->db->get('mapel');
        return $ambil->row_array();
    }
    function tampil_mapel()
    {
        $ambil = $this->db->get('mapel');
        return $ambil->result_array();
    }

    function simpan_mapel($inputan)
    {
        $this->db->insert('mapel', $inputan);
    }

    function hapus_mapel($id_mapel)
    {
        $this->db->where('id_mapel', $id_mapel);
        $this->db->delete('mapel');
    }

    function ubah_mapel($inputan, $id_mapel)
    {
        $this->db->where('id_mapel', $id_mapel);
        $this->db->update('mapel', $inputan);
    }
    // tutup fung mapel

    // fung tahun ajaran
    function tampil_tahunajaran()
    {
        $ambil = $this->db->get('th_ajaran');
        return $ambil->result_array();
    }

    function simpan_tahunajaran($inputan)
    {
        $tahun_ajaran = $inputan['tahun_ajaran'];
        $status_th_ajaran = $inputan['status_th_ajaran'];

        $this->db->where('tahun_ajaran', $tahun_ajaran);
        $this->db->where('status_th_ajaran', $status_th_ajaran);
        $th_ajaran = $this->db->get('th_ajaran')->row_array();
        if (empty($th_ajaran)) {
            $this->db->insert('th_ajaran', $inputan);
            return 'sukses';
        } else {
            return 'gagal';
        }
    }

    function hapus_tahunajaran($id_tahun)
    {
        $this->db->where('id_tahun', $id_tahun);
        $this->db->delete('th_ajaran');
    }

    function ubah_tahunajaran($inputan, $id_tahun)
    {
        $this->db->where('tahun_ajaran', $inputan['tahun_ajaran']);
        $this->db->where('status_th_ajaran', $inputan['status_th_ajaran']);

        $th_ajaran = $this->db->get('th_ajaran')->row_array();
        if (empty($th_ajaran)) {
            $this->db->where('id_tahun', $id_tahun);
            $this->db->update('th_ajaran', $inputan);
            return 'sukses';
        } else {
            return 'gagal';
        }
    }
    // tutup fung tahun ajaran


    // data perkelasan
    function tampil_perkelasan()
    {
        //jk sudah set th
        if ($this->session->userdata('id_tahun')) {
            $id_tahun = $this->session->userdata('id_tahun');
            $this->db->where('perkelasan.id_tahun', $id_tahun);
        }

        $this->db->join('kelas', 'kelas.id_kelas = perkelasan.id_kelas', 'left');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan', 'left');
        $this->db->join('th_ajaran', 'th_ajaran.id_tahun = perkelasan.id_tahun', 'left');
        $query = $this->db->get('perkelasan');

        $hasil = $query->result_array();

        return $hasil;
    }

    function simpan_perkelasan($inputan)
    {
        $id_tahun = $inputan['id_tahun'];
        $id_kelas = $inputan['id_kelas'];
        $this->db->where('id_tahun', $id_tahun);
        $this->db->where('id_kelas', $id_kelas);
        $perkelasan = $this->db->get('perkelasan')->row_array();
        if (empty($perkelasan)) {
            $this->db->insert('perkelasan', $inputan);
            return 'sukses';
        } else {
            return 'gagal';
        }
    }

    function simpan_detail_perkelasan($id_perkelasan, $siswas)
    {
        foreach ($siswas as $key => $id_siswa) {
            $mlebu['id_perkelasan'] = $id_perkelasan;
            $mlebu['id_siswa'] = $id_siswa;
            $this->db->insert('perkelasan_detail', $mlebu);
        }
    }


    function ubah_perkelasan($inputan, $id_perkelasan)
    {
        $this->db->where('id_kelas', $inputan['id_kelas']);
        $this->db->where('id_tahun', $inputan['id_tahun']);

        $perkelasan = $this->db->get('perkelasan')->row_array();
        if (empty($perkelasan)) {
            $this->db->where('id_perkelasan', $id_perkelasan);
            $this->db->update('perkelasan', $inputan);
            return 'sukses';
        } else {
            return 'gagal';
        }
    }


    function hapus_perkelasan($id_perkelasan)
    {
        $this->db->where('id_perkelasan', $id_perkelasan);
        $this->db->delete('perkelasan');
    }

    function tampil_perkelasan_detail()
    {

        $this->db->join('kelas', 'kelas.id_kelas = perkelasan.id_kelas', 'left');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan', 'left');
        $this->db->join('th_ajaran', 'th_ajaran.id_tahun = perkelasan.id_tahun', 'left');
        $query = $this->db->get('perkelasan');

        $hasil = $query->result_array();

        return $hasil;
    }

    function hapus_detailperkelasan($id_perkelasan_detail)
    {
        $this->db->where('id_perkelasan_detail', $id_perkelasan_detail);
        $this->db->delete('perkelasan_detail');
    }

    function detail_perkelasan($id_perkelasan)
    {
        $this->db->where('id_perkelasan', $id_perkelasan);
        $this->db->join('th_ajaran', 'perkelasan.id_tahun = th_ajaran.id_tahun', 'left');
        $this->db->join('kelas', 'perkelasan.id_kelas = kelas.id_kelas', 'left');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan', 'left');
        $ambil = $this->db->get('perkelasan');
        $detail = $ambil->row_array();
        return $detail;
    }

    function siswa_perkelasan($id_perkelasan)
    {
        $this->db->where('id_perkelasan', $id_perkelasan);
        $this->db->join('siswa', 'perkelasan_detail.id_siswa= siswa.id_siswa', 'left');
        $ambil = $this->db->get('perkelasan_detail');
        $siswa = $ambil->result_array();
        return $siswa;
    }

    function pindah_perkelasan($inputan)
    {
        $parasiswa = $inputan['id_siswa'];
        $id_perkelasan = $inputan['id_perkelasan'];
        foreach ($parasiswa as $key => $id_siswa) {
            //cek diperkelasan itu sudah ada siswa itu atau blm
            $this->db->where('id_siswa', $id_siswa);
            $this->db->where('id_perkelasan', $id_perkelasan);
            $cek = $this->db->get('perkelasan_detail');
            $keberadaan = $cek->row_array();
            if (empty($keberadaan)) {
                $masuk['id_siswa'] = $id_siswa;
                $masuk['id_perkelasan'] = $id_perkelasan;
                $this->db->insert('perkelasan_detail', $masuk);
            }
        }
    }

    function tampil_siswa_tanpa_kelas()
    {
        $ambil = $this->db->query('SELECT * FROM siswa
        WHERE id_siswa NOT IN(SELECT id_siswa FROM perkelasan_detail) ORDER BY nis ASC');
        return $ambil->result_array();
    }

    //tutup fung perkelasan

    // data mengajar
    function tampil_mengajar()
    {

        //jk sudah set th
        if ($this->session->userdata('id_tahun')) {
            $id_tahun = $this->session->userdata('id_tahun');
            $this->db->where('perkelasan.id_tahun', $id_tahun);
        }
        if ($this->session->userdata('semester')) {
            $semester = $this->session->userdata('semester');
            $this->db->where('mengajar.semester', $semester);
        }

        $this->db->join('guru', 'guru.id_guru = mengajar.id_guru', 'left');
        $this->db->join('mapel', 'mapel.id_mapel = mengajar.id_mapel', 'left');
        $this->db->join('perkelasan', 'perkelasan.id_perkelasan = mengajar.id_perkelasan', 'left');
        $this->db->join('th_ajaran', 'th_ajaran.id_tahun = perkelasan.id_tahun', 'left');
        $this->db->join('kelas', 'kelas.id_kelas = perkelasan.id_kelas', 'left');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan', 'left');
        $query = $this->db->get('mengajar');

        $hasil = $query->result_array();

        return $hasil;
    }

    function simpan_mengajar($inputan)
    {
        $id_guru = $inputan['id_guru'];
        $id_mapel = $inputan['id_mapel'];
        $id_perkelasan = $inputan['id_perkelasan'];
        $this->db->where('id_guru', $id_guru);
        $this->db->where('id_mapel', $id_mapel);
        $this->db->where('id_perkelasan', $id_perkelasan);
        $mengajar = $this->db->get('mengajar')->row_array();
        if (empty($mengajar)) {
            $this->db->insert('mengajar', $inputan);
            return 'sukses';
        } else {
            return 'gagal';
        }
    }

    function ubah_mengajar($inputan, $id_mengajar)
    {
        $this->db->where('id_perkelasan', $inputan['id_perkelasan']);
        $this->db->where('semester', $inputan['semester']);
        $mengajar = $this->db->get('mengajar')->row_array();
        if (empty($mengajar)) {
            $this->db->where('id_mengajar', $id_mengajar);
            $this->db->update('mengajar', $inputan);
            return 'sukses';
        } else {
            return "gagal";
        }
    }
    function hapus_mengajar($id_mengajar)
    {
        $this->db->where('id_mengajar', $id_mengajar);
        $this->db->delete('mengajar');
    }
    //tutup fung mengajar


    // hitung pada beranda
    function hitung_guru()
    {
        if ($this->session->userdata('id_tahun')) {
            $id_tahun = $this->session->userdata('id_tahun');
            $this->db->where('perkelasan.id_tahun', $id_tahun);
        }

        $this->db->join('perkelasan', 'perkelasan.id_perkelasan = mengajar.id_perkelasan', 'left');
        $this->db->select('id_guru');
        $this->db->from('mengajar');
        $this->db->group_by('mengajar.id_guru');

        $query = $this->db->get();
        $total = $query->num_rows();
        return $total;
    }
    function hitung_siswa()
    {
        if ($this->session->userdata('id_tahun')) {
            $id_tahun = $this->session->userdata('id_tahun');
            $this->db->where('perkelasan.id_tahun', $id_tahun);
        }

        $this->db->join('perkelasan', 'perkelasan.id_perkelasan = perkelasan_detail.id_perkelasan', 'left');
        $this->db->select('id_siswa');
        $this->db->group_by('perkelasan_detail.id_siswa');
        $this->db->from('perkelasan_detail');
        $query = $this->db->get();
        $total = $query->num_rows();
        return $total;
    }
    function hitung_jurusan()
    {
        $this->db->select('id_jurusan');
        $this->db->from('jurusan');
        $query = $this->db->get();
        $total = $query->num_rows();
        return $total;
    }
    function hitung_kelas()
    {
        if ($this->session->userdata('id_tahun')) {
            $id_tahun = $this->session->userdata('id_tahun');
            $this->db->where('perkelasan.id_tahun', $id_tahun);
        }
        $this->db->select('id_perkelasan');
        $this->db->from('perkelasan');
        $this->db->group_by('perkelasan.id_perkelasan');

        $query = $this->db->get();
        $total = $query->num_rows();
        return $total;
    }
}

/* End of file Mpetugas.php */
