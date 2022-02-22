<!-- Begin Page Content -->
<div class="container-fluid">
    <!--breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('siswa/mapel/') ?>">Mata Pelajaran</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('siswa/topik/detail/' . $detail['id_topik']) ?>">Topik</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tugas</li>
        </ol>
    </nav>

    <?php $url_sekarang = current_url(); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-success">
                <?= $detail['judul_tugas']; ?>
            </h4>
            <hr>
            <div class="small">
                Tugas dimulai tgl :<?= tanggal($detail['tgl_mulai']) ?> / jam :<?= jammenit($detail['tgl_mulai']) ?>
                <br>
                Pengumpulan tgl :<?= tanggal($detail['tgl_batas']) ?> / jam :<?= jammenit($detail['tgl_batas']) ?>
            </div>
        </div>
        <div class="card-body">
            <strong>Deskripsi :</strong> <?= $detail['deskripsi_tugas'] ?>
        </div>
        <div class="card-footer text-center">
            <?php if (!empty($detail['file_tugas'])) : ?>
                <a target="_blank" href="<?= base_url('assets/tugas/' . $detail['file_tugas']) ?>" class="btn btn-success btn-sm btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-download"></i></span>
                    <span class="text">Download</span>
                </a>
            <?php else : ?>
                Tidak ada lampiran tugas
            <?php endif; ?>
        </div>
    </div>
    <?php if (empty($jawaban)) : ?>
        <?php if (!empty(strtotime($detail['tgl_batas']) > strtotime('now'))) : ?>
            <div class="alert alert-warning text-center" role="alert">
                Anda belum mengirimkan jawaban
                <hr>
                <button type="button" class="btn btn-primary btn-sm btn-icon-split" data-toggle="modal" data-target="#kirim-jawaban">
                    <span class="icon text-white-50">
                        <i class="fas fa-upload"></i></span>
                    <span class="text">Kirim Jawaban</span>
                </button>
            </div>
        <?php else : ?>
            <div class="alert alert-warning text-center" role="alert">
                Anda belum mengirimkan jawaban dan batas penggumpulan sudah berakhir.
            </div>
        <?php endif; ?>
    <?php else : ?>
        <?php if (empty($jawaban['file_jawaban'])) : ?>
            <div class="alert alert-warning text-center" role="alert">
                <?php if (!empty(strtotime($detail['tgl_batas']) > strtotime('now'))) : ?>
                    <h4 class="m-0 font-weight-bold text-uppercase text-danger">File Jawaban tidak ditemukan </h4>
                    <p class="m-0 font-weight-bold text-uppercase text-danger">Harap kirim ulang jawaban anda !</p>
                    <hr>
                    <div class="text-center">
                        <button type="button" class="btn btn-info btn-sm btn-icon-split" data-toggle="modal" data-target="#ubah_jawaban">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i></span>
                            <span class="text">Kirim Ulang</span>
                        </button>
                        <a href="" class="btn btn-danger btn-icon-split btn-sm btn-hapus" idnya="<?= $jawaban['id_jawaban']; ?>">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Hapus</span>
                        </a>
                    </div>
                <?php else : ?>
                    <div class="alert alert-warning text-center" role="alert">
                        Anda belum mengirimkan jawaban dan batas penggumpulan sudah berakhir.
                    </div>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-success text-center" role="alert">
                <p class="m-0 font-weight-bold text-uppercase"> Jawaban terkirim </p>
                <p class="m-0"> Tanggal :<?= tanggal($jawaban['tgl_jawaban']); ?></p>
                <p class="m-0"> Jam :<?= jammenit($jawaban['tgl_jawaban']); ?></p>
                <a target="_bank" href="<?= base_url('assets/jawaban/' . $jawaban['file_jawaban']); ?>"> <strong> Lihat Jawaban </strong></a>
                <?php if (!empty(strtotime($detail['tgl_batas']) > strtotime('now'))) : ?>
                    <hr>
                    <div class="text-center">
                        <button type="button" class="btn btn-info btn-sm btn-icon-split" data-toggle="modal" data-target="#ubah_jawaban">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i></span>
                            <span class="text">Ubah</span>
                        </button>
                        <a href="" class="btn btn-danger btn-icon-split btn-sm btn-hapus" idnya="<?= $jawaban['id_jawaban']; ?>">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Hapus</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<!-- /.container-fluid -->

<?php $siswa = $this->session->userdata('siswa') ?>
<!-- Modal kirim -->
<div class="modal fade" id="kirim-jawaban" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kirim Jawaban</h5>
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
                <?= form_open_multipart('siswa/tugas/kirim/' . $detail['id_topik']) ?>
                <div class="form-group">
                    <div class="col-12">
                        <label>Masukan file Jawaban</label>
                        <div class="input-group mb-2">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file_jawaban" id="file_jawaban">
                                <input type="hidden" class="form-control" name="id_siswa" value="<?= $siswa['id_siswa']; ?>">
                                <input type="hidden" class="form-control" name="id_tugas" value="<?= $detail['id_tugas']; ?>">
                                <label class="custom-file-label">Pilih file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                <?=
                    form_close();
                ?>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($jawaban)) : ?>
    <!-- Modal Ubah-->
    <div class="modal fade modal-ubah" idm="<?= $jawaban['id_jawaban']; ?>" id="ubah_jawaban" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Jawaban</h5>
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
                    <?= form_open_multipart('siswa/tugas/ubah/' . $detail['id_topik'] . "/" . $jawaban['id_jawaban']) ?>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Masukan file Jawaban</label>
                            <div class="input-group mb-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file_jawaban" id="file_jawaban">
                                    <input type="hidden" class="form-control" name="id_tugas" value="<?= $jawaban['id_tugas']; ?>">
                                    <label class="custom-file-label">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                    <?=
                        form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

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
<!-- jk ada flashdata error tambah -->
<?php if ($this->session->flashdata('errors')) : ?>
    <script>
        $(document).ready(function() {
            $("#kirim-jawaban").modal("show");
        })
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
                            url: "<?= base_url("siswa/tugas/hapus_jawaban"); ?>",
                            data: 'id=' + idnya,
                            success: function() {

                                swal("Data berhasil terhapus!", {
                                    icon: "success",
                                    button: true
                                }).then((oke) => {
                                    if (oke) {
                                        location = "<?= base_url("siswa/tugas/detail/" . $detail['id_topik'] . "/" . $detail['id_tugas']); ?>"
                                    }
                                });
                            }
                        })
                    }
                });
        })
    })
</script>