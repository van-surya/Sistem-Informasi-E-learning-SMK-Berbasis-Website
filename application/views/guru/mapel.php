<!-- Begin Page Content -->
<div class="container-fluid">
    <!--breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>
    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-success text-uppercase">
                <?= $title; ?>
            </h4>
        </div>
        <div class="card-body">
            <!-- tabel  -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Tahun Ajaran</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mapel as $key => $value) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $value['nama_mapel']; ?></td>
                                <td><?= $value['jenjang'] . '' . $value['singkatan_jurusan'] . $value['rombel']; ?></td>
                                <td><?= $value['nama_jurusan']; ?></td>
                                <td><?= $value['tahun_ajaran'] . ' ' . $value['semester']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('guru/topik/index/' . $value['id_mengajar']); ?>" class="btn btn-primary btn-sm">
                                        Topik</a>
                                    <a href="<?= base_url('guru/forumdiskusi/index/' . $value['id_mengajar']); ?>" class="btn btn-success btn-sm">
                                        </i>Diskusi</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
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