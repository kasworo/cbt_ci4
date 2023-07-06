<div class="form-group" id="lembaran">
    <div class="form-group">
        <!--Bagian Stimulus  -->
        <div class="row mb-2">
            <div class="col-sm-9 pl-0">
                <strong><em><?php echo $isisoal['petunjuk']; ?></em></strong>
            </div>
            <div class="col-sm-3">
                <a href="<?php echo base_url('banksoal/editstimulus/' . $isisoal['idstimulus']); ?>" class="btn btn-tool btn-xs" style="color:green;font-family:sans-serif;font-size:10pt">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="<?php echo base_url('banksoal/addsoal/' . $isisoal['idstimulus']); ?>" class="btn btn-tool btn-xs" style="color:green;font-family:sans-serif;font-size:10pt">
                    <i class="fas fa-plus-circle"></i> Soal
                </a>
                <button class="btn btn-tool btn-xs" id="DelStim" data-id="<?php echo $isisoal['idstimulus']; ?>" style="color:green;font-family:sans-serif;font-size:10pt">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </div>
        </div>
        <?php if ($isisoal['gambar'] !== NULL) : ?>
            <div class="row">
                <img class="img img-fluid" src="<?php echo base_url('pictures/' . $isisoal['gambar']); ?>">
            </div>
        <?php endif ?>
        <?php if ($isisoal['stimulus'] !== NULL) : ?>
            <div class="row">
                <?php echo $isisoal['stimulus']; ?>
            </div>
        <?php endif ?>

    </div>
    <!-- Bagian Butir Soal -->
    <div class="row">
        <table width="100%" cellpadding="5px auto" cellspacing="2px">
            <tr>
                <?php if ($isisoal['butirsoal'] !== NULL) : ?>
                    <td style="vertical-align:top">
                        <?php echo $isisoal['nosoal'] . '.'; ?>
                    </td>
                    <td width="97.5%">
                        <?php echo $isisoal['butirsoal']; ?>
                        <br>
                        <a href="<?php echo base_url() . '/isisoal/editbutir/' . $isisoal['idbutir']; ?>" class="btn btn-tool btn-xs" style="color:blue;font-family:sans-serif;font-size:9pt;font-weight:bold">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="#" id="DelSoal" class="btn btn-tool btn-xs" style="color:blue;font-family:sans-serif;font-size:9pt;font-weight:bold" data-id="<?php echo $isisoal['idbutir']; ?>"><i class="fas fa-trash-alt"></i> Hapus
                        </a>
                    </td>
                <?php endif ?>
            </tr>
        </table>
    </div>
    <!-- Bagian Opsi Jawaban -->
    <div class="row">
        <!-- Pilihan Ganda Biasa -->
        <?php
        if ($isisoal['jnssoal'] == '1') : ?>
            <!-- Tanpa Header -->
            <?php if ($isisoal['headeropsi'] == NULL) : ?>
                <table width="100%" cellpadding="5px auto" cellspacing="2px" style="margin-top:20px;margin-left:15px">
                    <?php
                    foreach ($opsiview as $id => $op) :
                        switch ($id) {
                            case 0:
                                $val = 'A';
                                break;
                            case 1:
                                $val = 'B';
                                break;
                            case 2:
                                $val = 'C';
                                break;
                            case 3:
                                $val = 'D';
                                break;
                            case 4:
                                $val = 'E';
                                break;
                            default:
                                $val = '';
                                break;
                        }
                    ?>
                        <tr>
                            <td style="text-align:center;vertical-align:top;padding-left:10px">
                                <div class="cc-selector mt-1">
                                    <input id="<?php echo $val; ?>" type="radio" class="opsi1" id="jwbpg" name="jwbpg" data-id="<?php echo $isisoal['idbutir']; ?>" value="<?php echo $op['idopsi']; ?>" <?php echo ($op['benar'] == '1') ? 'checked' : ''; ?>>
                                    <label class="drinkcard-cc <?php echo $val; ?>" for="<?php echo $val; ?>"></label>
                                </div>
                            </td>
                            <td style="text-align:left;vertical-align:top;padding-left:15px" width="97.5%">
                                <?php echo $op['opsi'] . ' ' . $op['benar']; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
                <!-- Dengan Header -->
            <?php else :
                $hdr = explode(",", $isisoal['headeropsi']);
            ?>
                <table width="100%" cellpadding="5px auto" cellspacing="2px" class="table table-bordered table-sm table-condensed" style="margin-top:20px;margin-left:15px">
                    <thead>
                        <th width="7.5%" style="text-align:center">Pilihan</th>
                        <th style="text-align:center"><?php echo $hdr[0]; ?></th>
                        <th style="text-align:center"><?php echo $hdr[1]; ?></th>
                    </thead>
                    <tbody>
                        <?php foreach ($opsiview as $id => $op) : ?>
                            <tr valign="top">
                                <?php
                                switch ($id) {
                                    case 0:
                                        $val = 'A';
                                        break;
                                    case 1:
                                        $val = 'B';
                                        break;
                                    case 2:
                                        $val = 'C';
                                        break;
                                    case 3:
                                        $val = 'D';
                                        break;
                                    case 4:
                                        $val = 'E';
                                        break;
                                    default:
                                        $val = '';
                                        break;
                                }
                                ?>
                                <td valign="top" style="text-align:center" width="2.5%">
                                    <div class="cc-selector">
                                        <input id="<?php echo $val; ?>" class="opsi1" type="radio" name="opsijwb" data-id="<?php echo $op['idbutir']; ?>" value="<?php echo $op['idopsi']; ?>" <?php echo ($op['benar'] == '1') ? 'checked' : ''; ?>>
                                        <label class="drinkcard-cc <?php echo $val; ?>" for="<?php echo $val; ?>"></label>
                                    </div>
                                </td>
                                <td valign="top" for="<?php echo $val; ?>">
                                    <?php echo $op['opsi']; ?>
                                </td>
                                <td valign="top" for="<?php echo $val; ?>">
                                    <?php echo $op['opsialt']; ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
        <?php endif ?>
        <!-- Pilihan Ganda Komplex -->
        <?php if ($isisoal['jnssoal'] == '2') : ?>
            <table style="margin-top:20px;margin-left:15px">

                <?php foreach ($opsiview as $id => $op) : ?>
                    <tr>
                        <td valign="top">
                            <input id="jwbkomp" data-id="<?php echo $op['idbutir']; ?>" class="opsi2" type="checkbox" name="jwbkomp[]" value="<?php echo $op['idopsi']; ?>" <?php echo ($op['benar'] == '1') ? 'checked' : ''; ?>>
                        </td>
                        <td valign="top">
                            <?php echo $op['opsi']; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php endif ?>
    </div>
</div>
<script>
    $(".opsi1").click(function(e) {
        e.preventDefault()
        let data = new FormData()
        data.append('idopsi', $(this).val())
        data.append('idsoal', $(this).data('id'))
        $.ajax({
            url: "<?php echo base_url('isisoal/editkunci'); ?>",
            type: "post",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 8000,
            success: function(rsp) {
                if (rsp == 1) {
                    toastr.info("Kunci Jawaban Berhasil Diubah!", "Informasi")
                } else {
                    toastr.error("Kunci Jawaban Gagal Diubah!", "Error")
                }
            }
        })
    })

    $(".opsi2").click(function() {
        let opsi = [];
        $(".opsi2").each(function() {
            if ($(this).is(":checked")) {
                opsi.push($(this).val())
            }
        })
        opsi = opsi.toString();
        if (opsi.length > 0) {
            let data = new FormData()
            data.append('idsoal', $(this).data('id'))
            data.append('idopsi', opsi)
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('edit/kunci'); ?>",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 8000,
                success: function(rsp) {
                    if (rsp == 1) {
                        toastr.info("Kunci Jawaban Berhasil Diubah!", "Informasi")
                    } else {
                        toastr.error("Kunci Jawaban Gagal Diubah!", "Error")
                    }
                }
            })
        }
    })

    $("#DelStim").click(function(e) {
        e.preventDefault()
        let id = $(this).data('id')
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Data Stimulus dan Data Terkait Akan dihapus",
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
                    url: "<?php echo base_url('banksoal/delstimulus'); ?>",
                    data: {
                        id: id
                    },
                    success: function(isi) {
                        if (isi == 1) {
                            Swal.fire({
                                title: 'Terima Kasih',
                                text: 'Data Stimulus dan Data Terkait Berhasil Dihapus',
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

    $("#DelSoal").click(function(e) {
        e.preventDefault()
        let id = $(this).data('id')
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Data Butir Soal dan Data Terkait Akan dihapus",
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
                    url: "<?php echo base_url('banksoal/delbutir'); ?>",
                    data: {
                        id: id
                    },
                    success: function(isi) {
                        if (isi == 1) {
                            Swal.fire({
                                title: 'Terima Kasih',
                                text: 'Data Butir Soal dan Data Terkait Berhasil Dihapus',
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
</script>