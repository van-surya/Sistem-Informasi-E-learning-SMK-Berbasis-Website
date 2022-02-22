<!-- Begin Page Content -->
<div class="container-fluid">
    <!--breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 font-weight-bold text-success"><?= $title; ?></h1>

    <!-- notifikasi  -->
    <?php if (!empty($notifikasi)) : ?>
        <div class="card shadow mb-3 ">
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-1 font-weight-bold text-success">Notifikasi Jawaban</h6>
            </a>
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <div class="row col-sm-12 col-md-12 col-lg-12">
                        <?php foreach ($notifikasi as $key => $value) : ?>
                            <?php
                            $id_topik = $value['id_topik'];
                            $id_tugas = $value['id_tugas'];
                            ?>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url("guru/tugas/detail/$id_topik/$id_tugas"); ?>">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-bell text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Dikirim :<?= tanggal($value['tgl_jawaban']) . " /Jam " . jammenit($value['tgl_jawaban']); ?></div>
                                    <p><strong>Mata Pelajaran : </strong><?= substr($value['nama_mapel'], 0, 100); ?><br>
                                        <strong>Topik : </strong><?= substr($value['judul_topik'], 0, 100); ?><br>
                                        <strong>Tugas : </strong><?= substr($value['judul_tugas'], 0, 100); ?><br>
                                        <strong>Nama : </strong><?= substr($value['nama_siswa'], 0, 100); ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- profile -->
    <div class="card shadow mb-3 ">
        <div class="card-header">
            <h6 class="m-1 font-weight-bold text-success">Profile Anda</h6>
        </div>
        <div class="row no-gutters m-2 ">
            <?php $guru = $this->session->userdata('guru') ?>
            <div class="col-md-4 align-self-center text-center">
                <?php if (!empty($guru["foto_guru"])) : ?>
                    <img src="<?= base_url("assets/img/guru/" . $guru["foto_guru"]); ?>" class="img-fluid" width="225px">
                <?php else : ?>
                    <img src="<?= base_url("assets/img/avatar.jpg"); ?>" class="img-fluid" width="225px">
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <!-- tampilkan data pelogin  -->
                <div class="card-body">
                    <table class="table table-borderless font-weight-bold text-secondary">
                        <tr>
                            <td>Nip</td>
                            <td><?= $guru["nip_guru"]; ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><?= $guru["nama_guru"]; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?= $guru["email_guru"]; ?></td>
                        </tr>
                        <tr>
                            <td>Telephone</td>
                            <td><?= $guru["telephone_guru"]; ?></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td><?= $guru["agama_guru"]; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td><?= tanggal($guru["tgl_lahir_guru"]); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td><?= $guru["jk_guru"]; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-right py-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#ubahdata-<?= $guru['id_guru'] ?>">
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

<!-- Modal -->
<div class="modal fade modal-ubah" idp="<?= $guru['id_guru']; ?>" id="ubahdata-<?= $guru['id_guru'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Profile Anda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?php if ($this->session->flashdata('errors_ubah')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= $this->session->flashdata('errors_ubah') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif ?>
                    <?= form_open_multipart('guru/beranda/ubahprofil/' . $guru['id_guru']) ?>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <label>Nip</label>
                            <input type="text" class="form-control" id="nip_guru" name="nip_guru" value="<?= $guru["nip_guru"]; ?>">
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?= $guru["nama_guru"]; ?>">
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <label>Telephone</label>
                            <input type="text" class="form-control" id="telephone_guru" name="telephone_guru" value="<?= $guru["telephone_guru"]; ?>">
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email_guru" name="email_guru" value="<?= $guru["email_guru"]; ?>">
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-6">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password_guru" name="password_guru">
                            <div class="text-danger small">Kosongkan jika tidak diubah</div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-6">
                            <label>Jenis Kelamin</label>
                            <div class="input-group mb-2">
                                <label class="form-control">
                                    <input type="radio" name="jk_guru" value="laki-Laki" <?php if ($guru['jk_guru'] == 'Laki-Laki') {
                                                                                                echo "checked";
                                                                                            } ?>> Laki-Laki
                                </label>
                                <label class="form-control">
                                    <input type="radio" name="jk_guru" value="Perempuan" <?php if ($guru['jk_guru'] == 'Perempuan') {
                                                                                                echo "checked";
                                                                                            } ?>> Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir_guru" name="tgl_lahir_guru" value="<?= $guru["tgl_lahir_guru"]; ?>">
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <label>Agama</label>
                            <select class="custom-select" name="agama_guru">
                                <option value="Islam" <?php if ($guru['agama_guru'] == 'Islam') {
                                                            echo "selected";
                                                        } ?>>Islam</option>
                                <option value="Kristen" <?php if ($guru['agama_guru'] == 'Kristen') {
                                                            echo "selected";
                                                        } ?>>Kristen</option>
                                <option value="Katolik" <?php if ($guru['agama_guru'] == 'Katolik') {
                                                            echo "selected";
                                                        } ?>>Katolik</option>
                                <option value="Hindu" <?php if ($guru['agama_guru'] == 'Hindu') {
                                                            echo "selected";
                                                        } ?>>Hindu</option>
                                <option value="Buddha" <?php if ($guru['agama_guru'] == 'Buddha') {
                                                            echo "selected";
                                                        } ?>>Buddha</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label>Alamat</label>
                            <textarea type="textarea" class="form-control" rows="2" id="alamat_guru" name="alamat_guru"><?= $guru["alamat_guru"]; ?></textarea>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md-12 col-sm-12 col-lg-6">
                            <label>Foto Lama</label>
                            <img src="<?= base_url("assets/img/guru/" . $guru['foto_guru']) ?>" width="100">
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-6">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="foto_guru" id="foto_guru">
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
    </div>
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
                    url: "<?= base_url("guru/beranda/terpilih"); ?>",
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
                $("#ubahdata-<?= $this->session->userdata("profile_terpilih"); ?>").modal("show");
            })
        </script>
    <?php endif; ?>