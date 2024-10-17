<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $productId = $data['id'];
  $quantity = $data['quantity'];

  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $item) {
      if ($item['id'] == $productId) {
        $_SESSION['cart'][$key]['quantity'] = $quantity;
        echo json_encode(['success' => true]);
        exit;
      }
    }
  }
  echo json_encode(['success' => false]);
}
?>
