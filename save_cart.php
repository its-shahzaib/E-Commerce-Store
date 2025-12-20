<?php
session_start();

// Read JSON sent from JS
$cart = json_decode(file_get_contents("php://input"), true);

$_SESSION['cart'] = $cart;

echo "Cart saved";
?>