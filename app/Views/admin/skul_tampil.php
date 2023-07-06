<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
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
                <div class="col-12">
                    <div class="card card-secondary card-outline">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo $judul; ?></h4>
                            <div class="card-tools">
                                <a href="/sekolah/baru" class="btn btn-info btn-sm" id="btnTambah">
                                    <i class="fas fa-plus-circle mr-2"></i>Tambah
                                </a>
                                <a href="/sekolah/edit" id="btnUpdate" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                                <button id="btnAktif" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit mr-2"></i>Aktifkan
                                </button>
                                <button id="btnHapus" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt mr-2"></i>Hapus
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabelskul" class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:10%" colspan="2">Kode</th>
                                            <th style="text-align: center;width:7.5%">NPSN</th>
                                            <th style="text-align: center">Nama Satuan Pendidikan</th>
                                            <th style="text-align: center;width:15%">Jenjang</th>
                                            <th style="text-align: left;width:22.5%">Alamat </th>
                                            <th style="text-align:center">Status</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sekolah as $skul) : ?>
                                            <tr>
                                                <td style=" text-align:center;">
                                                    <input type="checkbox" class="select-item checkbox" name="pilihan[]" value="<?php echo $skul['idskul']; ?>">
                                                </td>
                                                <td><?php echo $skul['kdskul']; ?></td>
                                                <td align="center"><?php echo $skul['npsn']; ?></td>
                                                <td><?php echo $skul['nmskul']; ?></td>
                                                <td><?php echo $skul['nmjenjang']; ?></td>
                                                <td><?php echo $skul['alamat']; ?></td>
                                                <td style="text-align:center">
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
        $("#btnUpdate").hide()
        $("#btnHapus").hide()

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

        $("#btnUpdate").click(function(e) {
            e.preventDefault()
            let id = idnya[0]
            window.location.href = "/sekolah/edit/" + id
        })

        $("#btnAktif").click(function() {
            let data = new FormData()
            data.append('id', idnya[0])
            $.ajax({
                url: "/sekolah/aktif",
                type: 'post',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 8000,
                success: function() {}
            })
        })
    })
</script>
<?php echo $this->endSection(); ?>