<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?> E-learning SMK Piri 1 Yk</title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

</head>

<body class="bg bg-dark">
    <div class="text-center my-5 py-5">
        <h1 class="error text-center mx-auto m-3" data-text="404">404</h1>
        <h5 class="text-light p-2">Halaman tidak ditemukan</h5>
        <?php if (!empty($this->session->userdata("petugas"))) { ?>
            <a href="<?= base_url('petugas/logout'); ?>" class="btn btn-secondary font-weight-bold">KEMBALI</a>
        <?php } elseif (!empty($this->session->userdata("guru"))) { ?>
            <a href="<?= base_url('guru/logout'); ?>" class="btn btn-secondary font-weight-bold">KEMBALI</a>
        <?php } elseif (!empty($this->session->userdata("siswa"))) {  ?>
            <a href="<?= base_url('siswa/logout'); ?>" class="btn btn-secondary font-weight-bold">KEMBALI</a>
        <?php } else { ?>
            <a href="<?= base_url('petugas/logout'); ?>" class="btn btn-secondary font-weight-bold">KEMBALI</a>
        <?php } ?>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

</body>

</html>