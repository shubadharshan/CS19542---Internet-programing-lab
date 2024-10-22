<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "news_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get posted data
$headline = $_POST['headline'];
$description = $_POST['description'];

// Insert news into the database
$sql = "INSERT INTO news (headline, description) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $headline, $description); // "ss" means both are strings

if ($stmt->execute()) {
    echo "News added successfully!";
} else {
    echo "Error: " . $stmt->error; // Display the error
}

$stmt->close();
$conn->close();
?>
