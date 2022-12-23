<?php
$idedit = $_REQUEST['idedit'] ?? null;
$model = new Family();
if (!empty($idedit)) {
  $rs = $model->detailRoot([$idedit]);
  $cekFamily = $model->cekFamily($idedit);
  $jml = $cekFamily['jml'];
} else {
  $rs = [];
  $jml = 0;
}

$ar_gender = ['Laki-Laki' => 'L', 'Perempuan' => 'P'];
?>

<h3>Form Nama Keluarga</h3>
<form method="POST" action="controller_family.php">
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
      if (empty($idedit)) {
      ?>
        <button name="prosesRoot" value="simpan" type="submit" class="btn btn-primary">Simpan</button>
      <?php
      } else {
      ?>
        <button name="prosesRoot" value="ubah" type="submit" class="btn btn-warning">Edit</button>
        <?php
        if ($jml <= 0) { ?>
          <button name="prosesRoot" value="hapus" type="submit" onClick="return confirm('are you sure?')" class="btn btn-danger">Hapus</button>
        <?php
        }
        ?>
        <input type="hidden" name="idx" value="<?= $idedit ?>" />
      <?php } ?>
      <a href="index.php?hal=keluarga_master" type="button" class="btn btn-info">Batal</a>
    </div>
  </div>
</form>