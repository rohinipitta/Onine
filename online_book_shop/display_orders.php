<?php
session_start();

// Check if the user is logged in
if(!isset($_SESSION['email'])) {
  // Redirect to login page if not logged in
  header("Location: loginc.php");
  exit();
}

// Get the logged-in user's email
$email = $_SESSION['email'];

// Database connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'online_book_shop';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch orders for the logged-in user
$sql = "SELECT * FROM orders WHERE user_email = '$email'";
$result = $conn->query($sql);

// Display orders
if ($result->num_rows > 0) {
	echo "<p style='color:black; font-size:25px;'>Your Orders</p>";

  while($row = $result->fetch_assoc()) {
    echo "<div class='order'>";
   echo "<img src='" . $row['path'] . "' style='width: 150px; height: 150px; color:black; font-size:20px;'>";

    echo "<p>Book Name: " . $row['book_name'] . "</p>";
    echo "<p>Price: " . $row['price'] . "</p>";
    echo "</div>";
  }
} else {
  echo "No orders found for the logged-in user.";
}

// Close database connection
$conn->close();
?>
