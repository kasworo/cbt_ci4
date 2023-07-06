<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="modal fade" id="mySeting" aria-modal="true">
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
                            <label class="col-sm-4 offset-sm-1">Tempat</label>
                            <input type="text" class="form-control form-control-sm col-sm-6" id="akmapel" name="akmapel">
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 offset-sm-1">Jabatan</label>
                            <select class="form-control form-control-sm col-sm-6" id="jmapel" name="jmapel">
                                <option value="">..Pilih..</option>
                                <option value="0">Umum</option>
                                <option value="1">Agama</option>
                            </select>
                        </div>
                        <div class="form-group row mb-2" id="urutmapel">
                            <label class="col-sm-4 offset-sm-1">Urut</label>
                            <input type="text" class="form-control form-control-sm col-sm-6" id="urmapel" name="urmapel">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary btn-sm col-3" id="simpan">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-danger btn-sm col-3" data-dismiss="modal">
                        <i class="fas fa-power-off mr-2"></i> Tutup
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
                        <h4 class="card-title">Form Cetak Kartu Ujian</h4>
                        <div class="card-tools">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mySeting">
                                <i class="fas fa-cogs mr-2"></i>Seting
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <iframe id="pdf-frame" style="border: 1px solid #ccc" width=" 100%" height="500px" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#pdf-frame').attr('src', '/administrasi/kartucetak?pdf=true')
                    })
                </script>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>