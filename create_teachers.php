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

// SQL to create teachers table
$sql = "CREATE TABLE IF NOT EXISTS teachers (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    subject VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table teachers created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
