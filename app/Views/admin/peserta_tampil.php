<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="modal fade" id="mySetNopes" aria-modal="true">
    <form id="frmNopes" action="/peserta/generate" method="post">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generate Peserta Ujian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row mb-2 mt-2">
                        <label class="col-sm-4 offset-sm-1">Pilih Ujian</label>
                        <select class="form-control form-control-sm col-sm-6" id="idujian" name="idujian">
                            <option value="">..Pilih..</option>
                            <?php foreach ($ujian as $uji) : ?>
                            <option value="<?php echo $uji['idujian']; ?>"><?php echo $uji['nmujian']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 offset-sm-1">Pilih Sekolah</label>
                        <select class="form-control form-control-sm col-sm-6" id="idskul" name="idskul">
                            <option value="">..Pilih..</option>
                            <?php foreach ($sekolah as $skul) : ?>
                            <option value="<?php echo $skul['idskul']; ?>"><?php echo $skul['nmskul']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 offset-sm-1">Pilih Kelas</label>
                        <div class="col-sm-6 justify-content-between">
                            <?php foreach ($kelas as $kl) : ?>
                            <div class="form-check row">
                                <input class="form-check-input kelas" type="checkbox" name="idkls[]"
                                    value="<?php echo $kl['idkelas']; ?>">
                                <label class="form-check-label"><?php echo $kl['nmkelas']; ?></label>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 offset-sm-1">Jumlah Ruang</label>
                        <input type="number" class="form-control form-control-sm col-sm-6" name="ruang" id="ruang">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary btn-sm col-3" id="simpan">
                        <i class="fas fa-save"></i> Generate
                    </button>
                    <button type="button" class="btn btn-danger btn-sm col-3" data-dismiss="modal">
                        <i class="fas fa-power-off"></i> Tutup
                    </button>
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
                            <h4 class="card-title">Data Peserta Ujian</h4>
                            <div class="card-tools">
                                <button class="btn btn-primary btn-sm" data-target="#mySetNopes" data-toggle="modal">
                                    <i class="fas fa-sync-alt mr-2"></i>Generate
                                </button>
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#mySetRuang"
                                    id="btnRuang">
                                    <i class="fas fa-list mr-2"></i>Set Ruang
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tb_siswa" class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center" width="17.5%" colspan="2">Username</th>
                                            <th style="text-align:center">Nama Peserta</th>
                                            <th style="text-align:center" width="15%">Password</th>
                                            <th style="text-align:center" width="15%">Kelas</th>
                                            <th style="text-align:center" width="22.5%">Asal Sekolah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($peserta as $s) :
                                        ?>
                                        <tr>
                                            <td align="center">
                                                <input type="checkbox" class="select-item checkbox" name="pilihan[]"
                                                    value="<?php echo $s['idsiswa']; ?>">
                                            </td>
                                            <td><?php echo IS_NULL($s['nmpeserta']) ? $s['nisn'] : $s['nmpeserta']; ?>
                                            </td>
                                            <td><?php echo ucwords(strtolower($s['nmsiswa'])); ?><span
                                                    class="float-right badge <?php echo $s['aktif'] == '1' ? 'badge-success' : 'badge-danger'; ?>"><?php echo $s['aktif'] == '1' ? 'aktif' : 'nonaktif'; ?></span>
                                            </td>
                                            <td align="center"><?php echo $s['passwd']; ?></td>
                                            <td align="center"><?php echo $s['nmrombel']; ?></td>
                                            <td><?php echo $s['nmskul']; ?></td>
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
<script>
$(document).ready(function() {
    $("#btnGenerate").show()
    $("#btnRuang").hide()
})
$("#idskul").change(function() {
    let data = new FormData()
    data.append('id', $(this).val())
    $.ajax({
        url: "/peserta/getkelas",
        type: 'post',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 8000,
        success: function(msg) {
            $("#idkls").html(msg)
        }
    })
})

$('input[name="pilihan[]"]').change(function() {
    idnya = []
    $.each($('input[name="pilihan[]"]:checked'), function() {
        idnya.push($(this).val())
    })
    if (idnya.length >= 1) {
        $("#btnGenerate").hide()
        $("#btnRuang").show()
    } else {
        $("#btnGenerate").show()
        $("#btnRuang").hide()
    }
})

$("#btnRuang").click(function() {
    $("#peserta").val(idnya)
})
</script>
<?php echo $this->endSection(); ?>