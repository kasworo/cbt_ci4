<style>
.kotak {
    position: relative;
    border-radius: 7.5px;
    top: 0px;
    padding-top: 2.5px;
    box-shadow: 5px 5px #888888;
    border: 2.5px solid #888888;
    color: #888888;
    margin-left: 25px;
    width: 40px;
    height: 40px;
    text-align: center;
    font-size: 15pt;
    font-weight: bold;
    z-index: 1;
}

.isi {
    position: relative;
    left: 12.5px;
    top: -47.5px;
    border-radius: 14px;
    border: 2.5px solid #888888;
    background-color: #888888;
    color: #FFFF;
    font-size: 12pt;
    font-weight: bold;
    width: 28px;
    height: 28px;
    text-align: center;
    z-index: 2;
}
</style>
<div class="col-sm-12  d-flex align-items-stretch justify-content-start">
    <div class="container">
        <div class="row ml-auto">
            <?php
            foreach ($soal as $ids) :
                if ($ids['jnssoal'] == '1') {
                    foreach ($ids['opsi'] as $id => $op) {
                        if ($op['benar'] == '1') {
                            switch ($id) {
                                case 0: {
                                        $hrf = 'A';
                                        break;
                                    }
                                case 1: {
                                        $hrf = 'B';
                                        break;
                                    }
                                case 2: {
                                        $hrf = 'C';
                                        break;
                                    }
                                case 3: {
                                        $hrf = 'D';
                                        break;
                                    }
                                case 4: {
                                        $hrf = 'E';
                                        break;
                                    }
                                default: {
                                        $hrf = '';
                                        break;
                                    }
                            }
                        }
                    }
                    $val = $hrf;
                } else {
                    foreach ($ids['opsi'] as $id => $op) {
                        if ($op['benar'] == '1') {
                            switch ($id) {
                                case 0: {
                                        $hrf = 'A';
                                        break;
                                    }
                                case 1: {
                                        $hrf = 'B';
                                        break;
                                    }
                                case 2: {
                                        $hrf = 'C';
                                        break;
                                    }
                                case 3: {
                                        $hrf = 'D';
                                        break;
                                    }
                                case 4: {
                                        $hrf = 'E';
                                        break;
                                    }
                                default: {
                                        $hrf = '';
                                        break;
                                    }
                            }
                        }
                    }
                    $val = '<i class="fas fa-check-square"></i>';
                }
            ?>
            <a href="#" data-id="<?php echo $ids['nosoal']; ?>" class="tombol" data-dismiss="modal">
                <div class=" kotak"><?php echo $val; ?></div>
                <div class="isi"><?php echo $ids['nosoal']; ?></div>
            </a>
            <?php endforeach ?>
        </div>
    </div>
</div>
<script type="text/javascript">
$(".tombol").click(function() {
    let urut = $(this).data('id')
    tampilsoal(urut)
})
</script>