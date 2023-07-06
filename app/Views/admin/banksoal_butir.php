<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="callout callout-danger">
                    <label>Petunjuk:</label>
                    <ol>
                        <li class="text-sm">Lengkapi pilihan jenis soal hingga skor maksimum sebelum butir soal
                            diketikkan.</li>
                        <li class="text-sm">Ketikkan butir soal, kemudian unggah file pendukung butir soal jika
                            diperlukan. Unggah file
                            berekstensi *.jpg, *.jpeg, *.png, *.gif, *.mp4, *.avi, *.wav, atau *.mp3</li>
                        <li class="text-sm">Isikan opsi jawaban, tersedia maksimum 6 opsi jawaban, pilih Ya atau
                            Tidak pada pilihan
                            jawaban</li>
                        <li class="text-sm">Lengkapi file pendukung Opsi Jawaban jika diperlukan, pastikan file yang
                            diunggah
                            berekstensi *.jpg, *.jpeg, *.png, atau *.gif.</li>
                    </ol>
                </div>
                <div class="card card-danger card-outline" id="butirsoal">
                    <form action="<?php echo base_url('banksoal/postbutir'); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="card-header">
                            <h3 class="card-title" id="judul">Form Butir Soal</h3>
                        </div>
                        <div class=" card-body">
                            <div class="form-group row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group row mb-2 ml-4">
                                        <div class="col-sm-4">
                                            <label>Jenis Soal</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="hidden" id="idbank" name="idbank"
                                                value="<?php echo $soal['idbank']; ?>">
                                            <input type="hidden" id="idstimulus" name="idstimulus"
                                                value="<?php echo $soal['idstimulus']; ?>">
                                            <select id="kategori" name="kategori" class="form-control form-control-sm">
                                                <option value=""
                                                    <?php echo $soal['jnssoal'] == NULL ? 'selected' : ''; ?>>
                                                    ..Pilih..
                                                </option>
                                                <option value="1"
                                                    <?php echo $soal['jnssoal'] == '1' ? 'selected' : ''; ?>>Pilihan
                                                    Ganda
                                                    Biasa
                                                </option>
                                                <option value="2"
                                                    <?php echo $soal['jnssoal'] == '2' ? 'selected' : ''; ?>>Pilihan
                                                    Ganda
                                                    Kompleks
                                                </option>
                                                <option value="3"
                                                    <?php echo $soal['jnssoal'] == '3' ? 'selected' : ''; ?>>Benar /
                                                    Salah
                                                </option>
                                                <option value="4"
                                                    <?php echo $soal['jnssoal'] == '4' ? 'selected' : ''; ?>>
                                                    Menjodohkan
                                                </option>
                                                <option value="5"
                                                    <?php echo $soal['jnssoal'] == '5' ? 'selected' : ''; ?>>Isian
                                                    Singkat
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row mb-2">
                                        <div class="col-sm-4">
                                            <label>Skor Maksimum</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-sm" id="skormaks" name="skormaks"
                                                value="<?php echo $soal['skormaks']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class=" form-group row mb-2">
                                <div class="col-sm-8">
                                    <div class="form-group row mb-2 ml-4">
                                        <label>Butir Soal</label>
                                    </div>
                                    <div class="form-group row mb-2 ml-4">
                                        <input type="hidden" id="idbutir" name="idbutir"
                                            value="<?php echo $soal['idbutir']; ?>">
                                        <textarea class="form-control form-control-sm" id="butirsoal"
                                            name="butirsoal"><?php echo $soal['butirsoal']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group row mb-2 ml-4">
                                        <label>File Pendukung</label>
                                    </div>
                                    <div class="form-group row mb-2 ml-4">
                                        <img src="<?php echo base_url('assets/img/nofile.png'); ?>"
                                            class="img img-rounded img-fluid img-bordered-sm" width="180px">
                                    </div>
                                    <div class="form-group row mb-2 ml-4">
                                        <input type="file" name="filesoal" id="filesoal">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row mb-2 ml-4">
                                <label>Pilihan Jawaban</label>
                            </div>
                            <?php
                                //dd($soal['opsi']);
                                if (count($soal['opsi']) > 0) :
                                    foreach ($soal['opsi'] as $id => $op) :
                                ?>
                            <div class="form-group row mb-2 mt-2 ml-4">
                                <div class="col-sm-8">
                                    <div class="form-group row mb-2">
                                        <span>Opsi Jawaban <?php echo $id + 1; ?></span>
                                        <input type="hidden" id="idopsi" name="idopsi[]"
                                            value="<?php echo $op['idopsi']; ?>">
                                    </div>
                                    <div class="form-group row mb-2">
                                        <textarea class="form-control form-control-sm" id="opsi"
                                            name="opsi[]"><?php echo $op['opsi']; ?></textarea>
                                    </div>
                                </div>
                                <div class=" col-sm-4">
                                    <div class="form-group row mb-2  ml-4">
                                        <span>Jawaban Benar</span>
                                    </div>
                                    <div class="form-group row mb-2  ml-4">
                                        <select class="form-control form-control-sm col-6" id="kunci" name="kunci[]">
                                            <option value="">..Pilih..</option>
                                            <option value="1" <?php echo $op['benar'] == '1' ? 'selected' : ''; ?>>
                                                Ya</option>
                                            <option value="0" <?php echo $op['benar'] == '0' ? 'selected' : ''; ?>>
                                                Tidak</option>
                                        </select>
                                    </div>
                                    <div class="form-group row mb-2  ml-4">
                                        <span>File Pendukung</span>
                                    </div>
                                    <div class="form-group row mb-2  ml-4">
                                        <img src="<?php echo base_url('assets/img/noimage.png'); ?>"
                                            class="img img-rounded img-fluid img-bordered-sm" height="80px"
                                            width="80px">
                                    </div>
                                    <div class="form-group row mb-2  ml-4">
                                        <input type="file" name="fileopsi[]" id="fileopsi">
                                    </div>
                                </div>
                            </div>
                            <?php echo $id <= 5 ? '<hr>' : ''; ?>
                            <?php endforeach ?>
                            <?php else : ?>
                            <?php for ($i = 0; $i <= 5; $i++) : ?>
                            <div class="form-group row mb-2 mt-2 ml-4">
                                <div class="col-sm-8">
                                    <div class="form-group row mb-2">
                                        <span>Opsi Jawaban <?php echo $i + 1 ?></span>
                                        <input type="hidden" id="idopsi" name="idopsi[]">
                                    </div>
                                    <div class="form-group row mb-2">
                                        <textarea class="form-control form-control-sm" id="opsi"
                                            name="opsi[]"></textarea>
                                    </div>
                                </div>
                                <div class=" col-sm-4">
                                    <div class="form-group row mb-2  ml-4">
                                        <span>Jawaban Benar</span>
                                    </div>
                                    <div class="form-group row mb-2  ml-4">
                                        <select class="form-control form-control-sm col-6" id="kunci" name="kunci[]">
                                            <option value="">..Pilih..</option>
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="form-group row mb-2  ml-4">
                                        <span>File Pendukung</span>
                                    </div>
                                    <div class="form-group row mb-2  ml-4">
                                        <img src="<?php echo base_url('assets/img/noimage.png'); ?>"
                                            class="img img-rounded img-fluid img-bordered-sm" height="80px"
                                            width="80px">
                                    </div>
                                    <div class="form-group row mb-2  ml-4">
                                        <input type="file" name="fileopsi[]" id="fileopsi">
                                    </div>
                                </div>
                            </div>
                            <?php endfor ?>
                            <?php endif ?>
                        </div>
                        <div class=" card-footer">
                            <button type="submit" class="btn btn-success btn-sm ml-1 mb-2">
                                <i class="fas fa-save mr-2"></i>Simpan
                            </button>
                            <a href="<?php echo base_url('banksoal/isi/' . $soal['idbank']); ?>"
                                class="btn btn-default btn-sm ml-1 mb-2">
                                <i class="fas fa-arrow-circle-left mr-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/tinymce/tinymce.min.js'); ?>"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: ["formula advlist lists charmap anchor", "code fullscreen", "table contextmenu paste jbimages"],
    toolbar: "undo redo | bold italic underline subscript superscript | alignleft aligncenter alignright alignjustify | bullist numlist | jbimages table formula code",
    menubar: false,
    relative_urls: false,
    forced_root_block: "",
    force_br_newlines: false,
    force_p_newlines: true,
});
</script>
<?php echo $this->endSection(); ?>