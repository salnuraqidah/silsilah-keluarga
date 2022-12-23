<?php
include_once 'koneksi.php';
include_once 'models/Family.php';
$model = new Family();
switch ($_GET["act"]) {
    case "cekPosisi":
        $family_id = $_POST['id'];
        $datas = $model->getOrangTua($family_id);
?>
        <div class="form-group row">
            <label for="nama" class="col-4 col-form-label">Orang Tua</label>
            <div class="col-8">
                <?php
                $dis = '';
                ?>
                <select id="parent_id" name="parent_id" class="custom-select" <?= $dis ?>>
                    <option value="">-- Pilih Orang Tua --</option>
                    <?php
                    foreach ($datas as $data) {
                    ?>
                        <option value="<?= $data['parent'] ?>"><?= $data['nama'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
<?php






        break;

    default:
        # code...
        break;
}

?>