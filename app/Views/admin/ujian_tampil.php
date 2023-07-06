<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="modal modal-md fade" id="myAddJenisTes" aria-modal="true">
    <form action="/ujian/post" method="post">
        <div class=" modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Jenis Tes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 offset-sm-1">Kode Tes</label>
                            <input type="hidden" class="form-control form-control-sm col-sm-6" id="idtes" name="idtes">
                            <input type="text" class="form-control form-control-sm col-sm-6" id="aktes" name="aktes">
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 offset-sm-1">Nama Tes</label>
                            <input type="text" class="form-control form-control-sm col-sm-6" id="nmtes" name="nmtes">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary btn-sm col-4" id="simpan">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-danger btn-sm col-4" data-dismiss="modal">
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
                    <h1 class="m-0 text-dark" id="hdTitle"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item" id="hdMenu"></li>
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
                            <h4 class="card-title">Data Jenis Tes</h4>
                            <div class="card-tools">
                                <button class="btn btn-success btn-sm" id="btnTambah" data-toggle="modal" data-target="#myAddJenisTes">
                                    <i class="fas fa-plus-circle mr-2"></i>Tambah
                                </button>
                                <button class="btn btn-secondary btn-sm" id="btnUpdate" data-toggle="modal" data-target="#myAddJenisTes">
                                    <i class="far fa-edit mr-2"></i>Edit
                                </button>
                                <button id="btnHapus" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt mr-2"></i>Hapus
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tb_tes" class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:17.5%" colspan="2">Kode</th>
                                            <th style="text-align: center">Nama Ujian / Tes</th>
                                            <th style="text-align: center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ujian as $m) : ?>
                                            <tr>
                                                <td style="text-align:center;">
                                                    <input type="checkbox" class="select-item checkbox" name="pilihan[]" value="<?php echo $m['idujian']; ?>">
                                                </td>
                                                <td style="text-align:left"><?php echo $m['akujian']; ?></td>
                                                <td><?php echo $m['nmujian']; ?></td>
                                                <td style="text-align:center">
                                                    <span class="col-6 btn btn-xs <?php echo $m['aktif'] == '1' ? 'btn-success' : 'btn-secondary'; ?> btnAktif" data-id="<?php echo $m['idujian']; ?>" data-value=" <?php echo $m['aktif']; ?>"><?php echo $m['aktif'] == '1' ? 'Aktif' : 'Non Aktif'; ?></span>
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

<script type="text/javascript">
    $(document).ready(function() {
        $("#myAddUjian").on('hidden.bs.modal', function() {
            window.location.reload();
        })
        $("#myAddJenisTes").on('hidden.bs.modal', function() {
            window.location.reload();
        })
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
        $(".modal-title").html("Tambah Data Jenis Tes");
        $("#simpan").html("<i class='fas fa-save'></i> Simpan");
        $("#idtes").val('');
        $("#nmtes").val('');
        $("#aktes").val('');
        $("#getth").val('')
    })

    $("#btnUpdate").click(function() {
        $(".modal-title").html("Update Data Jenis Tes");
        $("#simpan").html("<i class='fas fa-save'></i> Update");
        let id = idnya[0];
        let data = new FormData();
        data.append('id', id);
        $.ajax({
            url: "<?php echo base_url('ujian/edit'); ?>",
            type: 'post',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 8000,
            success: function(e) {
                $("#idtes").val(e.idujian)
                $("#aktes").val(e.akujian)
                $("#nmtes").val(e.nmujian)
            }
        })
    })

    $("#btnHapus").click(function() {
        let id = idnya[0];
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Data Ujian dan Data Terkait Akan dihapus",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Tentu!",
            cancelButtonText: "Batalkan!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('ujian/hapus'); ?>",
                    data: {
                        'id': id
                    },
                    success: function(isi) {
                        if (isi == 1) {
                            Swal.fire({
                                title: 'Terima Kasih',
                                text: 'Data Ujian dan Data Terkait Berhasil Dihapus',
                                icon: 'success',
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.value) {
                                    location.reload(true)
                                }
                            })
                        }
                    }
                })
            }
        })
    })

    $(".btnAktif").click(function() {
        let data = new FormData()
        data.append('id', $(this).data('id'))
        data.append('isi', $(this).data('value'));
        $.ajax({
            url: "<?php echo base_url('ujian/aktif'); ?>",
            type: 'post',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 8000,
            success: function(isi) {
                if (isi == 1) {
                    Swal.fire({
                        title: 'Terima Kasih',
                        text: 'Data Ujian Berhasil Diaktifkan',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.value) {
                            location.reload(true)
                        }
                    })
                } else {
                    Swal.fire({
                        title: 'Terima Kasih',
                        text: 'Data Ujian Berhasil Dinonaktifkan',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.value) {
                            location.reload(true)
                        }
                    })
                }
            }
        })
    })
</script>
<?php echo $this->endSection(); ?>