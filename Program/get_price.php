<?php
include_once 'config.php';

$conn = mysqli_connect('localhost', 'root', '', 'kopisyop');

$id = $_GET['menu'];
$query = "SELECT * FROM menu WHERE ID = $id";
$result = mysqli_query($conn, $query);

if($result) {
    while($temp = mysqli_fetch_assoc($result)) {
        $datas[] = [
            "price" => $temp["harga"],
        ];
    }
}

mysqli_close($conn);
header('Content-Type: application/json');
echo json_encode($datas);