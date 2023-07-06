<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="callout callout-warning">
                    <p><strong>Petunjuk</strong><br>Silahkan cek kembali data Peserta Didik, lengkapi dan betulkan
                        jika masih terdapat data salah, kemudian klik tombol
                        <strong><?php echo $tombol; ?></strong>.
                    </p>
                </div>
                <form action="/siswa/post" method="post" enctype="multipart/form-data">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0" id="judul"><?php echo $judul; ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="text-center mt-2">
                                        <img class="img img-fluid img-responsive img-rounded" src="/assets/img/kotakfoto.png" width="50%" id="fotosiswa">
                                        <span id="fotosiswa_status"></span>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row" style="padding-bottom:5px">
                                        <label class="col-sm-5">Asal Sekolah</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" class="form-control form-control-sm" name="idsiswa" id="idsiswa" value="<?php echo $siswa['idsiswa']; ?>">
                                            <select class="form-control form-control-sm" name="aslskul" id="aslskul">
                                                <option value="">..Pilih..</option>
                                                <?php foreach ($skul as $sk) : ?>
                                                    <option value="<?php echo $sk['idskul']; ?>" <?php echo $sk['idskul'] == $siswa['idskul'] ? 'selected' : ''; ?>>
                                                        <?php echo $sk['nmskul']; ?>
                                                    </option>

                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom:5px">
                                        <label class="col-sm-5">Nama Peserta Didik</label>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-sm" name="nmsiswa" id="nmsiswa" autocomplete="off" value="<?php echo $siswa['nmsiswa']; ?>">
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom:5px">
                                        <label class="col-sm-5">NIS</label>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-sm" name="nis" id="nis" autocomplete="off" value="<?php echo $siswa['nis']; ?>">
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom:5px">
                                        <label class="col-sm-5">NISN</label>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-sm" name="nisn" id="nisn" autocomplete="off" value="<?php echo $siswa['nisn']; ?>">
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom:5px">
                                        <label class="col-sm-5">Tempat Lahir</label>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-sm" name="tmplahir" id="tmplahir" autocomplete="off" value="<?php echo $siswa['tmplahir']; ?>">
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom:5px">
                                        <label class="col-sm-5">Tanggal Lahir</label>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-sm" name="tgllahir" id="tgllahir" autocomplete="off" value="<?php echo $siswa['tgllahir']; ?>">
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom:5px">
                                        <label class="col-sm-5">Jenis Kelamin</label>
                                        <div class="col-sm-6">
                                            <select class="form-control form-control-sm" name="gender" id="gender">
                                                <option value="">..Pilih..</option>
                                                <option value="L" <?php echo $siswa['gender'] == 'L' ? 'selected' : ''; ?>>
                                                    Laki-laki
                                                </option>
                                                <option value="P" <?php echo $siswa['gender'] == 'P' ? 'selected' : ''; ?>>
                                                    Perempuan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom:5px">
                                        <label class="col-sm-5">Agama</label>
                                        <div class="col-sm-6">
                                            <select class="form-control form-control-sm" name="agama" id="agama" autocomplete="off">
                                                <option value="">..Pilih..</option>
                                                <option value="A" <?php echo $siswa['agama'] == 'A' ? 'selected' : ''; ?>>
                                                    Islam
                                                </option>
                                                <option value="B" <?php echo $siswa['agama'] == 'B' ? 'selected' : ''; ?>>
                                                    Kristen
                                                </option>
                                                <option value="C" <?php echo $siswa['agama'] == 'C' ? 'selected' : ''; ?>>
                                                    Katholik
                                                </option>
                                                <option value="D" <?php echo $siswa['agama'] == 'D' ? 'selected' : ''; ?>>
                                                    Hindu
                                                </option>
                                                <option value="E" <?php echo $siswa['agama'] == 'E' ? 'selected' : ''; ?>>
                                                    Buddha
                                                </option>
                                                <option value="F" <?php echo $siswa['agama'] == 'F' ? 'selected' : ''; ?>>
                                                    Konghucu
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom:5px">
                                        <label class="col-sm-5">Alamat</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control form-control-sm" name="almt" id="almt" autocomplete="off"><?php echo $siswa['alamat']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm" id="simpan">
                                    <i class="fas fa-fw fa-save mr-2"></i><?php echo $tombol; ?>
                                </button>
                                <a href="/siswa" class="btn btn-sm btn-danger">
                                    <i class="fas fa-fw fa-power-off mr-2"></i>Tutup
                                </a>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>