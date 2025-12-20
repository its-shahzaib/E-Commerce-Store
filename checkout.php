<?php
session_start();

// if cart is empty
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "Your cart is empty!";
    exit;
}

// delivery charges
$delivery_charges = 300;

// calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'];
}
$grand_total = $total + $delivery_charges;
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
</head>

<body>

<h2>Your Order Summary</h2>

<ul>
<?php foreach ($_SESSION['cart'] as $item): ?>
    <li><?php echo $item['name']; ?> - Rs <?php echo $item['price']; ?></li>
<?php endforeach; ?>
</ul>

<p><strong>Total Price:</strong> Rs <?php echo $total; ?></p>
<p><strong>Delivery Charges:</strong> Rs <?php echo $delivery_charges; ?></p>
<p><strong>Grand Total:</strong> Rs <?php echo $grand_total; ?></p>

<h3>Enter Delivery Details</h3>

<form method="post" action="place_order.php">
    <label>Full Name</label>
    <input type="text" name="fullname" required><br><br>

    <label>Phone Number</label>
    <input type="text" name="phone" required><br><br>

    <label>Full Address</label>
    <textarea name="address" required></textarea><br><br>

    <button type="submit">Confirm Order</button>
</form>

</body>
</html>