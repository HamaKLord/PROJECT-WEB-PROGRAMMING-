<?php
//connecting to the database
include('config.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SchoolMS";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
$conn->select_db($dbname);

// SQL to create login table
$sql = "CREATE TABLE IF NOT EXISTS login (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table login created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
