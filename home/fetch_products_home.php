<?php
// $servername = "localhost";
// $username = "budijaya_admin";
// $password = "ekQkemsQPU@Ux4d";
// $dbname = "budijaya_toko_seragam";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toko_seragam";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT p.id, 
       p.nama, 
       p.deskripsi, 
       p.detail_produk,
       GROUP_CONCAT(DISTINCT u.ukuran ORDER BY u.urutan ASC SEPARATOR ',') AS ukuran,
       GROUP_CONCAT(DISTINCT u.harga ORDER BY u.urutan ASC SEPARATOR ',') AS harga,
       GROUP_CONCAT(DISTINCT g.gambar ORDER BY g.id ASC SEPARATOR ',') AS gambar
       FROM produk p
       JOIN ukuran u ON p.id = u.produk_id
       JOIN gambar g ON p.id = g.produk_id
       WHERE u.stock > 0
       GROUP BY p.id, p.nama, p.deskripsi, p.detail_produk
       LIMIT 8";

$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($products);
?>
