<?php

  $ar_judul = [
    'No', 'Nama', 'Gender','Posisi','Nama Kelurga', 'Action'
  ];
?>
  <h3>Data Family</h3>
  <a href="index.php?hal=form_keluarga" type="button" class="btn btn-primary">Input Data</a>
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
      $rs = $model->data();

      $no = 1;
      foreach ($rs as $data) {
      ?>
        <tr>
          <th scope="row"><?= $no ?></th>
          <td><?= $data['nama'] ?></td>
          <td><?= $data['jenis_kelamin'] ?></td>
          <td><?= $data['posisi'] ?></td>
          <td><?= $data['namaKeluarga'] ?></td>
          <td>
            <a href="index.php?hal=form_keluarga&idedit=<?= $data['id'] ?>" type="button" class="btn btn-warning">Edit</a>
          </td>
        </tr>
      <?php $no++;
      } ?>
    </tbody>
  </table>