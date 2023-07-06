<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="modal fade" id="myUjian" aria-modal="true">
    <form action="/banksoal/ujikan" method="post" onsubmit="">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pengaturan Ujian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary btn-sm col-4" id="btnAktivasi">
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

<div class="modal fade" id="myAddBank" aria-modal="true">
    <form action="/banksoal/postbank" method="post">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Bank Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 offset-sm-1">Kelas</label>
                            <select class="form-control form-control-sm col-sm-6" id="idkelas" name="idkelas">
                                <option value="">..Pilih..</option>
                                <?php foreach ($kelas as $kl) :
                                ?>
                                    <option value="<?php echo $kl['idkelas']; ?>">
                                        <?php echo $kl['nmkelas']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 offset-sm-1">Kurikulum</label>
                            <select class="form-control form-control-sm col-sm-6" id="idkur" name="idkur" disabled="true">
                                <option value="">..Pilih..</option>
                            </select>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 offset-sm-1">Mata Pelajaran</label>
                            <select class="form-control form-control-sm col-sm-6" id="idmapel" name="idmapel" disabled="true">
                                <option value="">..Pilih..</option>
                            </select>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 offset-sm-1">Paket Soal</label>
                            <input class="form-control form-control-sm col-sm-6" id="nmbank" name="nmbank" disabled="true" placeholder="Paket Soal" readonly>
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
<div class="content">
    <div class="container-fluid">
        <div class="col-sm-12 col-12">
            <div class="card card-secondary card-outline">
                <div class="card-header">
                    <h4 class="card-title">Data Bank Soal</h4>
                    <div class="card-tools">
                        <button class="btn btn-sm btn-secondary mr-2" id="btnIsi">
                            <i class="fas fa-pencil-alt mr-2"></i>Isi Soal
                        </button>
                        <a href="#" class="btn btn-success btn-sm mr-2" id="btnTambah" data-toggle="modal" data-target="#myAddBank">
                            <i class="fas fa-plus-circle mr-2"></i>Tambah
                        </a>
                        <a href="#" class="btn btn-sm btn-warning" id="btnUji" data-toggle="modal" data-target="#myUjian">
                            <i class="fas fa-check-square mr-2"></i>Ujikan
                        </a>
                        <a href="#" id="btnHapus" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt mr-2"></i>Hapus
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tb_banksoal" class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center;width:27.5%" colspan="2">Paket Soal</th>
                                    <th style="text-align: center;width:17.10%">Kelas</th>
                                    <th style="text-align: center;">Mata Pelajaran</th>
                                    <th style="text-align: center;">Jumlah Soal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($banksoal as $bnk) : ?>
                                    <tr>
                                        <td style="text-align:center;">
                                            <input type="checkbox" class="select-item checkbox" name="pilihan[]" value="<?php echo $bnk['idbank']; ?>" />
                                        </td>
                                        <td>
                                            <?php echo $bnk['nmbank']; ?>
                                        </td>
                                        <td>
                                            <?php echo $bnk['nmkelas']; ?>
                                        </td>
                                        <td>
                                            <?php echo $bnk['nmmapel']; ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php echo $bnk['jmlsoal']; ?>
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
        $("#myAddBank").on('hidden.bs.modal', function() {
            window.location.reload()
        })
        $("#btnTambah").show()
        $("#btnIsi").hide()
        $("#btnUji").hide()
    })
    $("#idkelas").change(function() {
        let data = new FormData()
        data.append('id', $(this).val())
        $.ajax({
            url: "/banksoal/getkur",
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 8000,
            success: function(msg) {
                $("#idkur").html(msg)
                $("#idkur").removeAttr("disabled")
            }
        })
    })

    $("#idkur").change(function() {
        let data = new FormData()
        data.append('id', $(this).val())
        $.ajax({
            url: "/banksoal/getmapel",
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 8000,
            success: function(msg) {
                $("#idmapel").html(msg)
                $("#idmapel").removeAttr("disabled")
            }
        })
    })

    $("#idmapel").change(function() {
        let map = $(this).val();
        if (map == '') {
            toastr.error("Mata Pelajaran Tidak Boleh Kosong", "Maaf!");
        } else {
            let data = new FormData()
            data.append('kls', $("#idkelas").val())
            data.append('map', map)
            $.ajax({
                url: "/banksoal/getid",
                type: 'post',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 8000,
                success: function(msg) {
                    $("#nmbank").val(msg);
                    $("#nmbank").removeAttr("disabled")
                }
            })
        }
    })

    $('input[name="pilihan[]"]').change(function() {
        idnya = []
        $.each($('input[name="pilihan[]"]:checked'), function() {
            idnya.push($(this).val())
        })
        if (idnya.length == 1) {
            $("#idbanknya").val(idnya[0])
            $("#btnTambah").hide()
            $("#btnIsi").show()
            $("#btnUji").show()
        } else if (idnya.length > 1) {
            $("#idbanknya").val('')
            $("#btnTambah").hide()
            $("#btnIsi").hide()
            $("#btnUji").hide()
            $("#btnHapus").show()
        } else {
            $("#idbanknya").val('')
            $("#btnTambah").show()
            $("#btnIsi").hide()
            $("#btnUji").hide()
            $("#btnHapus").hide()
        }
    })

    $("#btnIsi").click(function() {
        let id = idnya[0]
        window.location.href = "/banksoal/isi/" + id
    })

    $("#btnUji").click(function() {
        let id = idnya[0];
        $.ajax({
            url: "/banksoal/aktif",
            type: 'post',
            data: {
                'id': id
            },
            success: function(rsp) {
                $(".fetched-data").html(rsp)
            }
        })
    })
</script>
<?php echo $this->endSection(); ?>