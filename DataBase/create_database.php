<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE SchoolManagementSystem";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db("SchoolManagementSystem");

// Create Users table
$sql = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    birthday DATE NOT NULL,
    address VARCHAR(255),
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    role ENUM('student', 'teacher', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Create Students table
$sql = "CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    student_name VARCHAR(255) NOT NULL,
    student_stage VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table students created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Create Teachers table
$sql = "CREATE TABLE teachers (
    teacher_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    teacher_name VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table teachers created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Create Subjects table
$sql = "CREATE TABLE subjects (
    subject_id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table subjects created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Create Enrollment table
$sql = "CREATE TABLE enrollment (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    student_name VARCHAR(255) NOT NULL,
    student_stage VARCHAR(255) NOT NULL,
    subject_id INT NOT NULL,
    subject_name VARCHAR(255) NOT NULL,
    teacher_id INT NOT NULL,
    teacher_name VARCHAR(255) NOT NULL,
    course_id INT NOT NULL,
    course_name VARCHAR(255) NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id),
    FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table enrollment created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
