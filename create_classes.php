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

// SQL to create classes table
$sql = "CREATE TABLE IF NOT EXISTS classes (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(100) NOT NULL,
    teacher_id INT(6) UNSIGNED,
    FOREIGN KEY (teacher_id) REFERENCES teachers(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table classes created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
