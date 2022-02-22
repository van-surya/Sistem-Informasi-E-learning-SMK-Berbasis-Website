<!-- Begin Page Content -->
<div class="container-fluid">

  <!--breadcrumb-->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('guru/mapel/') ?>">Mata Pelajaran</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('guru/topik/detail/' . $detail['id_topik']) ?>">Topik</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tugas</li>
    </ol>
  </nav>

  <!--card-->
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
      <strong>Deskripsi : </strong> <?= $detail['deskripsi_tugas'] ?>
    </div>
    <div class="card-footer text-center">
      <?php if (empty($detail['file_tugas'])) : ?>
        tidak ada file tugas
      <?php else : ?>
        <a target="_blank" href="<?= base_url('assets/tugas/' . $detail['file_tugas']) ?>" class="btn btn-success btn-sm btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-download"></i></span>
          <span class="text">Download</span>
        </a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Table Jawaban-->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-success">Jawaban Terkumpul</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nis</th>
              <th>Nama</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($siswa as $key => $value) : ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $value['nis'] ?></td>
                <td><?= substr($value['nama_siswa'], 0, 50) ?></td>
                <td><?= isset($value['jawaban']['tgl_jawaban']) ? tanggal_waktu($value['jawaban']['tgl_jawaban']) : "Belum mengirimkan jawaban"; ?></td>
                <td class="text-center">
                  <?php if (!empty($value['jawaban'])) : ?>
                    <a target="_blank" href="<?= base_url('assets/jawaban/' . $value['jawaban']['file_jawaban']) ?>" class="btn btn-success btn-sm"><i class="fa fa-download mr-2"></i>Download</a>
                    <button data-toggle="modal" data-target="#modal-nilai-<?= ($value['jawaban']['id_jawaban']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-award mr-2"></i>Nilai</button>
                  <?php endif; ?>
                </td>
              </tr>
              <?php if (!empty($value['jawaban'])) : ?>
                <!-- Modal Tambah Nilai -->
                <div class="modal fade" id="modal-nilai-<?= $value['jawaban']['id_jawaban'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Masukan Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?= form_open_multipart('guru/tugas/input_nilai') ?>
                        <input type="hidden" class="form-control" name="id_tugas" value="<?= $value['id_tugas']; ?>">
                        <input type="hidden" class="form-control" name="id_siswa" value="<?= $value['id_siswa']; ?>">
                        <input type="hidden" class="form-control" name="id_topik" value="<?= $detail['id_topik']; ?>">
                        <div class="form-group">
                          <label>Masukkan Nilai :</label>
                          <input type="number" class="form-control" id="nilai_jawaban" name="nilai_jawaban" value="<?= isset($value['jawaban']['nilai_jawaban']) ? $value['jawaban']['nilai_jawaban'] : "0"; ?>">
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
                <?php endif; ?>
              <?php endforeach ?>
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