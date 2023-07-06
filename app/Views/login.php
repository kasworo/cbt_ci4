<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Aplikasi NewCBT Lite</title>
        <link href='assets/img/tutwuri.png' rel='icon' type='image/png' />
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="assets/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/css/adminlte.min.css">
        <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <script type="text/javascript" src="assets/js/jquery-2.0.3.js"></script>
        <script type="text/javascript">
        function disableBackButton() {
            window.history.forward();
        }
        </script>
    </head>

    <body class="hold-transition layout-top-nav layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
                <div class="navbar-brand">
                    <img src="assets/img/logo.png" class="brand-image elevation-3">
                    <span class="brand-text">NewCBT Lite</span>
                </div>
            </nav>
            <div class="content-wrapper" style="background:url(assets/img/boxed-bg.png);height: auto;">
                <div class="content">
                    <div class="content-header"></div>
                    <div class="container-fluid">
                        <div class="card rounded-0 overflow-hidden shadow-none border mb-lg-0">
                            <div class="row">
                                <div
                                    class="col-12 order-1 col-xl-8 d-sm-flex d-lg-flex d-none align-items-center justify-content-center border-end">
                                    <img src="/assets/img/bg2023.jpg" width="auto" class="img-fluid" alt="">
                                </div>
                                <div class="col-12 col-xl-4 order-xl-2">
                                    <div class="card-body login-card-body p-4 p-sm-5">
                                        <h4 class="mt-4"><strong>Selamat Datang</strong></h4>
                                        <p class="card-text mb-4">Silahkan Login Untuk Memulai Aplikasi</p>
                                        <form action="<?php echo base_url('login/ceklogin'); ?>" method="post"
                                            id="FrmLogin">
                                            <fieldset>
                                                <div class="form-group row mb-3 px-3">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Username"
                                                            id="user" name="user" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-user"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3 px-3">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control"
                                                            placeholder="Password" id="pass" name="pass"
                                                            autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-eye" id="viewpass"
                                                                    style="cursor: pointer;"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" row form-group mt-3 px-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="ingat"
                                                            name="ingat">
                                                        <label for="ingat" class="custom-control-label">Remember
                                                            me</label>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row form-group px-3">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                                                    </button>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="main-footer text-sm">
                <div class="float-right d-none d-sm-inline">
                    Created By Kasworo Wardani, S.T
                </div>
                <strong>Copyright &copy; 2023.</strong> All
                rights reserved.
            </footer>
        </div>
        <script src="assets/js/jquery.js"></script>
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <script src="assets/js/jquery.countdownTimer.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/adminlte.min.js"></script>
        <script src="assets/plugins/toastr/toastr.min.js"></script>
        <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js">
        </script>
        <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="assets/plugins/jquery-validation/additional-methods.min.js"></script>
        <script src="assets/plugins/mousetrap/mousetrap.min.js"></script>
        <script src="assets/js/jquery.jfontsize-1.0.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "500",
                "hideDuration": "3000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            $("#viewpass").click(function() {
                let x = $("#pass").attr('type');
                if (x === 'password') {
                    $(this).removeClass("fas fa-eye");
                    $(this).addClass("fas fa-eye-slash");
                    $(this).attr("title", "Sembunyikan Password");
                    $("#pass").attr('type', 'text');
                } else {
                    $(this).removeClass("fas fa-eye-slash");
                    $(this).attr("title", "Tampilkan Password");
                    $(this).addClass("fas fa-eye");
                    $("#pass").attr('type', 'password');
                }
            })
        })
        </script>
        <script>
        <?php if (session()->getFlashdata('gagal')) : ?>
        toastr.error('<?php echo session()->getFlashdata('gagal'); ?>', 'Mohon Maaf');
        <?php endif; ?>
        </script>
    </body>

</html>