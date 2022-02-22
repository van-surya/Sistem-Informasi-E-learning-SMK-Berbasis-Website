<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('guru/mapel/') ?>">Mata Pelajaran</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>
    <?php $url_sekarang = current_url(); ?>

    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between mb-3">
                <div class="col-md-6">
                    <h1 class="h4 text-uppercase text-success font-weight-bold"><?= $title; ?></h1>
                </div>
                <div class="col-md-6 text-md-right mt-2 mt-md-0">
                    <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah_data">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i></span>
                        <span class="text">Tambah Topik</span>
                    </button>
                </div>
            </div>
            <hr class="border-success my-0">
            <table class="table table-borderless my-0">
                <tr">
                    <th>Mata Pelajaran</th>
                    <td><?= $mengajar['nama_mapel']; ?></td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td><?= $mengajar['jenjang'] . $mengajar['singkatan_jurusan'] . $mengajar['rombel'] . ' | ' . $mengajar['tahun_ajaran'] . ' ' . $mengajar['semester']; ?></td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td><?= $mengajar['nama_jurusan']; ?></td>
                    </tr>
            </table>
        </div>
        <div class="card-body">
            <?php if (empty($topik)) : ?>
                <div class="alert alert-warning text-center" role="alert">
                    Belum membuat topik...
                </div>
            <?php endif; ?>
            <div class="row justify-content-center">
                <?php foreach ($topik as $key => $value) : ?>
                    <div class="col-xl-12 col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row justify-content-between">
                                    <div class="col-md-6">
                                        <a class="font-weight-bold h4 card-link" href="<?= base_url("guru/topik/detail/" . $value["id_topik"]); ?>"><?= substr($value['judul_topik'], 0, 50); ?></a>
                                        <br>
                                        Diberikan: <?= tanggal($value['topik_mulai']) ?> / Jam <?= jammenit($value['topik_mulai']) ?> <br>
                                        Batas: <?= tanggal($value['topik_berakhir']) ?> / Jam <?= jammenit($value['topik_berakhir']) ?>
                                    </div>
                                    <div class="col-md-6 text-md-right mt-2 mt-md-0">
                                        <?php if (empty(strtotime($value['topik_mulai']) > strtotime("now"))) : ?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon-split disabled">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check"></i></span>
                                                <span class="text">Terkirim</span>
                                            </button>
                                        <?php else : ?>
                                            <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#ubahdata-<?= $value['id_topik'] ?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span class="text">Ubah</span>
                                            </button>
                                            <a href="" class="btn btn-danger btn-icon-split btn-sm btn-hapus" idt="<?= $value['id_topik']; ?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Hapus</span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text text-gray-800 mb-1">
                                    <?= substr($value['deskripsi_topik'], 0, 300); ?><br>
                                </div>
                                <hr>
                                <a href="<?= base_url("guru/topik/detail/" . $value["id_topik"]); ?>" class="btn btn-primary btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="text">Lihat</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Ubah-->
                    <div class="modal fade modal-ubah" idt="<?= $value['id_topik']; ?>" id="ubahdata-<?= $value['id_topik'] ?>" tabindex="-1" role="dialog" aria-labelledby="modaltest<?= $value['id_topik'] ?>Label" aria-hidden="true">
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
                                    <?= form_open_multipart('guru/topik/ubah/' . $value['id_mengajar'] . '/' . $value['id_topik']) ?>
                                    <div class="form-group">
                                        <label>Judul</label>
                                        <input type="text" class="form-control" id="judul_topik" name="judul_topik" value="<?= $value['judul_topik'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea type="textarea" class="form-control" rows="3" id="deskripsi_topik" name="deskripsi_topik"><?= $value["deskripsi_topik"]; ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5 col-md-6 col-lg-6">
                                            <label>Diberikan</label>
                                            <input type="datetime-local" class="form-control" name="topik_mulai" value="<?= date('Y-m-d\TH:i', strtotime($value['topik_mulai'])); ?>">
                                        </div>
                                        <div class="col-sm-5 col-md-6 col-lg-6">
                                            <label>Batas</label>
                                            <input type="datetime-local" class="form-control" name="topik_berakhir" value="<?= date('Y-m-d\TH:i', strtotime($value['topik_berakhir'])); ?>">
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

                <?php endforeach; ?>
            </div>
        </div>
        <?php if (!empty($topik)) : ?>
            <div class="card-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                        if ($halaman > 1) {
                            $sebelumnya = $halaman - 1;;
                        } else {
                            $sebelumnya = 1;
                        }
                        if ($halaman == $jumlah_halaman) {
                            $selanjutnya = $jumlah_halaman;
                        } else {
                            $selanjutnya = $halaman  + 1;
                        } ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= base_url('guru/topik/index/' . $mengajar['id_mengajar'] . "/" . $sebelumnya); ?>">Sebelumnya</a>
                        </li>
                        <?php
                        for ($i = 1; $i <= $jumlah_halaman; $i++) { ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= base_url('guru/topik/index/' . $mengajar['id_mengajar'] . "/" . $i); ?>"><?= $i; ?></a>
                            </li>
                        <?php } ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= base_url('guru/topik/index/' . $mengajar['id_mengajar'] . "/" . $selanjutnya); ?>">Selanjutnya</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
            </div>
    </div>
    <!-- /.container-fluid -->


    <!-- Modal Tambah Topik -->
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
                    <?= form_open_multipart('guru/topik/tambah') ?>
                    <?php if ($this->session->flashdata('errors')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= $this->session->flashdata('errors') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label>Judul</label>
                            <input type="hidden" class="form-control" name="id_mengajar" value="<?= $mengajar['id_mengajar']; ?>">
                            <input type="text" class="form-control" id="judul_topik" name="judul_topik" placeholder="Masukan Nama Topik">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi_topik" rows="3"></textarea>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label>Diberikan</label>
                            <input type="datetime-local" class="form-control" name="topik_mulai">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label>Batas</label>
                            <input type="datetime-local" class="form-control" name="topik_berakhir">
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
                var idt = $(this).attr("idt");
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
                                url: "<?= base_url("guru/topik/hapus_topik"); ?>",
                                data: 'id=' + idt,
                                success: function() {

                                    swal("Data berhasil terhapus!", {
                                        icon: "success",
                                        button: true
                                    }).then((oke) => {
                                        if (oke) {
                                            location = "<?= base_url("guru/topik/index/" . $mengajar['id_mengajar']); ?>"
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
                var idt = $(this).attr("idt");
                $.ajax({
                    type: 'post',
                    url: "<?= base_url("guru/topik/terpilih"); ?>",
                    data: 'id=' + idt,
                    success: function() {}
                })
            })
        })
    </script>
    <!-- jk ada flashdata error ubah -->
    <?php if ($this->session->flashdata('errors_ubah')) : ?>
        <script>
            $(document).ready(function() {
                $("#ubahdata-<?= $this->session->userdata("topik_terpilih"); ?>").modal("show");
            })
        </script>
    <?php endif; ?>