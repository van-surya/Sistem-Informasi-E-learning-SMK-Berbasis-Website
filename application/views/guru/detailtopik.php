<!-- Begin Page Content -->
<div class="container-fluid">
  <!--breadcrumb-->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('guru/mapel/') ?>">Mata Pelajaran</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('guru/topik/index/' . $topik['id_mengajar']) ?>">Topik</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
  </nav>

  <?php if (!empty($materi && $tugas)) { ?>
  <?php } elseif (!empty($materi or $tugas)) { ?>
    <div class="alert alert-success alert-dismissible fade show text-center py-1" role="alert">
      <h5 class=" font-weight-bolder">Pemberitahuan !</h5>
      <?php if (empty($materi)) : ?>
        <p> Dapat menambahkan <strong>Materi</strong></p>
        <hr>
        <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah_materi">
          <span class="icon text-white-50">
            <i class="fas fa-plus"></i></span>
          <span class="text">Tambah Materi</span>
        </button> <?php endif; ?>
      <?php if (empty($tugas)) : ?>
        <p> Dapat menambahkan <strong>Tugas</strong></p>
        <hr>
        <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah_tugas">
          <span class="icon text-white-50">
            <i class="fas fa-plus"></i></span>
          <span class="text">Tambah Tugas</span>
        </button>
      <?php endif; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php } else { ?>
    <div class="alert alert-warning text-center py-1">
      <h5 class=" font-weight-bolder">Pemberitahuan !</h5>
      <p>Belum memberikan <strong>materi</strong> dan <strong>tugas</strong></p>
      <hr>
      <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah_materi">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i></span>
        <span class="text">Tambah Materi</span>
      </button>
      <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah_tugas">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i></span>
        <span class="text">Tambah Tugas</span>
      </button>
    </div>
  <?php } ?>

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
        <div class="row justify-content-between">
          <div class="col-md-6">
            <a class="font-weight-bold card-link h5" href="<?= base_url('guru/materi/detail/' . $materi['id_topik'] . "/" . $materi['id_materi']) ?>">Materi : <?= substr($materi['judul_materi'], 0, 100); ?></a>
          </div>
          <?php if (!empty(strtotime($materi['tgl_materi']) > strtotime('now'))) : ?>
            <div class="col-md-6 text-md-right mt-2 mt-md-0">
              <button type="button" class="btn btn-info btn-sm btn-icon-split" data-toggle="modal" data-target="#ubahmateri">
                <span class="icon text-white-50">
                  <i class="fas fa-edit"></i></span>
                <span class="text">Ubah</span>
              </button>
              <a href="" class="btn btn-danger btn-icon-split btn-sm btn-hapusmateri" idmateri="<?= $materi['id_materi']; ?>">
                <span class="icon text-white-50">
                  <i class="fas fa-trash"></i>
                </span>
                <span class="text">Hapus</span>
              </a>
            </div>
          <?php else : ?>
            <button type="button" class="btn btn-success btn-sm btn-icon-split disabled">
              <span class="icon text-white-50">
                <i class="fas fa-check"></i></span>
              <span class="text">Terkirim</span>
            </button>
          <?php endif; ?>
        </div>
      </div>
      <div class="card-body py-2">
        <p class="card-title mb-0">
          <strong>Diberikan Materi :</strong> <?= tanggal($materi['tgl_materi']); ?> Jam :<?= jammenit($materi['tgl_materi']); ?>
        </p>
        <p class="card-text"> <strong> Deskripsi :</strong> <?= $materi['deskripsi_materi']; ?></p>
        <a class="font-weight-bold" href="<?= base_url('guru/materi/detail/' . $materi['id_topik'] . "/" . $materi['id_materi']) ?>">Lihat Materi</a>
      </div>
    </div>
  <?php endif; ?>

  <!-- Tampil Tugas -->
  <?php if (!empty($tugas)) : ?>
    <div class="card shadow mb-4">
      <div class="card-header py-2 text-primary">
        <div class="row justify-content-between">
          <div class="col-md-6">
            <a class="font-weight-bold card-link h5" href="<?= base_url('guru/tugas/detail/' . $tugas['id_topik'] . "/" . $tugas['id_tugas']) ?>">Tugas : <?= substr($tugas['judul_tugas'], 0, 100); ?></a>
          </div>
          <?php if (!empty(strtotime($tugas['tgl_mulai']) > strtotime('now'))) : ?>
            <div class="col-md-6 text-md-right mt-2 mt-md-0">
              <button type="button" class="btn btn-info btn-sm btn-icon-split" data-toggle="modal" data-target="#ubahtugas">
                <span class="icon text-white-50">
                  <i class="fas fa-edit"></i></span>
                <span class="text">Ubah</span>
              </button>
              <a href="" class="btn btn-danger btn-icon-split btn-sm btn-hapustugas" idtugas="<?= $tugas['id_tugas']; ?>">
                <span class="icon text-white-50">
                  <i class="fas fa-trash"></i>
                </span>
                <span class="text">Hapus</span>
              </a>
            </div>
          <?php else : ?>
            <button type="button" class="btn btn-success btn-sm btn-icon-split disabled">
              <span class="icon text-white-50">
                <i class="fas fa-check"></i></span>
              <span class="text">Terkirim</span>
            </button>
          <?php endif; ?>
        </div>

      </div>
      <div class="card-body py-2">
        <p class="card-title">
          <strong>Diberikan:</strong> <?= tanggal($tugas['tgl_mulai']); ?> Jam :<?= jammenit($tugas['tgl_mulai']); ?> <br>
          <strong>Batas Pengumpulan :</strong> <?= tanggal($tugas['tgl_batas']); ?> Jam :<?= jammenit($tugas['tgl_batas']); ?>
        </p>
        <p class="card-text"> <strong> Deskripsi :</strong> <?= $tugas['deskripsi_tugas']; ?></p>
        <a class="font-weight-bold" href="<?= base_url('guru/tugas/detail/' . $tugas['id_topik'] . "/" . $tugas['id_tugas']) ?>">Lihat Tugas</a>
      </div>
    </div>
  <?php endif; ?>

  <!-- /.container-fluid -->
</div>

<!------------------------------------ modal materi ------------------------------------------>
<!-- Modal Tambah Materi -->
<div class="modal fade" id="tambah_materi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <?php if ($this->session->flashdata('errors_materi')) : ?>
          <div class="alert alert-danger alert-dismissible fade show">
            <?= $this->session->flashdata('errors_materi') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif ?>
        <?= form_open_multipart('guru/materi/tambah') ?>
        <input type="hidden" class="form-control" name="id_topik" value="<?= $topik['id_topik']; ?>">
        <div class="form-group">
          <label>Judul</label>
          <input type="text" class="form-control" id="judul_materi" name="judul_materi" placeholder="Masukan Judul Materi">
        </div>
        <div class="form-group">
          <label>Deskripsi</label>
          <textarea class="form-control" name="deskripsi_materi" rows="10"></textarea>
        </div>
        <input type="hidden" class="form-control" name="tgl_materi" value="<?= date('Y-m-d\TH:i', strtotime($topik['topik_mulai'])); ?>">
        <div class="form-group">
          <label>Lampiran</label>
          <div class="input-group mb-2">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="file_materi" id="file_materi">
              <label class="custom-file-label">Pilih file</label>
            </div>
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
<!-- Modal Ubah materi -->
<?php if (!empty($materi)) : ?>
  <div class="modal fade mmodal-ubah-materi" idm="<?= $materi['id_materi']; ?>" id="ubahmateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Materi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php if ($this->session->flashdata('errors_ubahmateri')) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
              <?= $this->session->flashdata('errors_ubahmateri') ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif ?>
          <?= form_open_multipart('guru/materi/ubah/' . $materi['id_topik'] . "/" . $materi['id_materi']) ?>
          <div class="form-group">
            <label>Judul</label>
            <input type="hidden" class="form-control" name="id_topik" value="<?= $materi['id_topik']; ?>">
            <input type="text" class="form-control" id="judul_materi" name="judul_materi" value="<?= $materi['judul_materi'] ?>">
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" name="deskripsi_materi" rows="10"><?= $materi['deskripsi_materi'] ?></textarea>
          </div>
          <input type="hidden" class="form-control" name="tgl_materi" value="<?= date('Y-m-d\TH:i', strtotime($topik['topik_mulai'])); ?>">
          <div class="form-group">
            <label>Lampiran</label>
            <div class="input-group mb-2">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="file_materi" id="file_materi">
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
<?php endif; ?>
<!------------------------------------ modal tugas ------------------------------------------>
<!-- Modal Tambah Tugas -->
<div class="modal fade" id="tambah_tugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tugas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if ($this->session->flashdata('errors_tugas')) : ?>
          <div class="alert alert-danger alert-dismissible fade show">
            <?= $this->session->flashdata('errors_tugas') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif ?>
        <?= form_open_multipart('guru/tugas/tambah') ?>
        <input type="hidden" class="form-control" name="id_topik" value="<?= $topik['id_topik']; ?>">
        <div class="form-group">
          <label>Judul</label>
          <input type="text" class="form-control" id="judul_tugas" name="judul_tugas" placeholder="Masukan Judul Tugas">
        </div>
        <div class="form-group">
          <label>Deskripsi</label>
          <textarea class="form-control" name="deskripsi_tugas" rows="10"></textarea>
        </div>
        <input type="hidden" class="form-control" name="tgl_mulai" value="<?= date('Y-m-d\TH:i', strtotime($topik['topik_mulai'])); ?>">
        <input type="hidden" class="form-control" name="tgl_batas" value="<?= date('Y-m-d\TH:i', strtotime($topik['topik_berakhir'])); ?>">
        <div class="form-group">
          <label>Lampiran</label>
          <div class="input-group mb-2">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="file_tugas" id="file_tugas">
              <label class="custom-file-label">Pilih file</label>
            </div>
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
<!-- Modal Ubah Tugas -->
<?php if (!empty($tugas)) : ?>
  <div class="modal fade modal-ubah-tugas" idt="<?= $tugas['id_tugas']; ?>" id="ubahtugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Tugas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php if ($this->session->flashdata('errors_ubahtugas')) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
              <?= $this->session->flashdata('errors_ubahtugas') ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif ?>
          <?= form_open_multipart('guru/tugas/ubah/' . $tugas['id_topik'] . "/" . $tugas['id_tugas']) ?>
          <div class="form-group">
            <label>Judul</label>
            <input type="hidden" class="form-control" name="id_topik" value="<?= $tugas['id_topik']; ?>">
            <input type="text" class="form-control" id="judul_tugas" name="judul_tugas" value="<?= $tugas['judul_tugas'] ?>">
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" name="deskripsi_tugas" rows="10"><?= $tugas['deskripsi_tugas'] ?></textarea>
          </div>
          <input type="hidden" class="form-control" name="tgl_mulai" value="<?= date('Y-m-d\TH:i', strtotime($topik['topik_mulai'])); ?>">
          <input type="hidden" class="form-control" name="tgl_batas" value="<?= date('Y-m-d\TH:i', strtotime($topik['topik_berakhir'])); ?>">
          <div class="form-group">
            <label>Lampiran</label>
            <div class="input-group mb-2">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="file_tugas" id="file_tugas">
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
<?php endif; ?>

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

<!------------------------------------ alert materi ------------------------------------------>
<!-- jk ada flashdata error tambah -->
<?php if ($this->session->flashdata('errors_materi')) : ?>
  <script>
    $(document).ready(function() {
      $("#tambah_materi").modal("show");
    })
  </script>
<?php endif; ?>
<!-- hapus -->
<script>
  $(document).ready(function() {
    $(".btn-hapusmateri").on("click", function(e) {
      e.preventDefault();
      var idmateri = $(this).attr("idmateri");
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
              url: "<?= base_url("guru/materi/hapus_materi"); ?>",
              data: 'id=' + idmateri,
              success: function() {
                swal("Data berhasil terhapus!", {
                  icon: "success",
                  button: true
                }).then((oke) => {
                  if (oke) {
                    location = "<?= base_url("guru/topik/detail/" . $topik["id_topik"]); ?>"
                  }
                });
              }
            })
          }
        });
    })
  })
</script>
<!-- jk modal ubah diclick  -->
<script>
  $(document).ready(function() {
    $(".modal-ubah-materi").on("shown.bs.modal", function() {
      var idm = $(this).attr("idm");
      $.ajax({
        type: 'post',
        url: "<?= base_url("guru/materi/terpilih"); ?>",
        data: 'id=' + idm,
        success: function() {}
      })
    })
  })
</script>
<!-- jk ada flashdata error ubah -->
<?php if ($this->session->flashdata('errors_ubahmateri')) : ?>
  <script>
    $(document).ready(function() {
      $("#ubahmateri").modal("show");
    })
  </script>
<?php endif; ?>

<!------------------------------------ alert tugas ------------------------------------------->
<!-- jk modal ubah diclick  -->
<script>
  $(document).ready(function() {
    $(".modal-ubah-tugas").on("shown.bs.modal", function() {
      var idt = $(this).attr("idt");
      $.ajax({
        type: 'post',
        url: "<?= base_url("guru/tugas/terpilih"); ?>",
        data: 'id=' + idt,
        success: function() {}
      })
    })
  })
</script>
<!-- jk ada flashdata error ubah -->
<?php if ($this->session->flashdata('errors_ubahtugas')) : ?>
  <script>
    $(document).ready(function() {
      $("#ubahtugas").modal("show");
    })
  </script>
<?php endif; ?>
<!-- jk ada flashdata error tambah  -->
<?php if ($this->session->flashdata('errors_tugas')) : ?>
  <script>
    $(document).ready(function() {
      $("#tambah_tugas").modal("show");
    })
  </script>
<?php endif; ?>
<!-- hapus -->
<script>
  $(document).ready(function() {
    $(".btn-hapustugas").on("click", function(e) {
      e.preventDefault();
      var idtugas = $(this).attr("idtugas");
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
              url: "<?= base_url("guru/tugas/hapus_tugas"); ?>",
              data: 'id=' + idtugas,
              success: function() {
                swal("Data berhasil terhapus!", {
                  icon: "success",
                  button: true
                }).then((oke) => {
                  if (oke) {
                    location = "<?= base_url("guru/topik/detail/" . $topik["id_topik"]); ?>"
                  }
                });
              }
            })
          }
        });
    })
  })
</script>