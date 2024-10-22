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

// Fetch news from database
$sql = "SELECT headline, description, created_at FROM news ORDER BY created_at DESC";
$result = $conn->query($sql);

$news = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $news[] = $row; // Add each row to the news array
    }
} 

$conn->close();

// Return news as JSON
header('Content-Type: application/json');
echo json_encode($news);
?>
