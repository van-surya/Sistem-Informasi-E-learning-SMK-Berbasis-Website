<!-- Begin Page Content -->
<div class="container-fluid">
    <!--breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>
    <!-- notifikasi --><?php if (!empty($notifikasi)) : ?>
        <div class="card shadow mb-4">
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-0 font-weight-bold text-info">Notifikasi Topik</h6>
            </a>
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <?php foreach ($notifikasi as $key => $value) : ?>
                        <?php
                                $id_topik = $value['id_topik'];
                        ?>
                        <a class="dropdown-item d-flex align-items-center" href="<?= base_url("/siswa/topik/detail/$id_topik"); ?>">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-bell text-white"></i>
                                </div>
                            </div>
                            <div>
                                <span class="font-weight-bold">
                                    Mata Pelajaran : <?= $value['nama_mapel']; ?> <br>
                                    Topik : <?= $value['judul_topik']; ?> <br>
                                </span>
                                <div class="small text-gray-500">
                                    Diberikan <?= tanggal_waktu($value['topik_mulai']); ?> |
                                    Berakhir <?= tanggal_waktu($value['topik_berakhir']); ?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- profile -->
    <div class="card shadow mb-3 " style="max-width: unset;">
        <div class="card-header">
            <h6 class="m-1 font-weight-bold text-info">Profile Anda</h6>
        </div>
        <div class="row no-gutters m-2 ">
            <?php $siswa = $this->session->userdata('siswa') ?>
            <div class="col-md-4 align-self-center text-center">
                <?php if (!empty($siswa["foto_siswa"])) : ?>
                    <img src="<?= base_url("assets/img/siswa/" . $siswa["foto_siswa"]); ?>" class="img-fluid" width="225px"> </div>
        <?php else : ?>
            <img src="<?= base_url("assets/img/siswa/avatar.jpg"); ?>" class="img-fluid" width="225px"> </div>
    <?php endif; ?>
    <div class="col-md-8">
        <!-- tampilkan data pelogin  -->
        <div class="card-body">
            <table class="table table-borderless font-weight-bold text-secondary">
                <tr>
                    <td>Kelas</td>
                    <td><?php if (!empty($kelas)) : ?>
                            <?= $kelas['jenjang'] . $kelas['singkatan_jurusan'] . $kelas['rombel']; ?>
                        <?php else : ?>
                            Belum terdaftar dikelas
                        <?php endif; ?></td>
                </tr>
                <tr>
                    <td>Jurusan</td>
                    <td><?php if (!empty($kelas)) : ?>
                            <?= $kelas['nama_jurusan']; ?>
                        <?php else : ?>
                            Belum terdaftar jurusan</td>
                <?php endif; ?>
                </tr>
                <tr>
                    <td>Nis</td>
                    <td><?= $siswa['nis']; ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><?= $siswa['nama_siswa']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= $siswa['email_siswa']; ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td><?= $siswa['agama_siswa']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td><?= $siswa['tgl_lahir_siswa']; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td><?= $siswa['jk_siswa']; ?></td>
                </tr>
            </table>
        </div>
    </div>
    </div>
    <div class="card-footer text-right py-2">
        <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#ubahprofil-<?= $siswa['id_siswa'] ?>">
            <span class="icon text-white-50">
                <i class="fas fa-edit"></i>
            </span>
            <span class="text">Ubah Profile</span>
        </button>
    </div>
</div>
</div>





</div>
<!-- /.container-fluid -->

<!-- Modal Ubah-->
<div class="modal fade modal-ubah" idp="<?= $siswa['id_siswa']; ?>" id="ubahprofil-<?= $siswa['id_siswa'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if ($this->session->flashdata('errors_ubah')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $this->session->flashdata('errors_ubah') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif ?>
                <?= form_open_multipart('siswa/beranda/ubahprofil/' . $siswa['id_siswa']) ?>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label>Nis</label>
                        <input type="text" class="form-control" id="nis" name="nis" value="<?= $siswa["nis"]; ?>">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $siswa["nama_siswa"]; ?>">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email_siswa" name="email_siswa" value="<?= $siswa["email_siswa"]; ?>">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password_siswa" name="password_siswa">
                        <div class="text-danger small">Kosongkan jika tidak diubah</div>
                    </div>
                    <div class="col-sm-12 col-md-7 col-lg-6">
                        <label>Jenis Kelamin</label>
                        <div class="input-group mb-2">
                            <label class="form-control">
                                <input type="radio" name="jk_siswa" value="laki-Laki" <?php if ($siswa['jk_siswa'] == 'Laki-Laki') {
                                                                                            echo "checked";
                                                                                        } ?>> Laki-Laki
                            </label>
                            <label class="form-control">
                                <input type="radio" name="jk_siswa" value="Perempuan" <?php if ($siswa['jk_siswa'] == 'Perempuan') {
                                                                                            echo "checked";
                                                                                        } ?>> Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-5 col-lg-6">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir_siswa" name="tgl_lahir_siswa" value="<?= $siswa["tgl_lahir_siswa"]; ?>">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <label>Agama</label>
                        <select class="custom-select" name="agama_siswa">
                            <option value="Islam" <?php if ($siswa['agama_siswa'] == 'Islam') {
                                                        echo "selected";
                                                    } ?>>Islam</option>
                            <option value="Kristen" <?php if ($siswa['agama_siswa'] == 'Kristen') {
                                                        echo "selected";
                                                    } ?>>Kristen</option>
                            <option value="Katolik" <?php if ($siswa['agama_siswa'] == 'Katolik') {
                                                        echo "selected";
                                                    } ?>>Katolik</option>
                            <option value="Hindu" <?php if ($siswa['agama_siswa'] == 'Hindu') {
                                                        echo "selected";
                                                    } ?>>Hindu</option>
                            <option value="Buddha" <?php if ($siswa['agama_siswa'] == 'Buddha') {
                                                        echo "selected";
                                                    } ?>>Buddha</option>
                        </select>
                    </div>
                    <div class="col-12 m-2">
                        <label>Alamat</label>
                        <textarea type="textarea" class="form-control" rows="3" id="alamat_siswa" name="alamat_siswa"><?= $siswa["alamat_siswa"]; ?></textarea>
                    </div>
                </div>
                <div class="col-12 border bg-light">
                    <div class="col-12 text-center py-2">
                        <figure class="figure">
                            <img src="<?= base_url("assets/img/siswa/" . $siswa["foto_siswa"]); ?>" class="figure-img img-fluid rounded" width="100">
                        </figure>
                    </div>
                    <div class="col-12 text-center">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ubah Foto</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="foto_siswa" id="foto_siswa" value="<?= $siswa["foto_siswa"]; ?>">
                                <label class="custom-file-label">Pilih file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                    <?=
                        form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- tutup modal ubah  -->
    <!-- pesan  -->
    <?php if ($this->session->flashdata('pesan')) : ?>
        <script>
            swal({
                icon: "success",
                title: "Berhasil!",
                text: "<?= $this->session->flashdata('pesan') ?>",
                button: false,
                timer: 2000,
            });
        </script>
    <?php endif; ?>

    <!-- jk modal ubah diclick  -->
    <script>
        $(document).ready(function() {
            $(".modal-ubah").on("shown.bs.modal", function() {
                var idp = $(this).attr("idp");
                $.ajax({
                    type: 'post',
                    url: "<?= base_url("siswa/beranda/terpilih"); ?>",
                    data: 'id=' + idp,
                    success: function() {

                    }
                })
            })
        })
    </script>
    <!-- jk ada flashdata error ubah -->
    <?php if ($this->session->flashdata('errors_ubah')) : ?>
        <script>
            $(document).ready(function() {
                $("#ubahprofil-<?= $this->session->userdata("profile_terpilih"); ?>").modal("show");
            })
        </script>
    <?php endif; ?>