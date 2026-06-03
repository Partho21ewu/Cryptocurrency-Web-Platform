<?php

// Check if a message was submitted via POST
if (isset($_POST["message"])) {
	$message = $_POST["message"];

	// Connect to the database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "login_register";
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Insert the message into the database
	$sql = "INSERT INTO messages (sender_id, receiver_id, message_content) VALUES (1, 2, '$message')";
	$conn->query($sql);
	
	// Close the database connection
	$conn->close();
}

?>
