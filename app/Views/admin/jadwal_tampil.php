<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h4 class="card-title">Pengaturan Jadwal Tes</h4>
                        <div class="card-tools">
                            <button class="btn btn-success btn-sm" id="btnTambah" data-toggle="modal" data-target="#myJadwal">
                                <i class="fas fa-plus-circle mr-2"></i>Tambah
                            </button>
                            <button class="btn btn-secondary btn-sm" id="btnUpdate" data-toggle="modal" data-target="#myJadwal">
                                <i class="far fa-edit mr-2"></i>Edit
                            </button>
                            <button class="btn btn-danger btn-sm" id="btnHapus">
                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <div class="table-responsive">
                                <table width="100%" class="table table-striped table-sm" id="tbjadwal">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;width:50%" colspan="2">Mata Ujian</th>
                                            <th style="text-align:center;width:17.5%">Tanggal Tes</th>
                                            <th style="text-align:center;width:17.5%">Durasi Tes</th>
                                            <th style="text-align:center;">Jam Mulai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($jadwal as $jd) : ?>
                                            <tr>
                                                <td style="text-align:center;">
                                                    <input type="checkbox" class="select-item checkbox" name="pilihan[]" value="<?php echo $jd['idjadwal']; ?>" />
                                                </td>
                                                <td style="text-align:left">
                                                    <?php echo $jd['kdjadwal'] . ' - ' . $jd['matauji']; ?></td>
                                                <td style="text-align:center">
                                                    <?php echo $jd['tglujian']; ?></td>
                                                <td style="text-align:center"><?php echo $jd['durasi'] . ' menit'; ?>
                                                </td>
                                                <td style="text-align:center">
                                                    <?php echo substr($jd['mulai'], 0, 5) . ' WIB'; ?></td>
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
<?php echo $this->endSection(); ?>