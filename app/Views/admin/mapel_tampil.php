<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="modal fade" id="myAddMapel" aria-modal="true">
    <form action="<?php echo base_url('mapel/post'); ?>" method="post">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Mata Pelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 offset-sm-1">Mata Pelajaran</label>
                            <input type="hidden" class="form-control form-control-sm col-sm-6" id="idmapel"
                                name="idmapel">
                            <input type="hidden" class="form-control form-control-sm col-sm-6" id="idkur" name="idkur"
                                value="<?php echo $kurikulum; ?>">
                            <input type="text" class="form-control form-control-sm col-sm-6" id="nmmapel"
                                name="nmmapel">
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 offset-sm-1">Kode</label>
                            <input type="text" class="form-control form-control-sm col-sm-6" id="akmapel"
                                name="akmapel">
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 offset-sm-1">Jenis</label>
                            <select class="form-control form-control-sm col-sm-6" id="jmapel" name="jmapel">
                                <option value="">..Pilih..</option>
                                <option value="0">Umum</option>
                                <option value="1">Agama</option>
                            </select>
                        </div>
                        <div class="form-group row mb-2" id="urutmapel">
                            <label class="col-sm-4 offset-sm-1">Urut</label>
                            <input type="text" class="form-control form-control-sm col-sm-6" id="urmapel"
                                name="urmapel">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary btn-sm col-3" id="simpan">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-danger btn-sm col-3" data-dismiss="modal">
                        <i class="fas fa-power-off"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo $judul; ?></h4>
                        <div class="card-tools">
                            <a href="/kurikulum" class="btn btn-default btn-sm">
                                <i class="fas fa-arrow-circle-left mr-2"></i>Kembali
                            </a>
                            <button class="btn btn-success btn-sm" id="btnTambah" data-toggle="modal"
                                data-target="#myAddMapel">
                                <i class="fas fa-plus-circle mr-2"></i>Tambah
                            </button>
                            <button data-target="#myAddMapel" data-toggle="modal" id="btnUpdate"
                                class="btn btn-secondary btn-sm">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </button>
                            <button id="btnHapus" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_mapel" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:15%;" colspan="2">Kode</th>
                                        <th style="text-align: center;width:25%">Kurikulum</th>
                                        <th style="text-align: center">Mata Pelajaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mapel as $m) : ?>
                                    <tr>
                                        <td style="text-align:center;">
                                            <input type="checkbox" class="select-item checkbox" name="pilihan[]"
                                                value="<?php echo $m['idmapel']; ?>">
                                        </td>
                                        <td style="text-align:left;border-left:none"><?php echo $m['akmapel']; ?>
                                        </td>
                                        <td style="text-align:left"><?php echo $m['nmkur']; ?></td>
                                        <td><?php echo $m['nmmapel']; ?></td>
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

$("#btnTambah").click(function() {
    $(".modal-title").html("Tambah Data Mata Pelajaran");
    $("#simpan").html("<i class='fas fa-save mr-2'></i>Simpan");
})

$("#btnUpdate").click(function() {
    $(".modal-title").html("Update Data Mata Pelajaran");
    $("#simpan").html("<i class='fas fa-save mr-2'></i>Update");
    let id = idnya[0];
    $.ajax({
        url: "/mapel/edit",
        type: "post",
        data: {
            'id': id
        },
        dataType: 'json',
        success: function(isi) {
            $("#idmapel").val(isi.idmapel);
            $("#kdkur").val(isi.idkur);
            $("#nmmapel").val(isi.nmmapel);
            $("#akmapel").val(isi.akmapel);
            $("#jmapel").val(isi.jenis);
            $("#urmapel").val(isi.urut);
            $("#urutmapel").css('display', 'none');
        }
    })
})
</script>
<?php echo $this->endSection(); ?>