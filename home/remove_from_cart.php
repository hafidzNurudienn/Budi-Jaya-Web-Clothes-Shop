<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $productId = $data['id'];

  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $item) {
      if ($item['id'] == $productId) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
        echo json_encode(['success' => true]);
        exit;
      }
    }
  }
  echo json_encode(['success' => false]);
}
?>
