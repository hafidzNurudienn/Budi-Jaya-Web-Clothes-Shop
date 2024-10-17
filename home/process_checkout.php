<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart_data'])) {
 
    header('Location: test/index.php?page=checkout');
    exit();
} else {
    // Handle the case where the cart data is not properly sent
    echo "No cart data received.";
}
?>