<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login E-learning SMK Piri 1 Yk</title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

</head>

<body class="bg-gradient-success">
    <div class="container">
        <!-- Luar form Luar -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body ">
                        <!-- Form -->
                        <div class="row">
                            <div class="col">
                                <div class="p-3">
                                    <div class="text-center">
                                        <img src="<?= base_url('assets/img/favicon.png'); ?>" class="mb-3" width="100" alt="E-learning SMK Piri 1 YK">
                                        <h1 class="h4 text-gray-900 mb-0">LOGIN</h1>
                                        <h2 class="h6 text-gray-700 mb-3">E-learning SMK Piri 1 Yogyakarta</h2>
                                    </div>
                                    <div class="class">
                                        <!-- pesan error -->
                                        <?php if ($this->session->flashdata('pesan')) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= $this->session->flashdata('pesan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <form method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukan NIP/NIS/Username Anda" name="username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Masukan Password Anda" name="password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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