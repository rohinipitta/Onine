<?php
// Establish database connection
$servername = "localhost"; // Change to your server name
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "online_book_shop"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email and password from form submission
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare SQL statement to check email and password
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if there is a matching row
if ($result->num_rows > 0) {
    // Delete the row from the database
    $delete_stmt = $conn->prepare("DELETE FROM users WHERE email = ?");
    $delete_stmt->bind_param("s", $email);
    $delete_stmt->execute();
    header("Location:mainpage.html");
	exit;
} else {
    header("Location:incorrect_credintials.html");
exit;}
// Close connections
$stmt->close();
$delete_stmt->close();
$conn->close();
?>
