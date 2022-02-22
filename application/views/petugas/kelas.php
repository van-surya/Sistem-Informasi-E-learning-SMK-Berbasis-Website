<!-- Begin Page Content -->
<div class="container-fluid">
    <!--breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>
    <!--Card-->
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
            <!--tabel-->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kelas as $key => $value) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $value["jenjang"]; ?> <?= $value["singkatan_jurusan"]; ?> <?= $value["rombel"]; ?> </td>
                                <td><?= $value["nama_jurusan"]; ?> </td>
                                <td>
                                    <div class="text-center">
                                        <!-- Button trigger -->
                                        <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#ubahdata-<?= $value['id_kelas'] ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                            <span class="text">Ubah</span>
                                        </button>
                                        <a href="" class="btn btn-danger btn-icon-split btn-sm btn-hapus" idnya="<?= $value['id_kelas']; ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Ubah-->
                            <div class="modal fade modal-ubah" idk="<?= $value['id_kelas']; ?>" id="ubahdata-<?= $value['id_kelas'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <?= form_open_multipart('petugas/kelas/ubah/' . $value['id_kelas']) ?>
                                            <div class="form-group">
                                                <label>Jenjang</label>
                                                <select class="custom-select" name="jenjang">
                                                    <option value="X" <?php if ($value['jenjang'] == 'X') {
                                                                            echo "selected";
                                                                        } ?>>X</option>
                                                    <option value="XI" <?php if ($value['jenjang'] == 'XI') {
                                                                            echo "selected";
                                                                        } ?>>XI</option>
                                                    <option value="XII" <?php if ($value['jenjang'] == 'XII') {
                                                                            echo "selected";
                                                                        } ?>>XII</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Jurusan</label>
                                                <select name="id_jurusan" class="form-control">
                                                    <?php foreach ($jurusan as $val) : ?>
                                                        <option <?php if ($val['id_jurusan'] == $value['id_jurusan']) {
                                                                    echo "selected";
                                                                } ?> value="<?= $val['id_jurusan'] ?>" kode="<?= $val['kode_jurusan']; ?>"><?= $val['singkatan_jurusan'] ?> | <?= $val['nama_jurusan'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Rombel</label>
                                                <input type="text" class="form-control" id="rombel" name="rombel" value="<?= $value['rombel'] ?>">
                                            </div>
                                            <input type="hidden" class="form-control" id="kode_kelas" name="kode_kelas" value="<?= $value['kode_kelas'] ?>">
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
                <?= form_open_multipart('petugas/kelas/tambah') ?>
                <div class="form-group">
                    <label>Jenjang</label>
                    <select class="form-control" name="jenjang">
                        <option>--Pilih Jenjang--</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jurusan</label>
                    <select name="id_jurusan" class="form-control">
                        <option value="">--Pilih Jurusan--</option>
                        <?php foreach ($jurusan as $value) : ?>
                            <option value="<?= $value['id_jurusan'] ?>" kode="<?= $value['kode_jurusan'] ?>"><?= $value['singkatan_jurusan'] ?> | <?= $value['nama_jurusan'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Rombel</label>
                    <input type="text" class="form-control" id="rombel" name="rombel" placeholder="Masukan Rombel">
                </div>
                <input type="hidden" class="form-control" id="kode_kelas" name="kode_kelas">
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
                    text: " untuk menghapus data ini",
                    icon: "warning",
                    buttons: ["Batal", "Hapus!"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        //disini ajax hapus data
                        $.ajax({
                            type: 'post',
                            url: "<?= base_url("petugas/kelas/hapus_kelas"); ?>",
                            data: 'id=' + idnya,
                            success: function() {

                                swal("Data berhasil terhapus!", {
                                    icon: "success",
                                    button: true
                                }).then((oke) => {
                                    if (oke) {
                                        location = "<?= base_url("petugas/kelas/"); ?>"
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
            var idk = $(this).attr("idk");
            $.ajax({
                type: 'post',
                url: "<?= base_url("petugas/kelas/terpilih"); ?>",
                data: 'id=' + idk,
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
            $("#ubahdata-<?= $this->session->userdata("kelas_terpilih"); ?>").modal("show");
        })
    </script>
<?php endif; ?>

<!-- script tambah kelas  -->
<script>
    $(document).ready(function() {
        $("#tambah_data input[name=rombel]").on("keyup", function() {
            var rombel = $(this).val();
            var kode = $("#tambah_data select[name=id_jurusan]").find(":selected").attr("kode");
            var jenjang = $("#tambah_data select[name=jenjang]").find(":selected").val();
            var kode_kelas = kode + jenjang + rombel;
            $("#tambah_data input[name=kode_kelas]").val(kode_kelas);
        })
    })
</script>

<script>
    $(document).ready(function() {

        $("select[name=id_jurusan], select[name=jenjang]").on("change", function() {
            var kode = $(".show select[name=id_jurusan]").find(":selected").attr("kode");
            var jenjang = $(".show select[name=jenjang]").find(":selected").val();
            var rombel = $(".show input[name=rombel]").val();

            kode_kelas = kode + jenjang + rombel;

            $(".show input[name=kode_kelas]").val(kode_kelas);
        });

        $("input[name=rombel]").on("keyup", function() {
            var kode = $(".show select[name=id_jurusan]").find(":selected").attr("kode");
            var jenjang = $(".show select[name=jenjang]").find(":selected").val();
            var rombel = $(".show input[name=rombel]").val();

            kode_kelas = kode + jenjang + rombel;

            $(".show input[name=kode_kelas]").val(kode_kelas);
        });
    })
</script>