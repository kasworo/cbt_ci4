<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-warning">
                    <p><strong>Petunjuk</strong><br>Silahkan cek kembali data Satuan Pendidikan, lengkapi dan
                        betulkan jika masih terdapat data salah, kemudian klik tombol
                        <strong><?php echo $tombol; ?></strong>.
                    </p>
                </div>
                <div class="card card-secondary card-outline">
                    <form action="/sekolah/post" method="post" enctype="multipart/form-data" id="frmSekolah">
                        <div class="card-header">
                            <h4 class="card-title">Form Satuan Pendidikan</h4>
                        </div>
                        <div class="card-body">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row mb-2">
                                <div class="col-sm-8">
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Jenjang Pendidikan</label>
                                        <input type="hidden" id="idskul" name="idskul" value="<?php echo $sekolah['idskul']; ?>">
                                        <select class="form-control form-control-sm col-sm-6" id="idjjg" name="idjjg">
                                            <option value="">..Pilih..</option>
                                            <option value="1" <?php echo $sekolah['idjenjang'] == '1' ? 'selected' : ''; ?>>
                                                SD/MI
                                                Sederajat</option>
                                            <option value="2" <?php echo $sekolah['idjenjang'] == '2' ? 'selected' : ''; ?>>
                                                SMP/MTs
                                                Sederajat</option>
                                            <option value="3" <?php echo $sekolah['idjenjang'] == '3' ? 'selected' : ''; ?>>
                                                SMA/MA
                                                Sederajat</option>
                                            <option value="4" <?php echo $sekolah['idjenjang'] == '4' ? 'selected' : ''; ?>>
                                                SMK/MAK
                                                Sederajat</option>
                                        </select>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Kode Satuan Pendidikan</label>
                                        <input type="text" class="form-control form-control-sm col-sm-6" id="kode" name="kode" value="<?php echo $sekolah['kdskul']; ?>" placeholder="Kode Satuan Pendidikan">
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Nama Satuan Pendidikan</label>
                                        <input type="text" class="form-control form-control-sm col-sm-6" id="nama" name="nama" value="<?php echo $sekolah['nmskul']; ?>" placeholder="Nama Satuan Pendidikan">
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">NPSN</label>
                                        <input type="text" class="form-control form-control-sm col-sm-6" id="npsn" name="npsn" value="<?php echo $sekolah['npsn']; ?>" placeholder="N P S N">
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">No. Statistik Sekolah</label>
                                        <input type="text" class="form-control form-control-sm col-sm-6" id="nss" name="nss" value="<?php echo $sekolah['nss']; ?>" placeholder="Nomor Statistik Sekolah">
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Nama SKPD</label>
                                        <input type="text" class="form-control form-control-sm col-sm-6" id="skpd" name="skpd" value="<?php echo $sekolah['nmskpd']; ?>" placeholder="Nama SKPD atau Yayasan">
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Alamat</label>
                                        <textarea class="form-control form-control-sm col-sm-6" id="almt" name="almt" placeholder="Isikan Alamat Lengkap Satuan Pendidikan"><?php echo $sekolah['alamat']; ?></textarea>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Kode Pos</label>
                                        <input type="text" class="form-control form-control-sm col-sm-6" id="kdpos" name="kdpos" value="<?php echo $sekolah['kdpos']; ?>" placeholder="Kode Pos">
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Website</label>
                                        <input type="text" class="form-control form-control-sm col-sm-6" id="web" name="web" value="<?php echo $sekolah['website']; ?>" placeholder="Website Satuan Pendidikan">
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">E-mail</label>
                                        <input type="text" class="form-control form-control-sm col-sm-6" id="imel" name="imel" value="<?php echo $sekolah['email']; ?>" placeholder="Email Satuan Pendidikan">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="card card-gray-dark">
                                                <div class="card-body">
                                                    <div style="text-align:center" id="logoskul" data-id="<?php echo $sekolah['idskul']; ?>">
                                                        <img src="<?php echo base_url('assets/img/tutwuri.png'); ?>" class="img img-responsive img-rounded" height="140px">
                                                        <span id="logoskul_status"></span>
                                                        <input type="hidden" name="logoskullama" id="logoskullama" value="<?php echo $sekolah['logoskul']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-sm-10">
                                            <div class="card card-secondary">
                                                <div class="card-body">
                                                    <div style="text-align:center" id="logoskpd">
                                                        <img src="<?php echo base_url('assets/img/nofile.png'); ?>" class=" img img-responsive img-rounded" height="140px">
                                                        <input type="hidden" name="logoskpdlama" id="logoskpdlama" value="<?php echo $sekolah['logoskpd']; ?>">
                                                        <span id="logoskpd_status"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-fw fa-save mr-2"></i><?php echo $tombol; ?></button>
                            <a href="<?php echo base_url('home'); ?>" class="btn btn-danger btn-sm ">
                                <i class="fas fa-fw fa-power-off mr-2"></i>Tutup</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>