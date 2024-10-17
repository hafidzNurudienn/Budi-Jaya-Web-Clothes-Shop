<?php
session_start();
include 'database.php';
$kode_pelanggan = $_SESSION["kode_pelanggan"];
$query = mysqli_query($kon, "SELECT * FROM pelanggan WHERE kode_pelanggan='$kode_pelanggan'");
$data = mysqli_fetch_array($query);
echo json_encode($data);
?>