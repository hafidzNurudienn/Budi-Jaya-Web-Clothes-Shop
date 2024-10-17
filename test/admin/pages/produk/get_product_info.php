<?php
include '../../../config/database.php';

// Periksa apakah koneksi berhasil
if (!$kon) {
    die(json_encode(array("error" => "Koneksi database gagal: " . mysqli_connect_error())));
}

$id = isset($_POST["id"]) ? $_POST["id"] : null;

if (!$id) {
    die(json_encode(array("error" => "ID produk tidak diberikan")));
}

$sql = "SELECT * FROM produk WHERE id='$id'";
$hasil = mysqli_query($kon, $sql);

if (!$hasil) {
    die(json_encode(array("error" => "Query gagal: " . mysqli_error($kon))));
}

$data = array();
if ($hasil) {
    $data = mysqli_fetch_assoc($hasil);
}

echo json_encode($data);
?>
