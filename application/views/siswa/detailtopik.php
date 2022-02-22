<!-- Begin Page Content -->
<div class="container-fluid">
    <!--breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('siswa/mapel/') ?>">Mata Pelajaran</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('siswa/topik/index/' . $topik['id_mengajar']) ?>">Topik</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    <!--card-->

    <div class="card shadow mb-4">
        <div class="card-header">
            <h5 class="text-primary"> <strong> Judul Topik : </strong><?= $topik['judul_topik']; ?> </h5>
            <p class="text-muted m-0"> Diberikan :<?= tanggal($topik['topik_mulai']); ?> / Jam <?= jammenit($topik['topik_mulai']); ?> </p>
            <p class="text-muted m-0"> Batas :<?= tanggal($topik['topik_berakhir']); ?> / Jam <?= jammenit($topik['topik_berakhir']); ?> </p>
        </div>
        <div class="card-body">
            <p class="card-title font-weight-bolder">Deskripsi :</p>
            <p class="card-text"><?= $topik['deskripsi_topik']; ?> </p>
        </div>
    </div>

    <!-- Tampil Materi -->
    <?php if (!empty($materi)) : ?>
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <a rel="nofollow" class="font-weight-bold text-primary" href="<?= base_url('siswa/materi/detail/' . $materi['id_topik'] . "/" . $materi['id_materi']) ?>">Materi : <?= substr($materi['judul_materi'], 0, 100); ?></a>
            </div>
            <div class="card-body py-2">
                <p class="card-title mb-0">
                    <strong>Pemberian Materi :</strong> <?= tanggal($materi['tgl_materi']); ?> Jam :<?= jammenit($materi['tgl_materi']); ?>
                </p>
                <p class="card-text"> <strong> Deskripsi :</strong> <?= $materi['deskripsi_materi']; ?></p>
                <a rel="nofollow" class="font-weight-bold" href="<?= base_url('siswa/materi/detail/' . $materi['id_topik'] . "/" . $materi['id_materi']) ?>">Lihat Materi</a>
            </div>
        </div>
    <?php endif; ?>
    <!-- card tugas  -->
    <?php if (!empty($tugas)) : ?>
        <div class="card shadow mb-4">
            <div class="card-header py-2 text-primary">
                <a rel="nofollow" class="font-weight-bold" href="<?= base_url('siswa/tugas/detail/' . $tugas['id_topik'] . "/" . $tugas['id_tugas']) ?>">Tugas : <?= substr($tugas['judul_tugas'], 0, 100); ?></a>
            </div>
            <div class="card-body py-2">
                <p class="card-title">
                    <strong>Pemberian Tugas :</strong> <?= tanggal($tugas['tgl_mulai']); ?> Jam :<?= jammenit($tugas['tgl_mulai']); ?> <br>
                    <strong>Batas Pengumpulan :</strong> <?= tanggal($tugas['tgl_batas']); ?> Jam :<?= jammenit($tugas['tgl_batas']); ?><br>
                    <strong> Deskripsi :</strong> <?= $tugas['deskripsi_tugas']; ?></p>
                <a rel="nofollow" class="font-weight-bold" href="<?= base_url('siswa/tugas/detail/' . $tugas['id_topik'] . "/" . $tugas['id_tugas']) ?>">Lihat Tugas</a>
            </div>
        </div>
    <?php endif; ?>

</div>
<!-- /.container-fluid -->