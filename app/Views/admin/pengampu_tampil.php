<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h4 class="card-title">Data Pengampu Bidang Studi <?php echo $rombel; ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_pengampu" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="text-align: center" colspan=" 2">Mata Pelajaran</th>
                                        <th style="text-align: center;width:12.5%">Rombel</th>
                                        <th style="text-align: center;width:35%">Guru Bidang Studi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($pengampu as $m) :
                                        ?>
                                    <tr>
                                        <td align="center">
                                            <input type="checkbox" class="select-item checkbox" name="pilihan"
                                                value="<?php echo $m['idmapel']; ?>" />
                                        </td>
                                        <td><?php echo $m['akmapel'] . ' - ' . $m['nmmapel']; ?></td>
                                        <td align="center"><?php echo $m['nmrombel']; ?></td>
                                        <td align="center">
                                            <select class="pilgtk form-control form-control-sm col-sm-10"
                                                data-rmb="<?php echo $rombel; ?>"
                                                data-id="<?php echo $m['idmapel']; ?>">
                                                <option value="">..Pilih..</option>
                                                <?php foreach ($guru as $gr) : ?>
                                                <option value="<?php echo $gr['idgtk']; ?>"
                                                    <?php echo $m['idgtk'] == $gr['idgtk'] ? 'selected' : ''; ?>>
                                                    <?php echo $gr['nama']; ?></option>
                                                <?php endforeach ?>
                                            </select>
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
<script>
$(".pilgtk").change(function(e) {
    e.preventDefault()
    let data = new FormData()
    data.append('idrombel', $(this).data('rmb'))
    data.append('idmapel', $(this).data('id'))
    data.append('idgtk', $(this).val())
    $.ajax({
        url: "/pengampu/post",
        type: "post",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 8000,
        success: function(isi) {
            if (isi == 0) {
                toastr.error('Simpan atau Update Pengampu Gagal!')
            }
            if (isi == 1) {
                toastr.success('Data Pengampu Berhasil Disimpan!')
            }
            if (isi == 2) {
                toastr.info('Data Pengampu Berhasil Diupdate!')
            }
        }
    })
})
</script>
<?php echo $this->endSection(); ?>