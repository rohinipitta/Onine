<?php
session_start();

// Database connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'online_book_shop';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['buy'])) {
  // Get user email from session
  $email = $_SESSION['email']; // Retrieve user's email from session
  
  // Get book details
  $book_name = $_POST['book_name'];
  $price = $_POST['price'];
  $image_url=$_POST['image_url'];
  
  // Insert into database
$sql = "INSERT INTO orders (user_email, book_name, price, path) VALUES ('$email', '$book_name', '$price', '$image_url')";
  if ($conn->query($sql) === TRUE) {
   
	header("Location:order_success.html");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
