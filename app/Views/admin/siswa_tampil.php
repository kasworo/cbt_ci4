<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Peserta Didik</h4>
                        <div class="card-tools">
                            <a href="/siswa/baru" class="btn btn-primary btn-sm" id="btnTambah">
                                <i class="fas fa-plus-circle mr-2"></i>Tambah
                            </a>
                            <button class="btn btn-default btn-sm" id="btnUpdate">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </button>
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myImportPD">
                                <i class="fas fa-cloud-upload-alt mr-2"></i>Import
                            </button>
                            <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#myFotoPD">
                                <i class="fas fa-upload mr-2"></i>Foto
                            </button>
                            <button id="btnHapus" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_siswa" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:17.5%" colspan="2">NISN</th>
                                        <th style="text-align: center;width:35%">Nama Peserta</th>
                                        <th style="text-align: center;width:12.5%">Gender</th>
                                        <th style="text-align: center;">Asal Sekolah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($siswa as $s) :

                                        ?>
                                    <tr>
                                        <td style="text-align:center;">
                                            <input type="checkbox" class="select-item checkbox" name="pilihan[]"
                                                value="<?php echo $s['idsiswa']; ?>">
                                        </td>
                                        <td><?php echo $s['nisn']; ?></td>
                                        <td><?php echo ucwords(strtolower($s['nmsiswa'])); ?></td>
                                        <td><?php echo $s['gender'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
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

<script type="text/javascript">
$(document).ready(function() {
    $("#btnTambah").show()
    $("#btnUpdate").hide()
    $("#btnHapus").hide()
})
$('input[name="pilihan[]"]').change(function() {
    idnya = []
    $.each($('input[name="pilihan[]"]:checked'), function() {
        idnya.push($(this).val())
    })
    if (idnya.length == 1) {
        $("#btnTambah").hide()
        $("#btnUpdate").show()
        $("#btnHapus").show()
    } else if (idnya.length > 1) {
        $("#btnTambah").hide()
        $("#btnUpdate").hide()
        $("#btnHapus").show()
    } else {
        $("#btnTambah").show()
        $("#btnIsi").hide()
        $("#btnHapus").hide()
    }
})
$("#btnUpdate").click(function(e) {
    e.preventDefault()
    let id = idnya[0]
    window.location.href = "/siswa/edit/" + id
})
</script>
<?php echo $this->endSection(); ?>