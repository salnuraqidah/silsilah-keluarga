<?php
include_once 'koneksi.php';
include_once 'models/Family.php';

$nama = $_POST['nama'];
$jk = $_POST['jenis_kelamin'];
$posisi = $_POST['posisi'] ?? null;


$data = [
    $nama,
    $jk,
];

$tombol = $_POST['prosesRoot'];

$model = new Family();

if ($tombol == 'simpan') {
    $idLast = $model->getLastIdRoot()['idLast'] ?? 0;
    $data = array_merge($data, ['root', $idLast + 1]);
    $model->simpanRoot($data);
} else if ($tombol == 'ubah') {
    $data[] = $_POST['idx'];
    $model->ubahRoot($data);
} else if ($tombol == 'hapus') {
    unset($data);
    $id = [$_POST['idx']];
    $model->hapusRoot($id);
} else {
    header('Location:index.php?hal=keluarga_master');
}

header('Location:index.php?hal=keluarga_master');
