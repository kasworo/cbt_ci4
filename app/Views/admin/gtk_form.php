<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
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
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="callout callout-warning">
                    <p><strong>Petunjuk</strong><br />
                        <?php if ($tombol == 'Simpan') : ?>
                            Isikan data GTK dengan lengkap dan benar, kemudian klik tombol
                            <strong><?php echo $tombol; ?>
                            <?php else : ?>
                                Silahkan cek kembali data GTK, lengkapi dan betulkan jika masih terdapat data yang masih
                                kurang atau salah, kemudian klik tombol <strong><?php echo $tombol; ?></strong>
                            <?php endif ?>
                    </p>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Form Guru dan Tenaga Kependidikan</h5>
                    </div>
                    <form action="/gtk/post" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div style="text-align:center;margin-top:10px">
                                        <img class="img img-responsive img-circle" id="fotogtk" src="/assets/img/avatar.gif" width="100%">
                                        <input type="hidden" name="fotolama" id="fotolama">
                                    </div>
                                    <div style="text-align:center;margin-top:10px">
                                        <img class="img img-responsive img-rounded" id="ttdgtk" src="/assets/img/nofile.png" width="100%">
                                        <input type="hidden" name="ttdlama" id="ttdlama">
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Pilih Sekolah</label>
                                        <div class="col-sm-5">
                                            <select class="form-control form-control-sm" name="idskul" id="idskul">
                                                <option value="">..Pilih..</option>
                                                <?php foreach ($skul as $sk) : ?>
                                                    <option value="<?php echo $sk['idskul']; ?>" <?php echo $sk['idskul'] == $gtk['idskul'] ? 'selected' : ''; ?>>
                                                        <?php echo $sk['nmskul']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Nama Lengkap</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" class="form-control form-control-sm" name="idgtk" id="idgtk" value="<?php echo $gtk['idgtk']; ?>">
                                            <input class="form-control form-control-sm" name="nmgtk" id="nmgtk" value="<?php echo $gtk['nama']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">N I K</label>
                                        <div class="col-sm-5">
                                            <input class="form-control form-control-sm" name="nik" id="nik" onkeyup="validAngka(this)" value="<?php echo $gtk['nik']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">N I P</label>
                                        <div class="col-sm-5">
                                            <input class="form-control form-control-sm" name="nip" id="nip" value="<?php echo $gtk['nip']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Tempat Lahir</label>
                                        <div class="col-sm-5">
                                            <input class="form-control form-control-sm" name="tmplahir" id="tmplahir" value="<?php echo $gtk['tmplahir']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Tanggal Lahir</label>
                                        <div class="col-sm-5">
                                            <input class="form-control form-control-sm" name="tgllahir" id="tgllahir" value="<?php echo $gtk['tgllahir']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Jenis Kelamin</label>
                                        <div class="col-sm-5">
                                            <select class="form-control form-control-sm" name="gender" id="gender">
                                                <option value="">..Pilih..</option>
                                                <option value="L" <?php echo $gtk['gender'] == 'L' ? 'selected' : ''; ?>>Laki-laki
                                                </option>
                                                <option value="P" <?php echo $gtk['gender'] == 'P' ? 'selected' : ''; ?>>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Agama</label>
                                        <div class="col-sm-5">
                                            <select class="form-control form-control-sm" name="agama" id="agama">
                                                <option value="">..Pilih..</option>
                                                <option value="A" <?php echo $gtk['agama'] == 'A' ? 'selected' : ''; ?>>
                                                    Islam
                                                </option>
                                                <option value="B" <?php echo $gtk['agama'] == 'B' ? 'selected' : ''; ?>>
                                                    Kristen
                                                </option>
                                                <option value="C" <?php echo $gtk['agama'] == 'C' ? 'selected' : ''; ?>>
                                                    Katholik
                                                </option>
                                                <option value="D" <?php echo $gtk['agama'] == 'D' ? 'selected' : ''; ?>>
                                                    Hindu
                                                </option>
                                                <option value="E" <?php echo $gtk['agama'] == 'E' ? 'selected' : ''; ?>>
                                                    Buddha
                                                </option>
                                                <option value="F" <?php echo $gtk['agama'] == 'F' ? 'selected' : ''; ?>>
                                                    Konghucu
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Status Kepegawaian</label>
                                        <div class="col-sm-5">
                                            <select class="form-control form-control-sm" name="stsp" id="stsp">
                                                <option value="">..Pilih..</option>
                                                <option value="1" <?php echo $gtk['kepeg'] == '1' ? 'selected' : ''; ?>>
                                                    Aparatur
                                                    Sipil Negara</option>
                                                <option value="2" <?php echo $gtk['kepeg'] == '2' ? 'selected' : ''; ?>>
                                                    GTT/PTT
                                                    Kabupaten</option>
                                                <option value="3" <?php echo $gtk['kepeg'] == '3' ? 'selected' : ''; ?>>
                                                    GTT/PTT
                                                    Komite</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Jabatan Dinas</label>
                                        <div class="col-sm-5">
                                            <select class="form-control form-control-sm" name="jbtd" id="jbtd">
                                                <option value="">..Pilih..</option>
                                                <option value="1" <?php echo $gtk['jbtdinas'] == '1' ? 'selected' : ''; ?>>Kepala
                                                    Sekolah</option>
                                                <option value="2" <?php echo $gtk['jbtdinas'] == '2' ? 'selected' : ''; ?>>Wakil
                                                    Kepala Sekolah</option>
                                                <option value="3" <?php echo $gtk['jbtdinas'] == '3' ? 'selected' : ''; ?>>Guru
                                                    Bidang Studi</option>
                                                <option value="4" <?php echo $gtk['jbtdinas'] == '4' ? 'selected' : ''; ?>>Guru
                                                    BP/BK</option>
                                                <option value="5" <?php echo $gtk['jbtdinas'] == '5' ? 'selected' : ''; ?>>Tenaga
                                                    Administrasi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Alamat</label>
                                        <div class="col-sm-5">
                                            <textarea class="form-control form-control-sm" name="almt" id="almt"><?php echo $gtk['alamat']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Kode Pos</label>
                                        <div class="col-sm-5">
                                            <input class="form-control form-control-sm" name="kdpos" id="kdpos" value="<?php echo $gtk['kdpos']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Nomor HP</label>
                                        <div class="col-sm-5">
                                            <input class="form-control form-control-sm" name="nohp" id="nohp" value="<?php echo $gtk['nohp']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Alamat E-mail</label>
                                        <div class="col-sm-5">
                                            <input type="email" class="form-control form-control-sm" name="imel" id="imel" value="<?php echo $gtk['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Foto</label>
                                        <div class="col-sm-5">
                                            <input type="file" class="col-sm-12" id="foto" name="foto">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 offset-sm-1">Tanda Tangan</label>
                                        <div class="col-sm-5">
                                            <input type="file" class="col-sm-12" id="ttd" name="ttd">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-md ml-2" name="simpan">
                                <i class="fas fa-fw fa-save mr-2"></i><?php echo $tombol; ?>
                            </button>
                            <a href="/gtk" class="btn btn-md btn-danger ml-2">
                                <i class="fas fa-fw fa-power-off mr-2"></i>Tutup
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>