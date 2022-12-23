<?php

$idedit = $_REQUEST['idedit'] ?? null;
$model = new Family();
if (!empty($idedit)) {
  $rs = $model->detail([$idedit]);
  $cekFamily = $model->cekFamilyParent($rs['parent'] ?? 0);
  $jml = $cekFamily['jml'];
} else {
  $rs = [];
  $jml = 0;
}

$dataroot = $model->dataRoot();

$ar_gender = ['Laki-Laki' => 'L', 'Perempuan' => 'P'];
$ar_posisi = ['Anak', 'Cucu'];
?>

<h3>Form Keluarga</h3>
<form method="POST" action="controller_family2.php">

  <div class="form-group row">
    <label for="nama" class="col-4 col-form-label">Nama Kelurga</label>
    <div class="col-8">
      <?php
      $dis = '';
      ?>
      <select id="family_id" name="family_id" required class="custom-select" <?= $dis ?>>
        <option value="">-- Nama Keluarga --</option>
        <?php
        foreach ($dataroot as $root) {
          if ($root['family'] == $rs['family_id']) {
            $sel = 'selected';
          } else {
            $sel = '';
          }
        ?>
          <option value="<?= $root['family'] ?>" <?= $sel ?>><?= $root['nama'] ?></option>
        <?php
        }
        ?>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="nama" class="col-4 col-form-label">Posisi</label>
    <div class="col-8">
      <select id="posisi" name="posisi" onchange="cekPosisi(this.value)" required class="custom-select">
        <option value="">-- Pilih Posisi --</option>
        <?php
        foreach ($ar_posisi as $posisi) {
          if ($posisi == $rs['posisi']) {
            $sel2 = 'selected';
          } else {
            $sel2 = '';
          }
        ?>
          <option value="<?= $posisi ?>" <?= $sel2 ?>><?= $posisi ?></option>
        <?php
        }
        ?>
      </select>
    </div>
  </div>

  <div id="divOrtu">

  </div>



  <div class="form-group row">
    <label for="nip" class="col-4 col-form-label">Nama</label>
    <div class="col-8">
      <input id="nama" required name="nama" type="text" value="<?= $rs['nama'] ?? '' ?>" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">Gender</label>
    <div class="col-8">
      <?php
      foreach ($ar_gender as $label => $jk) {
        //tampilkan data lama
        if (isset($rs) && !empty($rs)) {
          $cek = ($jk == $rs['jenis_kelamin']) ? 'checked' : '';
        } else {
          $cek = '';
        }

      ?>
        <div class="form-check form-check-inline">
          <input name="jenis_kelamin" type="radio" <?= $cek ?> class="form-check-input" value="<?= $jk ?>">
          <label class="form-check-label"><?= $label ?></label>
        </div>
      <?php } ?>
    </div>
  </div>
  <div class="form-group row">
    <div class="offset-4 col-8">
      <?php
      if (empty($idedit)) { //--------modus entry data baru--------
      ?>
        <button name="proses" value="simpan" type="submit" class="btn btn-primary">Simpan</button>
      <?php
      } else {
      ?>
        <button name="proses" value="ubah" type="submit" class="btn btn-warning">Edit</button>
        <?php
        if ($jml <= 0) { ?>
          <button name="proses" value="hapus" type="submit" onClick="return confirm('are you sure?')" class="btn btn-danger">Hapus</button>
        <?php
        }
        ?>
        <input type="hidden" name="idx" value="<?= $idedit ?>" />
        <input type="hidden" name="posisiBefore" value="<?= $rs['posisi'] ?>" />
        <input type="hidden" name="parentBefore" value="<?= $rs['parent'] ?>" />

      <?php } ?>
      <a href="index.php?hal=keluarga" type="button" class="btn btn-info">Batal</a>
    </div>
  </div>
</form>
<script type="text/javascript">
  var pos = "<?= $rs['posisi'] ?? '' ?>"
  var editId = "<?= $idedit ?? '' ?>"
  var parentId = "<?= $rs['parent_id'] ?? '' ?>"


  $(document).ready(function() {
    if (pos == 'Cucu') {
      cekPosisi(pos)
    }
  });

  function cekPosisi(posisi) {
    var idRoot = $("#family_id").val();

    if (posisi == 'Cucu') {
      $("#divOrtu").show();
      $.ajax({
        type: "POST",
        url: "getData.php?act=cekPosisi",
        data: "id=" + idRoot,
        cache: false,
        beforeSend: function() {
          $("#divOrtu").html('Loading....');
        },
        success: function(html) {

          $("#divOrtu").html(html);
          if (editId) {
            $("#parent_id").val(parentId);
          }
        }
      });
    } else {
      $("#divOrtu").hide();
      $("#parent_id").val('');
    }
  }
</script>