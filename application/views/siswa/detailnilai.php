<!-- Begin Page Content -->
<div class="container-fluid">
    <!--breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('siswa/nilai/') ?>">Nilai</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $mengajar['nama_mapel']; ?></li>
        </ol>
    </nav>
    <!-- Page Heading -->

    <?php if ($this->session->flashdata('errors')) : ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $this->session->flashdata('errors') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <!-- tabel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <table class="table table-borderless my-0">
                <tr>
                    <th>Nilai Mata Pelajaran</th>
                    <td><?= $mengajar['nama_mapel']; ?></td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td><?= $mengajar['nama_jurusan']; ?></td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <td><?= $mengajar['semester']; ?></td>
                </tr>
            </table>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <?php foreach ($nilai as $key => $value) : ?>
                                <th><?= "Tugas " . ($key += 1); ?></th>
                            <?php endforeach; ?>
                            <th>Rata rata nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($nilai as $key => $value) : ?>
                                <td><?= $value['nilai']; ?></td>
                            <?php endforeach; ?>
                            <td> <?php if ($rata_rata) {
                                        echo $rata_rata['rata_rata_nilai'];
                                    } ?></td>
                        </tr>
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