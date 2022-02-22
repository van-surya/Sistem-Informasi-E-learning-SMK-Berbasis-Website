<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- breadcrumb  -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('petugas/perkelasan/') ?>">Perkelasan</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>
    <!-- Page Heading -->
    <!--  Card detail perkelasan -->
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
                        <span class="text">Tambah Siswa</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- card atas  -->
            <div class="row">
                <div class="col-lg-6">
                    <table class="table table-borderless">
                        <tr>
                            <td>Tahun Ajaran</td>
                            <th><?= $kelas['tahun_ajaran']; ?></th>
                        </tr>
                        <tr>
                            <td>Jurusan</td>
                            <td><?= $kelas['nama_jurusan']; ?></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td><?= $kelas['jenjang'] . " " . $kelas['singkatan_jurusan'] . "" . $kelas['rombel']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <?php if (!empty($this->session->userdata("semester") == "Genap")) : ?>
                <!-- pindah kelas  -->
                <form method="post">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <select class="custom-select" name="id_perkelasan">
                                <option>Pilih Kelas</option>
                                <?php foreach ($perkelasan as $key => $value) : ?>
                                    <?php if ($value['id_perkelasan'] !== $kelas['id_perkelasan']) : ?>
                                        <option value="<?= $value['id_perkelasan']; ?>">
                                            <?= $value['jenjang'] . " " . $value['singkatan_jurusan'] . " " . $value['rombel'] . " | " . $value['tahun_ajaran'] . " | " . $value['status_th_ajaran']; ?>
                                        </option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-info mb-4">Pindah</button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <hr>
                <!-- tabel -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <?php if (!empty($this->session->userdata("semester") == "Genap")) : ?>
                                    <th>#</th>
                                <?php endif; ?>
                                <th>No</th>
                                <th>Nis</th>
                                <th>Nama Siswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($siswa as $key => $value) : ?>
                                <tr>
                                    <?php if (!empty($this->session->userdata("semester") == "Genap")) : ?>
                                        <td>
                                            <input type="checkbox" name="id_siswa[]" value="<?= $value['id_siswa']; ?>">
                                        </td>
                                    <?php endif; ?>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><?= $value['nis']; ?></td>
                                    <td><?= $value['nama_siswa']; ?></td>
                                    <td class="text-center">
                                        <!-- hapus  -->
                                        <a href="<?= base_url("petugas/perkelasan/hapus_detail/" . $value["id_perkelasan_detail"] . '/' . $value['id_perkelasan']); ?>" class="btn btn-danger btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Tambah -->
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('petugas/perkelasan/tambah_detailperkelasan') ?> 
                <input type="hidden" name="id_perkelasan" value="<?= $kelas['id_perkelasan']; ?>">
                <?php foreach ($tanpa_kelas as $key => $value) : ?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="id_siswa[]" value="<?= $value['id_siswa']; ?>"> Nis: <?= $value['nis'] . ' |Nama: ' . $value['nama_siswa']; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
            <?=
                form_close();
            ?>
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
<!-- pesan  -->
<?php if ($this->session->flashdata('errors')) : ?>
    <script>
        swal({
            icon: "danger",
            title: "<?= $this->session->flashdata('errors') ?>",
        });
    </script>
<?php endif; ?>