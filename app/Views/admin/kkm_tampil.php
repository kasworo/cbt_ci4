<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h4 class="card-title">Data KKM Tahun Pelajaran</h4>
                        <div class="card-tools">
                            <button class="btn btn-flat btn-success btn-sm" id="btnSalin" data-toggle="modal"
                                data-target="#myAddKKM">
                                <i class="far fa-copy mr-2"></i>Salin
                            </button>
                            <button class="btn btn-flat btn-info btn-sm" id="btnRefresh">
                                <i class="fas fa-sync-alt mr-2"></i>Refresh
                            </button>
                            <button id="hapusall" class="btn btn-flat btn-danger btn-sm">
                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-condensed table-sm">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2.5%">No.</th>
                                        <th style="text-align: center">Mata Pelajaran</th>
                                        <th style="text-align: center">Kurikulum</th>
                                        <?php
                                            foreach ($kelas as $kl) :
                                            ?>
                                        <th style="text-align: center;width:10%"><?php echo $kl['nmkelas']; ?></th>
                                        <?php endforeach ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 0;
                                        foreach ($mapel as $m) :
                                            $no++;
                                        ?>
                                    <tr>
                                        <td style="text-align:center"><?php echo $no . '.'; ?></td>
                                        <td><?php echo $m['nmmapel']; ?></td>
                                        <td><?php echo $m['nmkur']; ?></td>
                                        <?php foreach ($kelas as $kls) : ?>
                                        <td style="text-align: center;">
                                            <?php if ($m['idkur'] == $kls['idkur']) : ?>

                                            <input class="form-control form-control-sm ekkm"
                                                data-id="<?php echo $m['idmapel']; ?>"
                                                data-kls="<?php echo $kls['idkelas']; ?>" style="text-align:center"
                                                value="">
                                            <?php endif ?>
                                        </td>
                                        <?php endforeach ?>
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
<script>
$(".ekkm").change(function() {
    let idmapel = $(this).data('id')
    let idkelas = $(this).data('kls')
    let kkm = $(this).val()
    alert(idmapel + ' ' + kkm)

})
</script>
<?php echo $this->endSection(); ?>