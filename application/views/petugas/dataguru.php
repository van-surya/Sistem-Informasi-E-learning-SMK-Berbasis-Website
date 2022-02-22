<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>
    <!-- Card-->
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
                            <i class="fas fa-plus"></i></span>
                        <span class="text">Tambah Data</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- tabel -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nip</th>
                                <th>Nama</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($guru as $key => $value) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $value['nip_guru']; ?></td>
                                    <td><?= substr($value['nama_guru'], 0, 20); ?></td>
                                    <td><?= $value['telephone_guru']; ?></td>
                                    <td><?= substr($value['email_guru'], 0, 30); ?></td>
                                    <td><?= $value['jk_guru']; ?></td>
                                    <td>
                                        <div class="text-center">
                                            <!-- Button trigger -->
                                            <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#ubahdata-<?= $value['id_guru'] ?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span class="text">Ubah</span>
                                            </button>
                                            <a href="" class="btn btn-danger btn-icon-split btn-sm btn-hapus" idnya="<?= $value['id_guru']; ?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Hapus</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal Ubah-->
                                <div class="modal fade modal-ubah" idp="<?= $value['id_guru']; ?>" id="ubahdata-<?= $value['id_guru'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <?= form_open_multipart('petugas/dataguru/ubah/' . $value['id_guru']) ?>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                        <label>Nip</label>
                                                        <input type="text" class="form-control" id="nip_guru" name="nip_guru" value="<?= $value["nip_guru"]; ?>">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?= $value["nama_guru"]; ?>">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                        <label>Telephone</label>
                                                        <input type="text" class="form-control" id="telephone_guru" name="telephone_guru" value="<?= $value["telephone_guru"]; ?>">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" id="email_guru" name="email_guru" value="<?= $value["email_guru"]; ?>">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" id="password_guru" name="password_guru">
                                                        <div class="text-danger small">Kosongkan jika tidak diubah</div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-6 mb-2">
                                                        <label>Jenis Kelamin</label>
                                                        <div class="input-group mb-2">
                                                            <label class="form-control">
                                                                <input type="radio" name="jk_guru" value="laki-Laki" <?php if ($value['jk_guru'] == 'Laki-Laki') {
                                                                                                                            echo "checked";
                                                                                                                        } ?>> Laki-Laki
                                                            </label>
                                                            <label class="form-control">
                                                                <input type="radio" name="jk_guru" value="Perempuan" <?php if ($value['jk_guru'] == 'Perempuan') {
                                                                                                                            echo "checked";
                                                                                                                        } ?>> Perempuan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                        <label>Tanggal Lahir</label>
                                                        <input type="date" class="form-control" id="tgl_lahir_guru" name="tgl_lahir_guru" value="<?= $value["tgl_lahir_guru"]; ?>">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                        <label>Agama</label>
                                                        <select class="custom-select" name="agama_guru">
                                                            <option value="Islam" <?php if ($value['agama_guru'] == 'Islam') {
                                                                                        echo "selected";
                                                                                    } ?>>Islam</option>
                                                            <option value="Kristen" <?php if ($value['agama_guru'] == 'Kristen') {
                                                                                        echo "selected";
                                                                                    } ?>>Kristen</option>
                                                            <option value="Katolik" <?php if ($value['agama_guru'] == 'Katolik') {
                                                                                        echo "selected";
                                                                                    } ?>>Katolik</option>
                                                            <option value="Hindu" <?php if ($value['agama_guru'] == 'Hindu') {
                                                                                        echo "selected";
                                                                                    } ?>>Hindu</option>
                                                            <option value="Buddha" <?php if ($value['agama_guru'] == 'Buddha') {
                                                                                        echo "selected";
                                                                                    } ?>>Buddha</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <label>Alamat</label>
                                                        <textarea type="textarea" class="form-control" rows="2" id="alamat_guru" name="alamat_guru"><?= $value["alamat_guru"]; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 border bg-light">
                                                    <div class="col-12 text-center py-2">
                                                        <figure class="figure">
                                                            <img src="<?= base_url("assets/img/guru/" . $value["foto_guru"]); ?>" class="figure-img img-fluid rounded" width="100">
                                                        </figure>
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Ubah Foto</span>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="foto_guru" id="foto_guru" value="<?= $value["foto_guru"]; ?>">
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
                <?= form_open_multipart('petugas/dataguru/tambah') ?>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                        <label>Nip</label>
                        <input type="text" class="form-control" id="nip_guru" name="nip_guru" placeholder="Masukan NIP">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama_guru" name="nama_guru" placeholder="Masukan Nama">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                        <label>Telephone</label>
                        <input type="text" class="form-control" id="telephone_guru" name="telephone_guru" placeholder="Masukan Telephone">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email_guru" name="email_guru" placeholder="Masukan Email">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password_guru" name="password_guru" placeholder="Masukan Password">
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 mb-2">
                        <label>Jenis Kelamin</label>
                        <div class="input-group mb-2">
                            <label class="form-control"><input type="radio" name="jk_guru" value="laki-Laki"> Laki-Laki</label>
                            <label class="form-control"><input type="radio" name="jk_guru" value="Perempuan"> Perempuan</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir_guru" name="tgl_lahir_guru">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                        <label>Agama</label>
                        <select class="custom-select" name="agama_guru">
                            <option>--Pilih Agama--</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                        </select>
                    </div>
                    <div class="col-12 mb-2">
                        <label>Alamat</label>
                        <textarea type="textarea" class="form-control" rows="2" id="alamat_guru" name="alamat_guru" placeholder="Masukan Alamat"></textarea>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6 mb-3">
                    <label>Foto</label>
                    <div class="input-group mb-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto_guru" id="foto_guru">
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
                            url: "<?= base_url("petugas/dataguru/hapus_guru"); ?>",
                            data: 'id=' + idnya,
                            success: function() {
                                swal("Data berhasil terhapus!", {
                                    icon: "success",
                                    button: true
                                }).then((oke) => {
                                    if (oke) {
                                        location = "<?= base_url("petugas/dataguru/"); ?>"
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
            var idp = $(this).attr("idp");
            $.ajax({
                type: 'post',
                url: "<?= base_url("petugas/dataguru/terpilih"); ?>",
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
            $("#ubahdata-<?= $this->session->userdata("guru_terpilih"); ?>").modal("show");
        })
    </script>
<?php endif; ?>