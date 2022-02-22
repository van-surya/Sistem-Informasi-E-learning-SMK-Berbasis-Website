<!-- Begin Page Content -->
<div class="container-fluid">
  <!--breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
  </nav>

  <!-- DataTales Example -->
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
            <span class="text">Tambah Data</span>
          </button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <!-- tabel -->
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Guru</th>
              <th>Mata Pelajaran</th>
              <th>Kelas</th>
              <th>Tahun Ajaran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($mengajar as $key => $value) : ?>
              <tr>
                <td><?= $key + 1; ?></td>
                <td><?= $value['nama_guru']; ?></td>
                <td><?= $value['nama_mapel']; ?></td>
                <td><?= $value['jenjang']; ?> <?= $value['singkatan_jurusan']; ?> <?= $value['rombel']; ?></td>
                <td><?= $value['tahun_ajaran'] . " / " . $value['semester']; ?></td>
                <td>
                  <div class="text-center">
                    <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#ubahdata-<?= $value['id_mengajar'] ?>">
                      <span class="icon text-white-50">
                        <i class="fas fa-edit"></i>
                      </span>
                      <span class="text">Ubah</span>
                    </button>
                    <a href="" class="btn btn-danger btn-icon-split btn-sm btn-hapus" idnya="<?= $value['id_mengajar']; ?>">
                      <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                      </span>
                      <span class="text">Hapus</span>
                    </a>
                  </div>
                </td>
              </tr>
              <!-- Modal Ubah -->
              <div class="modal fade modal-ubah" idm="<?= $value['id_mengajar']; ?>" id="ubahdata-<?= $value['id_mengajar'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
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
                      <?= form_open_multipart('petugas/mengajar/ubah/' . $value['id_mengajar']) ?>
                      <div class="form-group">
                        <label>Guru</label>
                        <select name="id_guru" class="form-control">
                          <option value="">--Pilih Guru--</option>
                          <?php foreach ($guru as $val) : ?>
                            <option <?php if ($val['id_guru'] == $value['id_guru']) {
                                      echo "selected";
                                    } ?> value="<?= $val['id_guru'] ?>"><?= $val['nama_guru'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Mata Pelajaran</label>
                        <select name="id_mapel" class="form-control">
                          <option value="">--Pilih Mata Pelajaran--</option>
                          <?php foreach ($mapel as $val) : ?>
                            <option <?php if ($val['id_mapel'] == $value['id_mapel']) {
                                      echo "selected";
                                    } ?> value="<?= $val['id_mapel'] ?>"><?= $val['nama_mapel'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Kelas</label>
                        <select name="id_perkelasan" class="form-control">
                          <option value="">--Pilih Kelas--</option>
                          <?php foreach ($perkelasan as $val) : ?>
                            <option <?php if ($val['id_perkelasan'] == $value['id_perkelasan']) {
                                      echo "selected";
                                    } ?> value="<?= $val['id_perkelasan'] ?>"><?= $val['jenjang'] . " " . $val['singkatan_jurusan'] . $val['rombel']; ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <?php $semester = $this->session->userdata('semester') ?>
                        <input class="form-control" type="hidden" id="semester" name="semester" value="<?= $semester; ?>">
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
              <!-- tutup modal ubah  -->
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->


<!-- Modal Tambah -->
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title; ?></h5>
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
        <?= form_open_multipart('petugas/mengajar/tambah') ?>
        <div class="form-group">
          <label>Guru</label>
          <select name="id_guru" class="form-control">
            <option value="">--Pilih Guru--</option>
            <?php foreach ($guru as $value) : ?>
              <option value="<?= $value['id_guru'] ?>"><?= $value['nama_guru'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label>Mata Pelajaran</label>
          <select name="id_mapel" class="form-control">
            <option value="">--Pilih Mata Pelajaran--</option>
            <?php foreach ($mapel as $value) : ?>
              <option value="<?= $value['id_mapel'] ?>"><?= $value['nama_mapel'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label>Kelas</label>
          <select name="id_perkelasan" class="form-control">
            <option value="">--Pilih Kelas--</option>
            <?php foreach ($perkelasan as $value) : ?>
              <option value="<?= $value['id_perkelasan'] ?>"><?= $value['jenjang'] . ' ' . $value['singkatan_jurusan'] . $value['rombel']; ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <?php $semester = $this->session->userdata('semester') ?>
          <input class="form-control" type="hidden" id="semester" name="semester" value="<?= $semester; ?>">
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
<!-- pesan_gagal  -->
<?php if ($this->session->flashdata('pesan_gagal')) : ?>
  <script>
    swal({
      icon: "warning",
      title: "Gagal!",
      text: "<?= $this->session->flashdata('pesan_gagal') ?>",
      button: false,
      timer: 2000,
    }).then((value) => {
      $('#tambah_data').modal('show');
    });
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
              url: "<?= base_url("petugas/mengajar/hapus_mengajar"); ?>",
              data: 'id=' + idnya,
              success: function() {

                swal("Data berhasil terhapus!", {
                  icon: "success",
                  button: true
                }).then((oke) => {
                  if (oke) {
                    location = "<?= base_url("petugas/mengajar/"); ?>"
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
      var idm = $(this).attr("idm");
      $.ajax({
        type: 'post',
        url: "<?= base_url("petugas/mengajar/terpilih"); ?>",
        data: 'id=' + idm,
        success: function() {

        }
      })
    })
  })
</script>
<!-- jk ada flashdata error ubah -->
<?php if ($this->session->flashdata('errors_ubah')) : ?>
  <script>
    $(document).ready(function() {
      $("#ubahdata-<?= $this->session->userdata("mengajar_terpilih"); ?>").modal("show");
    })
  </script>
<?php endif; ?>