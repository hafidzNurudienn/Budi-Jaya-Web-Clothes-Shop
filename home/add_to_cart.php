<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  
  $productId = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
  $nama = filter_var($data['nama'], FILTER_SANITIZE_STRING);
  $gambar = filter_var($data['gambar'], FILTER_SANITIZE_STRING);
  $size = filter_var($data['size'], FILTER_SANITIZE_STRING);
  $price = filter_var($data['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $quantity = filter_var($data['quantity'], FILTER_SANITIZE_NUMBER_INT);

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  $product = [
    'id' => $productId,
    'nama' => $nama,
    'gambar' => $gambar,
    'size' => $size,
    'price' => $price,
    'quantity' => $quantity
  ];

  $_SESSION['cart'][] = $product;

  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false]);
}
?>
