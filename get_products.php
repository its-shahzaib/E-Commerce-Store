<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

// Get all products
$result = mysqli_query($conn, "SELECT id, name, price, image, category, stock FROM products");
$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

echo json_encode($products);
?>
