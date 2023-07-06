<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>
<section class="content-wrapper" style="background:url(/assets/img/boxed-bg.png)">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" id="hdTitle"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item" id="hdMenu"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <?php echo session()->get('level'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $this->endSection(); ?>