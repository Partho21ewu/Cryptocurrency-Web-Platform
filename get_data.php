<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_register";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve cryptocurrency data from the database
$cryptocurrency = "Bitcoin";
$source = "Coinbase";
$sql = "SELECT timestamp, price FROM crypto_prices WHERE cryptocurrency='$cryptocurrency' AND source='$source'";
$result = $conn->query($sql);

// Format the data for Highcharts
$data = array();
while ($row = $result->fetch_assoc()) {
	$timestamp = strtotime($row['timestamp']) * 1000; // Convert to milliseconds
	$price = floatval($row['price']);
	$data[] = array($timestamp, $price);
}

// Close the database connection
$conn->close();
?>
