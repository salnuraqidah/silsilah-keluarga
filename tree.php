<style>
    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }

    #wrapper {
        position: relative;
    }

    .branch {
        position: relative;
        margin-left: 250px;
    }

    .branch:before {
        content: "";
        width: 50px;
        border-top: 2px solid #78C2AD;
        position: absolute;
        left: -100px;
        top: 50%;
        margin-top: 1px;
    }

    .entry {
        position: relative;
        min-height: 60px;
    }

    .entry:before {
        content: "";
        height: 100%;
        border-left: 2px solid #78C2AD;
        position: absolute;
        left: -50px;
    }

    .entry:after {
        content: "";
        width: 50px;
        border-top: 2px solid #78C2AD;
        position: absolute;
        left: -50px;
        top: 50%;
        margin-top: 1px;
    }

    .entry:first-child:before {
        width: 10px;
        height: 50%;
        top: 50%;
        margin-top: 2px;
        border-radius: 10px 0 0 0;
    }

    .entry:first-child:after {
        height: 10px;
        border-radius: 10px 0 0 0;
    }

    .entry:last-child:before {
        width: 10px;
        height: 50%;
        border-radius: 0 0 0 10px;
    }

    .entry:last-child:after {
        height: 10px;
        border-top: none;
        border-bottom: 2px solid #78C2AD;
        border-radius: 0 0 0 10px;
        margin-top: -9px;
    }

    .entry.sole:before {
        display: none;
    }

    .entry.sole:after {
        width: 50px;
        height: 0;
        margin-top: 1px;
        border-radius: 0;
    }

    .label {
        display: block;
        min-width: 150px;
        padding: 5px 10px;
        line-height: 20px;
        text-align: center;
        border: 2px solid #78C2AD;
        border-radius: 5px;
        position: absolute;
        left: 0;
        top: 50%;
        margin-top: -15px;
    }
</style>
<?php
$model = new Family();
$rs = $model->dataRoot();
?>
<?php
foreach ($rs as $root) { 
    if ($root['jenis_kelamin']=='L') {
        $color = '#2fa8ed';
    } else {
        $color = '#e35fb5';
    }
    ?>

    <div id="wrapper"><span class="label" style="background-color: <?=$color?>; color: white;"><?= $root['nama'] ?></span>
        <div class="branch lv1">
            <?php
            $anaks = $model->getOrangTua($root['family']);
           

            foreach ($anaks as $anak) { 
                if ($anak['jenis_kelamin']=='L') {
                    $color = '#2fa8ed';
                } else {
                    $color = '#e35fb5';
                }
                ?>
                <div class="entry"><span style="background-color: <?=$color?>; color: white;" class="label"><?= $anak['nama'] ?></span>
                    <?php
                    $cucus = $model->getAnak($anak['parent'],$root['family']);
                    if (isset($cucus) and !empty($cucus)) { 
                        
                        ?>
                        <div class="branch lv2">
                            <?php
                            foreach ($cucus as $cucu) { 
                                if ($cucu['jenis_kelamin']=='L') {
                                    $color = '#2fa8ed';
                                } else {
                                    $color = '#e35fb5';
                                }?>
                                <div class="entry"><span style="background-color: <?=$color?>; color: white;" class="label"><?= $cucu['nama'] ?></span>

                                </div>

                            <?php }
                            ?>
                        </div>

                    <?php
                    }
                    ?>



                </div>


            <?php }


            ?>




        </div>
    </div>
<?php
}
?>