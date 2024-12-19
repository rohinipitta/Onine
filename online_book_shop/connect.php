<?php
$Name = $_POST['name'];
$Email = $_POST['email'];
$Password = $_POST['password'];

// Database connectionx
$conn = new mysqli('localhost', 'root', '', 'online_book_shop');
if ($conn->connect_error) {
    echo json_encode(array("error" => true, "message" => "Connection failed: " . $conn->connect_error));
    exit();
} else {
    // Check if email or name already exists
    $checkQuery = "SELECT * FROM users WHERE email = '$Email' OR name = '$Name'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        // Email or name already exists
   
	  header('location:u.html');
	  exit;
    } else {
        // Insert new record
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $Name, $Email, $Password);
        $execval = $stmt->execute();
        if ($execval) {
            // Account created successfully
         header('location:account_created_sucessfully.html');
		  exit;
        } else {
            // Error during registration
            echo json_encode(array("error" => true, "message" => "Error during registration: " . $stmt->error));
        }
        $stmt->close();
    }
    $conn->close();
}
?>
