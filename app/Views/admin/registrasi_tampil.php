<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="modal fade" id="myImportRombel" aria-modal="true">
    <form action="<?php echo base_url('registrasi/impor'); ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Rombel Peserta Didik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="tmprombel">Pilih File Template</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="tmprombel" name="tmprombel">
                                <label class="custom-file-label" for="tmprombel">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
                                    97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="<?php echo base_url('registrasi/ekspor'); ?>" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-download"></i> Download</a>
                    <button type="submit" class="btn btn-primary btn-sm" name="import">
                        <i class="fas fa-upload"></i> Upload
                    </button>
                    <a href="#" type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                        <i class="fas fa-power-off"></i> Tutup
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
<section class="content-wrapper" style="background:url(/assets/img/boxed-bg.png)">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" id="hdTitle">
                        <?php echo $judul; ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><?php echo ucwords($menu); ?></li>
                        <li class="breadcrumb-item"><?php echo ucwords($submenu); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-secondary card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Registrasi Peserta Didik</h4>
                            <div class="card-tools">
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myImportRombel">
                                    <i class="fas fa-cloud-upload-alt mr-2"></i>Import
                                </button>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#myAddRombel" id="btnRegis">
                                    <i class="far fa-check-square mr-2"></i>Registrasi
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tb_rombel" class="table table-condensed table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:20%" colspan="2">Nomor Induk</th>
                                            <th style="text-align: center">Nama Peserta Didik</th>
                                            <th style="text-align: center;width:10%">Rombel</th>
                                            <th style="text-align: center;width:22.5%">Asal Sekolah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($registrasi as $rg) : ?>
                                            <tr>
                                                <td style="text-align:center;">
                                                    <input type="checkbox" class="select-item checkbox" name="pilih" value="<?php echo $rg['idsiswa']; ?>" />
                                                </td>
                                                <td style="text-align:center">
                                                    <?php echo $rg['nis'] . ' / ' . $rg['nisn']; ?>
                                                </td>
                                                <td title="<?php echo $rg['idsiswa']; ?>">
                                                    <?php echo ucwords(strtolower($rg['nmsiswa'])); ?>
                                                </td>
                                                <td style="text-align:center">
                                                    <?php
                                                    if (isset($rg['nmrombel'])) {
                                                        echo $rg['nmrombel'];
                                                    } else {
                                                        echo '<label class="text-danger">Belum Diatur</label>';
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php echo $rg['nmskul']; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $this->endSection(); ?>