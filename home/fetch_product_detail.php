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

$productId = $_GET['id'];

$sql = "SELECT p.id, 
       p.nama, 
       p.deskripsi, 
       p.detail_produk,
       (SELECT GROUP_CONCAT(u.ukuran ORDER BY u.urutan ASC SEPARATOR ',')
        FROM ukuran u
        WHERE u.produk_id = p.id AND u.stock > 0) AS ukuran,
       (SELECT GROUP_CONCAT(u.harga ORDER BY u.urutan ASC SEPARATOR ',')
        FROM ukuran u
        WHERE u.produk_id = p.id AND u.stock > 0) AS harga,
       (SELECT GROUP_CONCAT(u.stock ORDER BY u.urutan ASC SEPARATOR ',')
        FROM ukuran u
        WHERE u.produk_id = p.id AND u.stock > 0) AS stock,
       (SELECT GROUP_CONCAT(g.gambar ORDER BY g.id ASC SEPARATOR ',')
        FROM gambar g
        WHERE g.produk_id = p.id) AS gambar
        FROM produk p
        WHERE p.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

$product = [];
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($product);
?>
