<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('guru/nilai/index') ?>">Nilai</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>
    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <table class="table table-borderless my-0">
                <tr">
                    <th>Nilai Mata Pelajaran</th>
                    <td><?= $mengajar['nama_mapel']; ?></td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td><?= $mengajar['jenjang'] . $mengajar['singkatan_jurusan'] . $mengajar['rombel'] . ' | ' . $mengajar['tahun_ajaran'] . " " . $mengajar['semester']; ?></td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td><?= $mengajar['nama_jurusan']; ?></td>
                    </tr>
            </table>
        </div>
        <div class="card-body">
            <!-- tabel  -->
            <form method="post">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nis</th>
                                <th>Nama Siswa</th>
                                <?php foreach ($tugas as $key => $value) : ?>
                                    <th>
                                        Tugas <?= $key + 1 ?>
                                    </th>
                                <?php endforeach; ?>
                                <th>Rata Rata Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tugas_siswa as $key => $persiswa) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $persiswa['nis']; ?></td>
                                    <td><?= $persiswa['nama_siswa']; ?></td>
                                    <?php if (!empty($persiswa['tugas'])) : ?>
                                        <?php foreach ($persiswa['tugas'] as $key => $pertugas) : ?>
                                            <td>
                                                <?= !empty($pertugas['jawaban']) ? $pertugas['jawaban']['nilai_jawaban'] : "0"; ?>
                                            </td>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <td>
                                        <input type="number" name="data[<?= $persiswa['id_siswa'] ?>][tugas]" class="form-control" value="<?= substr($persiswa['rata'], 0, 4); ?>" readonly>
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