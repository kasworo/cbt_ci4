<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<style type="text/css">
.arab {
    text-align: right;
    line-height: 45px;
    font-family: "LPMQ Isep Misbah";
    font-size: 18pt;
    src: url("/assets/webfonts/lpmq.ttf");
}

.cc-selector input {
    margin-left: 0px;
    padding: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

.A {
    background-image: url("/assets/img/A.png");
    padding-bottom: 10;
}

.B {
    background-image: url("/assets/img/B.png");
    padding-bottom: 10;
}

.C {
    background-image: url("/assets/img/C.png");
    padding-bottom: 10;
}

.D {
    background-image: url("/assets/img/D.png");
    padding-bottom: 10;
}

.E {
    background-image: url("/assets/img/E.png");
    padding-bottom: 10;
}

.F {
    background-image: url("/assets/img/F.png");
    padding-bottom: 10;
}

.G {
    background-image: url("/assets/img/G.png");
    padding-bottom: 10;
}

.H {
    background-image: url("/assets/img/H.png");
    padding-bottom: 10;
}

.I {
    background-image: url("/assets/img/I.png");
    padding-bottom: 10;
}

.J {
    background-image: url("/assets/img/J.png");
    padding-bottom: 10;
}

.piljwb {
    margin-left: 0;
    border-radius: 30px;
    border-style: solid;
    border-color: #999;
    list-style: none;
}

.cc-selector input:active+.drinkcard-cc {
    opacity: 0.9;
}

.cc-selector input:checked+.drinkcard-cc {
    background-image: url("/assets/img/pilih.png");
    -webkit-filter: none;
    -moz-filter: none;
    filter: none;
}

.drinkcard-cc {
    cursor: pointer;
    background-size: contain;
    background-repeat: no-repeat;
    display: inline-block;
    width: 20px;
    height: 20px;
}

.drinkcard-cc:hover {
    -webkit-filter: brightness(1.2) grayscale(0.5) opacity(0.9);
    -moz-filter: brightness(1.2) grayscale(0.5) opacity(0.9);
    filter: brightness(1.2) grayscale(0.5) opacity(0.9);
}

input[type="checkbox"] {
    left: 5px;
    top: 2px;
    position: relative;
    margin-right: 15px;
    padding-right: 15px;
    cursor: pointer;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: 0;
    height: 20px;
    width: 20px;
    background-image: url("/assets/img/cek.png");
}

input[type="checkbox"]:checked {
    left: 5px;
    top: 2px;
    position: relative;
    margin-right: 15px;
    padding-right: 15px;
    cursor: pointer;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: 0;
    height: 20px;
    width: 20px;
    background-image: url("<?php echo base_url('assets/img/ceklis.png'); ?>");
}

input[type="checkbox"]:hover {
    filter: brightness(98%);
}

input[type="checkbox"]:disabled {
    background: #e6e6e6;
    opacity: 0.6;
    pointer-events: none;
}
</style>
<link rel="stylesheet" href="<?php echo base_url('assets/css/ujian.css'); ?>">
<div class="modal fade" id="myViewSoal" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myImportTmp" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Import Template Bank Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="filetmp">Pilih File Template</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="filetmp" name="filetmp">
                                <label class="custom-file-label" for="filetmp">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls dan
                                    *.xlsx</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="#" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-download"></i>
                        Download</a>
                    <button type="submit" class="btn btn-primary btn-sm" name="import"><i class="fas fa-upload"></i>
                        Upload</button>
                    <a href="#" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-power-off"></i>
                        Tutup</a>
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
                        <h3 class="card-title">Daftar Bank Soal</h3>
                        <div class="card-tools">
                            <a href="<?php echo base_url('banksoal'); ?>" class="btn btn-default btn-sm">
                                <i class="fas fa-arrow-circle-left mr-2"></i>Kembali
                            </a>
                            <a href="<?php echo base_url('banksoal/stimulus/' . $bank['idbank']); ?>"
                                class=" btn btn-success btn-sm">
                                <i class="fas fa-plus-circle mr-2"></i>Tambah
                            </a>
                            <a href="#myImportTmp" data-toggle="modal" class=" btn btn-primary btn-sm">
                                <i class="fas fa-cloud-download-alt mr-2"></i>Import
                            </a>
                            <a href="#" data-target="#myViewSoal" data-id="<?php echo $bank['idbank']; ?>"
                                data-toggle="modal" class="btn btn-warning btn-sm" id="navSoal">
                                <i class="fas fa-list-alt mr-2"></i>Daftar Soal
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12" id="lembaransoal">
                            <div id="loadsoal"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-secondary mr-2 btnPrev">
                            <i class=" fas fa-arrow-circle-left mr-2"></i>Sebelumnya
                        </button>
                        <button class="btn btn-sm btn-primary btnNext">
                            Berikutnya<i class="fas fa-arrow-circle-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    tampilsoal("<?php echo $bank['hal']; ?>")
})

function tampilsoal(hal) {
    let data = new FormData()
    data.append('hal', hal)
    data.append('idbank', "<?php echo $bank['idbank']; ?>")
    $.ajax({
        url: "<?php echo base_url('banksoal/navigasi'); ?>",
        type: "post",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 8000,
        success: function(msg) {
            let smua = "<?php echo $bank['jmlsoal']; ?>"
            if (parseInt(hal) <= 1) {
                prev = 1
                next = 2
                $(".btnPrev").attr("disabled", true)
                $(".btnPrev").addClass("d-none")
            } else if (parseInt(hal) < parseInt(smua)) {
                next = parseInt(hal) + 1
                prev = parseInt(hal) - 1
                $(".btnPrev").removeAttr("disabled")
                $(".btnPrev").removeClass("d-none")
            } else {
                next = parseInt(hal) + 1
                next = 1
                $(".btnPrev").removeAttr("disabled")
                $(".btnPrev").removeClass("d-none")
            }
            $("#loadsoal").html(msg)
            $(".btnPrev").data('id', prev)
            $(".btnNext").data('id', next)
        }
    })
}

$(".btnPrev").click(function() {
    let urut = $(this).data('id')
    let data = new FormData()
    data.append('hal', urut)
    data.append('idbank', "<?php echo $bank['idbank']; ?>")
    $.ajax({
        url: "<?php echo base_url('banksoal/seturut'); ?>",
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 8000,
        success: function() {
            tampilsoal(urut)
        }
    })
})

$(".btnNext").click(function() {
    let urut = $(this).data('id')
    let data = new FormData()
    data.append('hal', urut)
    data.append('idbank', "<?php echo $bank['idbank']; ?>")
    $.ajax({
        url: "<?php echo base_url('banksoal/seturut'); ?>",
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 8000,
        success: function() {
            tampilsoal(urut)
        }
    })

})

$("#navSoal").click(function() {
    let id = $(this).data('id')
    $.ajax({
        url: "<?php echo base_url('banksoal/navlist'); ?>",
        type: 'post',
        data: {
            'idbank': id
        },
        success: function(rsp) {
            $(".fetched-data").html(rsp)
        }
    })
})
</script>
<?php echo $this->endSection(); ?>