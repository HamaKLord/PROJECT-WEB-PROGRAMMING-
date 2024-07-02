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

// SQL to create students table
$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    class_id INT(6) UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (class_id) REFERENCES classes(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table students created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
