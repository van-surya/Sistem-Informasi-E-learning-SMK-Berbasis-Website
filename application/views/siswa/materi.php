<!-- Begin Page Content -->
<div class="container-fluid">
    <!--breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('siswa/mapel/') ?>">Mata Pelajaran</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('siswa/topik/detail/' . $detail['id_topik']) ?>">Topik</a></li>
            <li class="breadcrumb-item active" aria-current="page">Materi</li>
        </ol>
    </nav>
    <?php $url_sekarang = current_url(); ?>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-success">
                <?= substr($detail['judul_materi'], 0, 100); ?>
            </h4>
            <div class="small">
                <p><strong>Pemberian :</strong> <?= tanggal($detail['tgl_materi']) . " Jam" . jammenit($detail['tgl_materi']); ?></p>
            </div>
        </div>
        <div class="card-body">
            <strong>Deskripsi : </strong><?= $detail['deskripsi_materi'] ?>
        </div>
        <?php if (!empty($detail['file_materi'])) : ?>
            <div class="card-footer text-center">
                <a target="_blank" href="<?= base_url('assets/materi/' . $detail['file_materi']) ?>" class="btn btn-success btn-sm btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-download"></i></span>
                    <span class="text">Download</span>
                </a>
            </div>
        <?php endif; ?>
    </div>

</div>
<!-- /.container-fluid -->