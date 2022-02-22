<!-- Begin Page Content -->
<div class="container-fluid">
    <!--breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-success font-weight-bold"><?= $title; ?></h1>
    <div class="container-fluid">
        <div class="row">
            <!-- Jumlah Data Guru -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-success text-uppercase mb-1">
                                    Data Guru</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_guru; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Data Siswa -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-warning text-uppercase mb-1">
                                    Data Siswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_siswa; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Data Pengajar -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-info text-uppercase mb-1">
                                    Data Jurusan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_jurusan; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Jumlah Data Kelas -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-primary text-uppercase mb-1">
                                    Data Kelas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_kelas; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- profile -->
        <div class="card shadow mb-3">
            <div class="card-header">
                <h6 class="m-1 font-weight-bold text-info">Profile Anda</h6>
            </div>
            <div class="row no-gutters m-2 ">
                <div class="col-md-4 align-self-center text-center">
                    <?php $petugas = $this->session->userdata('petugas') ?>
                    <?php if (!empty($petugas["foto_petugas"])) : ?>
                        <img src="<?= base_url("assets/img/petugas/" . $petugas["foto_petugas"]); ?>" class="img-fluid" width="225px">
                    <?php else : ?>
                        <img src="<?= base_url("assets/img/avatar.jpg"); ?>" class="img-fluid" width="225px">
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <!-- tampilkan data pelogin  -->
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td class="font-weight-bold">Nama</td>
                                <td>: <?= $petugas['nama_petugas']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nip</td>
                                <td>: <?= $petugas['nip_petugas']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Username</td>
                                <td>: <?= $petugas['username']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Email</td>
                                <td>: <?= $petugas['email_petugas']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right py-2">
                <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#ubahprofil-<?= $petugas['id_petugas'] ?>">
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
<div class="modal fade modal-ubah" idp="<?= $petugas['id_petugas']; ?>" id="ubahprofil-<?= $petugas['id_petugas'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Profile Anda</h5>
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
                <?= form_open_multipart('petugas/beranda/ubahprofil/' . $petugas['id_petugas']) ?>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label>Nip</label>
                        <input type="text" class="form-control" id="nip_petugas" name="nip_petugas" value="<?= $petugas['nip_petugas'] ?>">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="<?= $petugas['nama_petugas'] ?>">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email_petugas" name="email_petugas" value="<?= $petugas['email_petugas'] ?>">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label>Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $petugas['username'] ?>">
                    </div>
                    <div class="col-12">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password_petugas" name="password_petugas">
                        <div class="text-danger small">Kosongkan jika tidak diubah</div>
                    </div>
                </div>
                <div class="col-12 border bg-light">
                    <div class="col-12 text-center py-2">
                        <figure class="figure">
                            <img src="<?= base_url("assets/img/petugas/" . $petugas["foto_petugas"]); ?>" class="figure-img img-fluid rounded" width="100">
                        </figure>
                    </div>
                    <div class="col-12 text-center">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ubah Foto</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="foto_petugas" id="foto_petugas" value="<?= $petugas["foto_petugas"]; ?>">
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
</div>
<!-- pesan  -->
<?php if ($this->session->flashdata('pesan')) : ?>
    <script>
        swal({
            icon: "success",
            title: "Berhasil!",
            text: "<?= $this->session->flashdata('pesan') ?>",
            button: false,
            timer: 3000,
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
                url: "<?= base_url("petugas/beranda/terpilih"); ?>",
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