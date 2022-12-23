<?php
include_once 'koneksi.php';
include_once 'models/Family.php';

$nama = $_POST['nama'];
$jk = $_POST['jenis_kelamin'] ?? 'L';
$posisi = $_POST['posisi'];
$family_id = $_POST['family_id'];
$parent_id = $_POST['parent_id'] ?? 0;

$data = [
    $nama,
    $jk,
    $posisi,
    $family_id
];

$tombol = $_POST['proses'];

$model = new Family();

if ($tombol == 'simpan') {
    if ($posisi == 'Anak') {
        $idLastParent = $model->getLastIdParent($family_id)['idLast'] ?? 0;
        $data[] = $idLastParent + 1;
        $data[] = 0;
    } else {
        $data[] = 0;
        $data[] = $parent_id;
    }
    $model->simpan($data);
} else if ($tombol == 'ubah') {
    if ($posisi == 'Anak') {
        if ($posisi == $_POST['posisiBefore']) {
            $data[] = $_POST['parentBefore'];
            $data[] = 0;
        } else {
            $idLastParent = $model->getLastIdParent($family_id)['idLast'] ?? 0;
            $data[] = $idLastParent + 1;
            $data[] = 0;
        }
    } else {
        $data[] = 0;
        $data[] = $parent_id;
    }
    $data[] = $_POST['idx'];
    $model->ubah($data);
} else if ($tombol == 'hapus') {
    unset($data);
    $id = [$_POST['idx']];
    $model->hapusRoot($id);
} else {
    header('Location:index.php?hal=keluarga');
}

header('Location:index.php?hal=keluarga');
