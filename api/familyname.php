<?php
include '../koneksi.php';

$request_method = $_SERVER["REQUEST_METHOD"];
header('Content-Type: application/json');
switch ($request_method) {
        case 'GET':
                $sql = "select * from family";
                $ps = $connect->prepare($sql);
                $ps->execute();
                $rs = $ps->fetchAll();
                foreach ($rs as $key => $value) {
                        $data[$key]["id"] = $value["id"];
                        $data[$key]["nama"] = $value["nama"];
                        $data[$key]["family"] = $value["family"];
                        $data[$key]["family_id"] = $value["family_id"];
                        $data[$key]["parent"] = $value["parent"];
                        $data[$key]["parent_id"] = $value["parent_id"];
                        $data[$key]["posisi"] = $value["posisi"];
                }

                $response = array(
                        'status' => true,
                        'message' => 'Success',
                        'data' => $data
                );
                echo json_encode($response);
                break;
        case 'POST':
                $sql = "SELECT max(family) as idLast from family where family != 0  and posisi='root'";
                $ps = $connect->prepare($sql);
                $ps->execute();
                $rs = $ps->fetch();
                $data = [
                        $_POST['nama'],
                        $_POST['jenis_kelamin'],
                        'root',
                        $rs['idLast']+1,
                ];

                $sql = "INSERT INTO family(nama,jenis_kelamin,posisi,family)
                    VALUES (?,?,?,?)";
                $ps = $connect->prepare($sql);
                
                if ($ps->execute($data)) {
                        $response = array(
                                'status' => true,
                                'message' => 'Data berhasil ditambahkan',
                        );
                } else {
                        $response = array(
                                'status' => false,
                                'message' => 'Data gagal ditambahkan',
                        );
                }
                echo json_encode($response);


                break;
        default:
                header("HTTP/1.0 405 Method Not Allowed");
                break;
                break;
}
