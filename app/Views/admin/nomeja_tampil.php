<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo $judul; ?></h4>

                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <iframe id="pdf-frame" style="border: 1px solid #ccc" width=" 100%" height="500px"
                                frameborder="0"></iframe>
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