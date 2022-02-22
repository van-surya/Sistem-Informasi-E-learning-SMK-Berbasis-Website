<!-- Begin Page Content -->
<div class="container-fluid">
    <!--breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('guru/mapel/') ?>">Mata Pelajaran</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('guru/topik/detail/' . $detail['id_topik']) ?>">Topik</a></li>
            <li class="breadcrumb-item active" aria-current="page">Materi</li>
        </ol>
    </nav>
    <!--card-->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="text-success font-weight-bold">Judul : <?= $detail['judul_materi']; ?></h4>
            <hr class="mb-0">
            <p>
                Pemberian materi tgl <?= tanggal($detail['tgl_materi']); ?>: / jam <?= jammenit($detail['tgl_materi']); ?>
            </p>
        </div>
        <div class="card-body py-3">
            <p class="card-text"><strong>Deskripsi : </strong><?= $detail['deskripsi_materi']; ?></p>
        </div>
        <div class="card-footer text-center mb-0">
            <?php if (empty($detail['file_materi'])) : ?>
                <p>Lampiran materi tidak ada</p>
            <?php else : ?>
                <a target="_blank" href="<?= base_url('assets/materi/' . $detail['file_materi']) ?>" class="btn btn-primary btn-sm btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-download"></i></span>
                    <span class="text">Download</span>
                </a>
            <?php endif; ?>
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