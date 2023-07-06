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
                <div class="col">
                    <div class="alert alert-warning">
                        <label>Petunjuk:</label>
                        <ol>
                            <li class="text-sm">Isikan petunjuk dan teks sebelum menambahkan butir soal.</li>
                            <li class="text-sm">Pastikan File Pendukung yang diupload berekstensi *.jpg, *.jpeg, *.png,
                                *.gif,*.wav ,*.mp3,
                                *.avi, atau *.mp4.</li>
                        </ol>
                    </div>
                    <div class="card card-danger card-outline">
                        <form action="<?php echo base_url('banksoal/poststimulus'); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-header">
                                <h4 class="card-title col-sm-6" id="judul"><?php echo $judul; ?></h4>
                            </div>
                            <div class=" card-body">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group mb-2">
                                                <label>Petunjuk Soal</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="idbank" id="idbank" value="<?php echo $stimulus['idbank']; ?>">
                                                <input type="hidden" name="idstimulus" id="idstimulus" value="<?php echo $stimulus['idstimulus']; ?>">
                                                <input type="text" class="form-control form-control-sm col-sm-12" name="petunjuk" id="petunjuk" value="<?php echo $stimulus['petunjuk']; ?>">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Stimulus Soal</label>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control form-control-sm" name="stimulus" id="stimulus" style="font-size:14pt; width:100%; height:175px;padding:5px"><?php echo $stimulus['stimulus']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-2 ml-3">
                                                <label>File Pendukung Stimulus</label>
                                            </div>
                                            <div class="form-group mb-2 ml-3">
                                                <img src="<?php echo base_url('assets/img/nofile.png'); ?>" alt="" class="img img-fluid img-bordered-sm img-thumbnail" height="200px">
                                            </div>
                                            <div class="form-group mt-2 ml-3">
                                                <input type="file" name="filestim" id="filestim">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button title="Simpan Stimulus" type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-save mr-2"></i><?php echo $stimulus['tombol']; ?>
                                </button>
                                <a href=" <?php echo base_url('banksoal/isi/' . $stimulus['idbank']); ?>" class="btn btn-danger btn-sm" id="btnSelesai">
                                    <i class="fas fa-power-off mr-2"></i>Selesai
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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