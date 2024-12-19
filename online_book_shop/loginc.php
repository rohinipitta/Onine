<?php
// Start session
session_start();

// Database credentials
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "online_book_shop"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user inputs
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare SQL statement to retrieve user with matching credentials
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Store user email in session
        $_SESSION['email'] = $email;

        // Redirect to home page upon successful login
        header("Location:home_page.html");
        exit; // Ensure script stops execution after redirect
    } else {
        // Redirect to page with incorrect credentials message
        header("Location:incorrect_credintials.html");
        exit;
    }
}

// Close database connection
$conn->close();
?>
