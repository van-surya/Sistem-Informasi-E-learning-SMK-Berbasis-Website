<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>
    <!-- card -->
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
            <!--Card-->
        </div>
        <div class="card-body">
            <!-- tabel  -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nip</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($petugas as $key => $value) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $value["nip_petugas"]; ?></td>
                                <td><?= substr($value["nama_petugas"], 0, 20); ?></td>
                                <td><?= substr($value["username"], 0, 20); ?></td>
                                <td><?= substr($value["email_petugas"], 0, 30); ?></td>
                                <td class="text-center" nowrap="true">
                                    <!-- Button trigger -->
                                    <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#ubahdata-<?= $value['id_petugas'] ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Ubah</span>
                                    </button>
                                    <a href="" class="btn btn-danger btn-icon-split btn-sm btn-hapus" idnya="<?= $value['id_petugas']; ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Hapus</span>
                                    </a>
                                </td>
                            </tr>
                            <!-- Modal Ubah ubah-->
                            <div class="modal fade modal-ubah" idp="<?= $value['id_petugas']; ?>" id="ubahdata-<?= $value['id_petugas'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <?= form_open_multipart('petugas/datapetugas/ubah/' . $value['id_petugas']) ?>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                    <label>Nip</label>
                                                    <input type="text" class="form-control" id="nip_petugas" name="nip_petugas" value="<?= $value['nip_petugas'] ?>">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                    <label>Nama</label>
                                                    <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="<?= $value['nama_petugas'] ?>">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" id="email_petugas" name="email_petugas" value="<?= $value['email_petugas'] ?>">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" id="username" name="username" value="<?= $value['username'] ?>">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" id="password_petugas" name="password_petugas">
                                                    <div class="text-danger small">Kosongkan jika tidak diubah</div>
                                                </div>
                                            </div>
                                            <div class="col-12 border bg-light">
                                                <div class="col-12 text-center py-2">
                                                    <figure class="figure">
                                                        <img src="<?= base_url("assets/img/petugas/" . $value["foto_petugas"]); ?>" class="figure-img img-fluid rounded" width="100">
                                                    </figure>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Ubah Foto</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="foto_petugas" id="foto_petugas" value="<?= $value["foto_petugas"]; ?>">
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

<!-- Modal Tambah  -->
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
                <?php if ($this->session->flashdata('errors')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $this->session->flashdata('errors') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif ?>
                <?= form_open_multipart('petugas/datapetugas/tambah') ?>
                <div class="row ">
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                        <label>Nip</label>
                        <input type="text" class="form-control" id="nip_petugas" name="nip_petugas" placeholder="Masukan NIP">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Masukan Nama">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email_petugas" name="email_petugas" placeholder="Masukan Email">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                        <label>Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password_petugas" name="password_petugas" placeholder="Masukan Password">
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mb-3">
                        <label>Foto</label>
                        <div class="input-group mb-2">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="foto_petugas" id="foto_petugas">
                                <label class="custom-file-label">Pilih file</label>
                            </div>
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
                    buttons: ["Batal", "Hapus data!"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        //disini ajax hapus data
                        $.ajax({
                            type: 'post',
                            url: "<?= base_url("petugas/datapetugas/hapus_petugas"); ?>",
                            data: 'id=' + idnya,
                            success: function() {

                                swal("Data berhasil terhapus!", {
                                    icon: "success",
                                    button: true
                                }).then((oke) => {
                                    if (oke) {
                                        location = "<?= base_url("petugas/datapetugas/"); ?>"
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
<?php if ($this->session->flashdata('errors')) : ?>
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
                url: "<?= base_url("petugas/datapetugas/terpilih"); ?>",
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
            $("#ubahdata-<?= $this->session->userdata("petugas_terpilih"); ?>").modal("show");
        })
    </script>
<?php endif; ?>