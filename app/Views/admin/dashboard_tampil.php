<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info">
                                <i class="fas fa-school"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Satuan Pendidikan</span>
                                <span class="info-box-number">
                                    <h4><?php echo $isi['skul']; ?></h4>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success">
                                <i class="fas fa-user-graduate"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Guru dan Staff</span>
                                <span class="info-box-number">
                                    <h4><?php echo $isi['guru']; ?></h4>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-secondary">
                                <i class="far fa-user"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Peserta Didik</span>
                                <span class="info-box-number">
                                    <h4><?php echo $isi['siswa']; ?></h4>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger">
                                <i class="fas fa-home"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Rombel</span>
                                <span class="info-box-number">
                                    <h4><?php echo $isi['rombel']; ?></h4>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h4 class="card-title">Statistik Tes</h4>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h4 class="card-title">Riwayat Login</h4>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>