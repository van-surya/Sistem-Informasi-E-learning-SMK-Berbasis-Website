<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> <?= $title; ?></li>
        </ol>
    </nav>
    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <h4 class="m-0 font-weight-bold text-success">
                        <?= $title; ?>
                    </h4>
                </div>
                <!-- trigger modal tambah-->
                <div class="col-md-6 text-md-right mt-2 mt-md-0">
                    <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah_data">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i></span>
                        <span class="text">Tambah Data</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($siswa as $key => $value) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $value['nis']; ?></td>
                                <td><?= substr($value['nama_siswa'], 0, 20); ?></td>
                                <td><?= substr($value['email_siswa'], 0, 20); ?></td>
                                <td><?= $value['tgl_lahir_siswa']; ?></td>
                                <td><?= $value['jk_siswa']; ?></td>
                                <td><?= $value['agama_siswa']; ?></td>
                                <td>
                                    <div class="text-center">
                                        <!-- Button trigger -->
                                        <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#ubahdata-<?= $value['id_siswa'] ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                            <span class="text">Ubah</span>
                                        </button>
                                        <a href="" class="btn btn-danger btn-icon-split btn-sm btn-hapus" idnya="<?= $value['id_siswa']; ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Ubah-->
                            <div class="modal fade modal-ubah" ids="<?= $value['id_siswa']; ?>" id="ubahdata-<?= $value['id_siswa'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <?= form_open_multipart('petugas/datasiswa/ubah/' . $value['id_siswa']) ?>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                    <label>Nis</label>
                                                    <input type="text" class="form-control" id="nis" name="nis" value="<?= $value["nis"]; ?>">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                    <label>Nama</label>
                                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $value["nama_siswa"]; ?>">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" id="email_siswa" name="email_siswa" value="<?= $value["email_siswa"]; ?>">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" id="password_siswa" name="password_siswa">
                                                    <div class="text-danger small">Kosongkan jika tidak diubah</div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                    <label>Jenis Kelamin</label>
                                                    <div class="input-group mb-2">
                                                        <label class="form-control">
                                                            <input type="radio" name="jk_siswa" value="laki-Laki" <?php if ($value['jk_siswa'] == 'Laki-Laki') {
                                                                                                                        echo "checked";
                                                                                                                    } ?>> Laki-Laki
                                                        </label>
                                                        <label class="form-control">
                                                            <input type="radio" name="jk_siswa" value="Perempuan" <?php if ($value['jk_siswa'] == 'Perempuan') {
                                                                                                                        echo "checked";
                                                                                                                    } ?>> Perempuan
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-6 mb-2">
                                                    <label>Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="tgl_lahir_siswa" name="tgl_lahir_siswa" value="<?= $value["tgl_lahir_siswa"]; ?>">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                    <label>Agama</label>
                                                    <select class="custom-select" name="agama_siswa">
                                                        <option value="Islam" <?php if ($value['agama_siswa'] == 'Islam') {
                                                                                    echo "selected";
                                                                                } ?>>Islam</option>
                                                        <option value="Kristen" <?php if ($value['agama_siswa'] == 'Kristen') {
                                                                                    echo "selected";
                                                                                } ?>>Kristen</option>
                                                        <option value="Katolik" <?php if ($value['agama_siswa'] == 'Katolik') {
                                                                                    echo "selected";
                                                                                } ?>>Katolik</option>
                                                        <option value="Hindu" <?php if ($value['agama_siswa'] == 'Hindu') {
                                                                                    echo "selected";
                                                                                } ?>>Hindu</option>
                                                        <option value="Buddha" <?php if ($value['agama_siswa'] == 'Buddha') {
                                                                                    echo "selected";
                                                                                } ?>>Buddha</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label>Alamat</label>
                                                    <textarea type="textarea" class="form-control" rows="2" id="alamat_siswa" name="alamat_siswa"><?= $value["alamat_siswa"]; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12 border bg-light">
                                                <div class="col-12 text-center py-2">
                                                    <figure class="figure">
                                                        <img src="<?= base_url("assets/img/siswa/" . $value["foto_siswa"]); ?>" class="figure-img img-fluid rounded" width="100">
                                                    </figure>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Ubah Foto</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="foto_siswa" id="foto_siswa" value="<?= $value["foto_siswa"]; ?>">
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
                            <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



<!-- Modal Tambah -->
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if ($this->session->flashdata('errors_tambah')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $this->session->flashdata('errors_tambah') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif ?>
                <?= form_open_multipart('petugas/datasiswa/tambah') ?>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 md-2">
                        <label>Nis</label>
                        <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukan Nis">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 md-2">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukan Nama">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 md-2">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email_siswa" name="email_siswa" placeholder="Masukan Email">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 md-2">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password_siswa" name="password_siswa" placeholder="Masukan Password">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 md-2">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir_siswa" name="tgl_lahir_siswa">
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 md-2">
                        <label>Jenis Kelamin</label>
                        <div class="input-group mb-2">
                            <label class="form-control"><input type="radio" name="jk_siswa" value="laki-Laki"> Laki-Laki</label>
                            <label class="form-control"><input type="radio" name="jk_siswa" value="Perempuan"> Perempuan</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 md-2">
                        <label>Agama</label>
                        <select class="custom-select" name="agama_siswa">
                            <option>--Pilih Agama--</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                        </select>
                    </div>
                    <div class="col-12 md-2">
                        <label>Alamat</label>
                        <textarea type="textarea" class="form-control" id="alamat_siswa" name="alamat_siswa" placeholder="Masukan Alamat"></textarea>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6 mb-3">
                    <label>Foto</label>
                    <div class="input-group mb-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto_siswa" id="foto_siswa">
                            <label class="custom-file-label">Pilih file</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <?=
                    form_close();
                ?>
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
<!-- hapus -->
<script>
    $(document).ready(function() {
        $(".btn-hapus").on("click", function(e) {
            e.preventDefault();
            var idnya = $(this).attr("idnya");
            swal({
                    title: "Apakah kamu yakin ?",
                    text: "untuk menghapus data ini",
                    icon: "warning",
                    buttons: ["Batal", "Hapus Data!"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        //disini ajax hapus data
                        $.ajax({
                            type: 'post',
                            url: "<?= base_url("petugas/datasiswa/hapus_siswa"); ?>",
                            data: 'id=' + idnya,
                            success: function() {
                                swal("Data berhasil terhapus!", {
                                    icon: "success",
                                    button: true
                                }).then((oke) => {
                                    if (oke) {
                                        location = "<?= base_url("petugas/datasiswa/"); ?>"
                                    }
                                });
                            }
                        })
                    }
                });
        })
    })
</script>
<!-- jk ada flashdata error tambah -->
<?php if ($this->session->flashdata('errors_tambah')) : ?>
    <script>
        $(document).ready(function() {
            $("#tambah_data").modal("show");
        })
    </script>
<?php endif; ?>
<!-- jk modal ubah diclick  -->
<script>
    $(document).ready(function() {
        $(".modal-ubah").on("shown.bs.modal", function() {
            var ids = $(this).attr("ids");
            $.ajax({
                type: 'post',
                url: "<?= base_url("petugas/datasiswa/terpilih"); ?>",
                data: 'id=' + ids,
                success: function() {}
            })
        })
    })
</script>
<!-- jk ada flashdata error ubah -->
<?php if ($this->session->flashdata('errors_ubah')) : ?>
    <script>
        $(document).ready(function() {
            $("#ubahdata-<?= $this->session->userdata("siswa_terpilih"); ?>").modal("show");
        })
    </script>
<?php endif; ?>