<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SchoolManagementSystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Classes table
$sql = "CREATE TABLE classes (
    class_id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(255) NOT NULL,
    class_stage VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table classes created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
