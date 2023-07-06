<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="modal fade" id="myAddKelas" aria-modal="true">
    <form action="<?php echo base_url('rombel/post'); ?>" method="post">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Rombongan Belajar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Pilih Sekolah</label>
                            <div class="col-sm-6">
                                <select class="form-control form-control-sm" name="aslskul" id="aslskul">
                                    <option value="">..Pilih..</option>
                                    <?php
                                    foreach ($skul as $sk) :
                                    ?>
                                    <option value=" <?php echo $sk['idskul']; ?>">
                                        <?php echo $sk['nmskul']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Kelas</label>
                            <div class="col-sm-6">
                                <select class="form-control form-control-sm" id="kdkelas" name="kdkelas">
                                    <option value="">..Pilih..</option>
                                    <?php foreach ($kelas as $kls) : ?>
                                    <option value="<?php echo $kls['idkelas']; ?>"><?php echo $kls['nmkelas']; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Rombongan Belajar</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control form-control-sm" id="idrombel" name="idrombel">
                                <input type="text" class="form-control form-control-sm" id="nmrombel" name="nmrombel">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Wali Kelas</label>
                            <div class="col-sm-6">
                                <select class="form-control form-control-sm" id="idwalas" name="idwalas">
                                    <option value="">..Pilih..</option>
                                    <?php foreach ($gtk as $gr) : ?>
                                    <option value="<?php echo $gr['idgtk']; ?>"><?php echo $gr['nama']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Kurikulum</label>
                            <div class="col-sm-6">
                                <select class="form-control form-control-sm" id="kdkur" name="kdkur">
                                    <option value="">..Pilih..</option>
                                    <?php foreach ($kurikulum as $kur) : ?>
                                    <option value="<?php echo $kur['idkur']; ?>"><?php echo $kur['nmkur']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary btn-sm col-4" id="simpan">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    <button type="button" class="btn btn-danger btn-sm col-4" data-dismiss="modal">
                        <i class="fas fa-power-off mr-2"></i>Tutup
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
                    <div class="callout callout-warning">
                        <p><strong>Petunjuk</strong><br>Pil <strong>Update</strong></p>
                    </div>
                    <div class="card card-secondary card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Data Rombongan Belajar</h4>
                            <div class="card-tools">
                                <button button class="btn btn-success btn-sm" id="BtnTambah" data-toggle="modal"
                                    data-target="#myAddKelas">
                                    <i class="fas fa-plus-circle mr-2"></i>Tambah
                                </button>
                                <button class="btn btn-info btn-sm" id="BtnUpdate" data-toggle="modal"
                                    data-target="#myAddKelas">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </button>
                                <button class="btn btn-secondary btn-sm" id="BtnPengampu">
                                    <i class="fas fa-user-graduate mr-2"></i>Pengampu
                                </button>
                                <button id="BtnHapus" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt mr-2"></i>Hapus
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <div class="table-responsive">
                                    <table id="tb_kelas" class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;width:20%" colspan="2">Nama Rombel</th>
                                                <th style="text-align: center;width:15%">Kelas</th>
                                                <th style="text-align: center;width:25%">Kurikulum</th>
                                                <th style="text-align: center">Wali Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rombel as $rb) : ?>
                                            <tr>
                                                <td style="text-align:center;">
                                                    <input type="checkbox" class="select-item checkbox" name="pilihan[]"
                                                        value="<?php echo $rb['idrombel']; ?>" />
                                                </td>
                                                <td style="text-align:left">
                                                    <?php echo $rb['nmrombel']; ?>
                                                </td>
                                                <td style="text-align:center"><?php echo $rb['nmkelas']; ?></td>
                                                <td style="text-align:left"><?php echo $rb['nmkur']; ?></td>
                                                <td><?php echo $rb['nama']; ?></td>
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
    </div>
</section>

<script type="text/javascript">
// $(function() {
//     $('#tb_kelas').DataTable({
//         "paging": true,
//         "lengthChange": false,
//         "searching": true,
//         "ordering": false,
//         "info": false,
//         "autoWidth": false,
//         "responsive": true,
//     });
// })
$(document).ready(function() {
    $("#myAddKelas").on('hidden.bs.modal', function() {
        window.location.reload()
    })
    $("#BtnTambah").show()
    $("#BtnUpdate").hide()
    $("#BtnHapus").hide()
    $("#BtnPengampu").hide()
    $("#BtnAnggota").hide()
})

$("#BtnTambah").click(function() {
    $(".modal-title").html("Tambah Data Rombongan Belajar")
    $("#simpan").html("<i class='fas fa-save'></i> Simpan")
    $("#idkur").val('')
    $("#kdkelas").val('')
    $("#nmrombel").val('')
})

$('input[name="pilihan[]"]').change(function() {
    idnya = []
    $.each($('input[name="pilihan[]"]:checked'), function() {
        idnya.push($(this).val())
    })
    if (idnya.length == 1) {
        $("#BtnTambah").hide()
        $("#BtnUpdate").show()
        $("#BtnHapus").show()
        $("#BtnPengampu").show()
        $("#BtnAnggota").show()
    } else if (idnya.length > 1) {
        $("#BtnTambah").hide()
        $("#BtnUpdate").hide()
        $("#BtnHapus").show()
        $("#BtnPengampu").hide()
        $("#BtnAnggota").hide()
    } else {
        $("#BtnTambah").show()
        $("#BtnUpdate").hide()
        $("#BtnHapus").hide()
        $("#BtnPengampu").hide()
        $("#BtnAnggota").hide()
    }
})

$("#BtnUpdate").click(function() {
    $(".modal-title").html("Ubah Data Rombongan Belajar")
    $("#simpan").html("<i class='fas fa-save'></i> Update")
    let id = idnya[0]
    $.ajax({
        url: 'kelas_edit.php',
        type: 'post',
        dataType: 'json',
        data: 'id=' + id,
        success: function(data) {
            $("#idrombel").val(data.idrombel)
            $("#kdkur").val(data.idkur)
            $("#nmrombel").val(data.nmrombel)
            $("#kdkelas").val(data.idkelas)
            $("#idwalas").val(data.idgtk)
        }
    })
})

$("#BtnPengampu").click(function() {
    let id = idnya[0]
    window.location.href = "/pengampu/" + id
})

$(".btnHapus").click(function() {
    let id = $(this).data('id')
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Menghapus Rombongan Belajar" + id,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "kelas_simpan.php",
                data: "aksi=2&id=" + id,
                success: function(data) {
                    toastr.success(data)
                }
            })
            window.location.reload()
        }
    })
})
$("#BtnHapus").click(function() {
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Menghapus Rombongan Belajar",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "kelas_simpan.php",
                data: "aksi=3",
                success: function(data) {
                    toastr.success(data);
                }
            })
        }
    })
})
</script>
<?php echo $this->endSection(); ?>