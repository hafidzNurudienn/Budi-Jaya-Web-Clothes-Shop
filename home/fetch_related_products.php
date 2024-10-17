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

// Mengambil deskripsi dari produk saat ini
$sql = "SELECT deskripsi FROM produk WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();
$stmt->bind_result($deskripsi);
$stmt->fetch();
$stmt->close();

// Mengambil produk terkait berdasarkan deskripsi yang mirip menggunakan LIKE
$sql = "SELECT p.id, 
       p.nama, 
       p.deskripsi, 
       p.detail_produk,
       GROUP_CONCAT(u.ukuran ORDER BY u.urutan ASC SEPARATOR ',') AS ukuran,
       GROUP_CONCAT(u.harga ORDER BY u.urutan ASC SEPARATOR ',') AS harga,
       GROUP_CONCAT(g.gambar ORDER BY g.id ASC SEPARATOR ',') AS gambar
       FROM produk p
       JOIN ukuran u ON p.id = u.produk_id
       JOIN gambar g ON p.id = g.produk_id
       WHERE u.stock > 0 AND p.id != ? AND p.deskripsi LIKE ?
       GROUP BY p.id, p.nama, p.deskripsi, p.detail_produk
       LIMIT 4";

$likeDeskripsi = "%" . $deskripsi . "%";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $productId, $likeDeskripsi);
$stmt->execute();
$result = $stmt->get_result();

$related_products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $related_products[] = $row;
    }
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($related_products);
?>
