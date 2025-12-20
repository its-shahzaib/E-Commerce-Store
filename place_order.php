<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("You must login to place an order!");
}

$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    die("Your cart is empty!");
}

// Capture delivery details from POST
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$phone    = mysqli_real_escape_string($conn, $_POST['phone']);
$address  = mysqli_real_escape_string($conn, $_POST['address']);
$delivery_charges = 300;

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'];
}
$grand_total = $total + $delivery_charges;

// 1️⃣ Insert main order
mysqli_query($conn, "INSERT INTO orders (user_id, fullname, phone, address, total_amount) 
VALUES ('$user_id', '$fullname', '$phone', '$address', '$grand_total')");

$order_id = mysqli_insert_id($conn);

// 2️⃣ Insert order details and reduce stock
foreach ($_SESSION['cart'] as $item) {
    $product_id = intval($item['id']);
    $quantity   = isset($item['quantity']) ? intval($item['quantity']) : 1;
    $price      = floatval($item['price']);

    // Check stock
    $res = mysqli_query($conn, "SELECT stock FROM products WHERE id=$product_id");
    $row = mysqli_fetch_assoc($res);
    if ($row['stock'] < $quantity) {
        die("Sorry! Stock for {$item['name']} is insufficient.");
    }

    // Insert into order_details
    mysqli_query($conn, "INSERT INTO order_details (order_id, product_id, quantity, price) 
                        VALUES ('$order_id', '$product_id', '$quantity', '$price')");

    // Reduce stock
    mysqli_query($conn, "UPDATE products SET stock = stock - $quantity WHERE id = $product_id");
}

// Clear cart
unset($_SESSION['cart']);

echo "✅ Order placed successfully! Your order ID is: $order_id";
echo "<br><a href='index.php'>Back to Store</a>";
?>