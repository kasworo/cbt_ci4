<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Aplikasi NewCBT Lite</title>
        <link href='/assets/img/tutwuri.png' rel='icon' type='image/png' />
        <link rel="stylesheet" href="/assets/css/all.min.css">
        <link rel="stylesheet" href="/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="/assets/css/adminlte.min.css">
        <link rel="stylesheet" href="/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <link rel="stylesheet" href="/assets/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/jquery.datetimepicker.css">
        <script src="/assets/js/jquery-2.0.3.js"></script>
        <script type="text/javascript" src="/assets/js/ajaxupload.3.6.js"></script>
        <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
    </head>

    <body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <main class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link pb-1" style="font-size: 14pt;font-weight:bold" id="jam">

                        </span>
                    </li>
                    <li class="nav-item">
                        <a href="/logout" class="nav-link">
                            <i class="fas fa-power-off"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="/home" class="brand-link" title="NewCBT Lite">
                    <img src="/assets/img/logo.png" width="100" class="brand-image elevation-3" style="opacity: 1.0">
                    <span class="brand-text font-weight-light">NewCBT Lite</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="/assets/img/nouser.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">
                                <?php echo session()->get('nama'); ?>
                            </a>
                        </div>
                    </div>
                    <?php echo $this->include('layout/sidemenu'); ?>
                </div>
            </aside>
            <section class="content-wrapper" style="background:url(/assets/img/boxed-bg.png)">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h4 class="m-0 text-dark" id="hdTitle">
                                    <?php echo $judul; ?>
                                </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><?php echo ucwords($menu); ?></li>
                                    <li class="breadcrumb-item"><?php echo ucwords($submenu); ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <?php echo $this->renderSection('content'); ?>

            </section>
            <footer class="main-footer text-sm">
                <strong>Copyright &copy;</strong> Kasworo Wardani, Template By <a
                    href="http://adminlte.io">AdminLTE.io</a>.
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>CBTSync Versi</b> 2.0.0 Lite
                </div>
            </footer>
        </main>
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
            bsCustomFileInput.init()
        })
        </script>
        <script src="/assets/js/jquery.js"></script>
        <script src="/assets/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/adminlte.min.js"></script>
        <script src="/assets/plugins/toastr/toastr.min.js"></script>
        <script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="/assets/plugins/select2/js/select2.full.min.js"></script>
        <script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
        </script>
        <script src="/assets/js/jquery.datetimepicker.full.js"></script>
        <script src="/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js">
        </script>
        <script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
        </script>
        <script src="/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script>
        function updateTime() {
            let currentTime = new Date();
            let hours = currentTime.getHours();
            let minutes = currentTime.getMinutes();
            let seconds = currentTime.getSeconds();
            hours = (hours < 10 ? "0" : "") + hours;
            minutes = (minutes < 10 ? "0" : "") + minutes;
            seconds = (seconds < 10 ? "0" : "") + seconds;
            $('#jam').html(hours + ":" + minutes + ":" + seconds);
        }
        setInterval(updateTime, 1000);
        </script>
        <script>
        $(function() {
            $('.table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            })
        });
        </script>
        <script>
        <?php if (session()->getFlashdata('gagal')) : ?>
        toastr.error('<?php echo session()->getFlashdata('gagal'); ?>');
        <?php endif; ?>
        <?php if (session()->getFlashdata('info')) : ?>
        toastr.info('<?php echo session()->getFlashdata('info'); ?>');
        <?php endif; ?>
        <?php if (session()->getFlashdata('sukses')) : ?>
        toastr.success('<?php echo session()->getFlashdata('sukses'); ?>');
        <?php endif; ?>
        </script>
    </body>

</html>