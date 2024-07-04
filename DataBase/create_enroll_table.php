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

// SQL to create enrollment table
$sql = "CREATE TABLE enrollment (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    student_name VARCHAR(255) NOT NULL,
    course_id INT NOT NULL,
    course_name VARCHAR(255) NOT NULL,
   
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (course_id) REFERENCES subjects(subject_id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table enrollment created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
