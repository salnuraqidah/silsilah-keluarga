<?php
include '../koneksi.php';

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
        case 'GET':
                header('Content-Type: application/json');
                $id = $_GET['id'];
                $sql = "select * from family where family_id=$id";
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
                        'status' => 1,
                        'message' => 'Success',
                        'data' => $data
                );
                echo json_encode($response);
                break;

        default:
                header("HTTP/1.0 405 Method Not Allowed");
                break;
                break;
}
