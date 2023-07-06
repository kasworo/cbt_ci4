<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="modal fade" id="myAddKurikulum" aria-modal="true">
                    <form action="/kurikulum/post" method="post">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Kurikulum</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12">
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 offset-sm-1">Pilih Jenjang</label>
                                            <input type="hidden" class="form-control form-control-sm col-sm-6"
                                                id="idkur" name="idkur">
                                            <select class="form-control form-control-sm col-sm-6" id="jenjang"
                                                name="jenjang">
                                                <option value="">..Pilih..</option>
                                                <?php foreach ($jenjang as $jjg) : ?>
                                                <option value="<?php echo $jjg['idjenjang']; ?>">
                                                    <?php echo $jjg['nmjenjang']; ?>
                                                </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 offset-sm-1">Kode Kurikulum</label>
                                            <input type="text" class="form-control form-control-sm col-sm-6" id="akkur"
                                                name="akkur">
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 offset-sm-1">Nama Kurikulum</label>
                                            <input type="text" class="form-control form-control-sm col-sm-6" id="nmkur"
                                                name="nmkur">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-primary btn-md col-4" id="simpan">
                                        <i class=" fas fa-save mr-2"></i>Simpan
                                    </button>
                                    <a href="#" class="btn btn-danger btn-md col-4" data-dismiss="modal">
                                        <i class="fas fa-power-off mr-2"></i>Tutup
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h4 class="card-title">Data Kurikulum</h4>
                        <div class="card-tools">
                            <a href="/home" class="btn btn-default btn-sm">
                                <i class="fas fa-arrow-circle-left mr-2"></i>Kembali
                            </a>
                            <button class="btn btn-success btn-sm" id="btnTambah" data-toggle="modal"
                                data-target="#myAddKurikulum">
                                <i class="fas fa-plus-circle mr-2"></i>Tambah
                            </button>
                            <button data-toggle="modal" data-target="#myAddKurikulum" id="btnUpdate"
                                class="btn btn-secondary btn-sm">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </button>
                            <button class="btn btn-info btn-sm" id="btnDetail">
                                <i class="fas fa-eye mr-2"></i>Detail
                            </button>
                            <button id="hapusall" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_kur" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:12.5%" colspan="2">Kode</th>
                                        <th style="text-align: center">Nama Kurikulum</th>
                                        <th style="text-align: center">Jenjang Pendidikan</th>
                                        <th style="text-align: center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kurikulum as $kur) : ?>
                                    <tr>
                                        <td style="text-align:center;">
                                            <input type="checkbox" class="select-item checkbox" name="pilihan[]"
                                                value="<?php echo $kur['idkur']; ?>">
                                        </td>
                                        <td style="text-align:left">
                                            <?php echo $kur['akkur']; ?>
                                        </td>
                                        <td><?php echo $kur['nmkur']; ?></td>
                                        <td><?php echo $kur['nmjenjang']; ?></td>
                                        <td><?php echo $kur['aktif'] == '1' ? 'Aktif' : 'Non Aktif'; ?>
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
    $(".modal-title").html("Tambah Data Kurikulum");
    $("#simpan").html("<i class='fas fa-save mr-2'></i>Simpan");
    $("#jenjang").val();
    $("#idkur").val();
    $("#nmkur").val();
    $("#akkur").val();
})

$("#btnUpdate").click(function() {
    $(".modal-title").html("Update Data Kurikulum");
    $("#simpan").html("<i class='fas fa-save mr-2'></i>Update");
    let id = idnya[0];
    $.ajax({
        url: "/kurikulum/edit",
        type: "post",
        data: {
            'id': id
        },
        dataType: 'json',
        success: function(isi) {
            $("#jenjang").val(isi.idjenjang);
            $("#idkur").val(isi.idkur);
            $("#nmkur").val(isi.nmkur);
            $("#akkur").val(isi.akkur);
        }
    })
})
$("#btnDetail").click(function() {
    let id = idnya[0];
    window.location.href = "/mapel/" + id
})
</script>
<?php echo $this->endSection(); ?>