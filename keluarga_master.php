<?php

$ar_judul = [
  'No', 'Nama', 'Gender', 'Action'
];
?>
<h3>Data Family</h3>
<a href="index.php?hal=form_keluarga_master" type="button" class="btn btn-primary">Input Data</a>
<br />
<table class="table table-sm table-dark">
  <thead>
    <tr>
      <?php
      foreach ($ar_judul as $jdl) {
      ?>
        <th scope="col"><?= $jdl ?></th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $model = new Family();
    $rs = $model->dataRoot();

    $no = 1;
    foreach ($rs as $data) {
    ?>
      <tr>
        <th scope="row"><?= $no ?></th>
        <td><?= $data['nama'] ?></td>
        <td><?= $data['jenis_kelamin'] ?></td>
        <td>
          <a href="index.php?hal=form_keluarga_master&idedit=<?= $data['id'] ?>" type="button" class="btn btn-warning">Edit</a>
        </td>
      </tr>
    <?php $no++;
    } ?>
  </tbody>
</table>