<?php
// Connect to database
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "login_register";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Get order data from form submission
$crypto = $_POST["crypto"];
$quantity = $_POST["quantity"];
$price = $_POST["price"];
$order_type = $_POST["order_type"];

// Insert order into database
$sql = "INSERT INTO orders (crypto, quantity, price, order_type) VALUES ('$crypto', $quantity, $price, '$order_type')";

if (mysqli_query($conn, $sql)) {
	echo "Order placed successfully!";
} else {
	echo "Error: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
