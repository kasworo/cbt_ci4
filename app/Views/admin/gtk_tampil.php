<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="modal fade" id="myImportgtk" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Guru dan Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="tmpgtk">Pilih File Template</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="tmpgtk" name="tmpgtk">
                                <label class="custom-file-label" for="tmpgtk">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
                                    97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="gtk_template.php" class="btn btn-success btn-sm" target="_blank">
                        <i class="fas fa-download"></i> Download</a>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-upload"></i>
                        Upload</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i
                            class="fas fa-power-off"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Guru dan Tenaga Kependidikan</h4>
                        <div class="card-tools">
                            <a href="/gtk/baru" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus-circle mr-2"></i>Tambah
                            </a>
                            <button class="btn btn-default btn-sm" id="btnUpdate">
                                <i class="far fa-edit mr-2"></i>Edit
                            </button>
                            <button class="btn btn-success btn-sm" id="btnAkun">
                                <i class="far fa-check-square mr-2"></i>Aktifkan
                            </button>
                            <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#myImportgtk">
                                <i class="fas fa-cloud-upload-alt mr-2"></i>Import
                            </button>
                            <button id="hapusall" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;" width="27.5%" colspan="2">NIP / NIK</th>
                                        <th style="text-align: center;">Nama Lengkap</th>
                                        <th style="text-align: center;width:12.5%">Gender</th>
                                        <th style="text-align: center;" width="22.5%">Sekolah Asal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 0;
                                        foreach ($gtk as $s) :
                                            $no++;
                                        ?>
                                    <tr>
                                        <td style="text-align:center;">
                                            <input type="checkbox" class="select-item checkbox" name="pilihan[]"
                                                value="<?php echo $s['idgtk']; ?>" />
                                        </td>
                                        <td>
                                            <?php
                                                    if ($s['kepeg'] == '1') {
                                                        echo $s['nip'];
                                                    } else {
                                                        echo $s['nik'];
                                                    }
                                                    ?>
                                        </td>
                                        <td><?php echo $s['nama']; ?></td>
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
    window.location.href = "/gtk/edit/" + id
})
</script>
<?php echo $this->endSection(); ?>