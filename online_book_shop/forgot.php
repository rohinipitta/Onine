<?php

$Email = $_POST['email'];
$Password = $_POST['password'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'online_book_shop');
if ($conn->connect_error) {
    echo json_encode(array("error" => true, "message" => "Connection failed: " . $conn->connect_error));
    exit();
} else {
    // Check if email already exists
    $checkQuery = "SELECT * FROM users WHERE email = '$Email'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        
        $updateQuery = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ss", $Password, $Email);
        $execval = $stmt->execute();
        if ($execval) {
          header("Location:login.html"); 
            
        } else {
            // Error during password update
            echo json_encode(array("error" => true, "message" => "Error during password update: " . $stmt->error));
        }
        $stmt->close();
    } else {
        // Email does not exist, insert new record
		
       header("Location:incorrect_credintials.html");
    }
    $conn->close();
}
?>
