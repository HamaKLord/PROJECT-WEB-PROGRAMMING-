<?php

/* 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SchoolManagement";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create tables
$sql = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    gender ENUM('male', 'female', 'other') NOT NULL,
    birthday DATE NOT NULL,
    address VARCHAR(255),
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    role ENUM('student', 'teacher', 'admin') NOT NULL,
    status ENUM('pending', 'approved') DEFAULT 'pending'
);

CREATE TABLE IF NOT EXISTS students (
    id INT PRIMARY KEY,
    stage INT NOT NULL,
    FOREIGN KEY (id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS teachers (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(100) NOT NULL,
    teacher_id INT NOT NULL,
    FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    class_id INT NOT NULL,
    subject_id INT NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE
);
";

if ($conn->multi_query($sql) === TRUE) {
    echo "Tables created successfully";
} else {
    echo "Error creating tables: " . $conn->error;
}

$conn->close();

*/

/*

$sql = "
-- Add student_name to students table
ALTER TABLE students ADD student_name VARCHAR(100) NOT NULL;

-- Add student_count to classes table
ALTER TABLE classes ADD student_count INT DEFAULT 0;

-- Add student_subject_count to enrollments table
ALTER TABLE enrollments ADD student_subject_count INT DEFAULT 0;

-- Trigger to update student_count after insert on enrollments
CREATE TRIGGER update_student_count_after_insert
AFTER INSERT ON enrollments
FOR EACH ROW
BEGIN
    UPDATE classes SET student_count = student_count + 1 WHERE id = NEW.class_id;
END;

-- Trigger to update student_count after delete on enrollments
CREATE TRIGGER update_student_count_after_delete
AFTER DELETE ON enrollments
FOR EACH ROW
BEGIN
    UPDATE classes SET student_count = student_count - 1 WHERE id = OLD.class_id;
END;

-- Trigger to update student_subject_count after insert on enrollments
CREATE TRIGGER update_student_subject_count_after_insert
AFTER INSERT ON enrollments
FOR EACH ROW
BEGIN
    UPDATE enrollments SET student_subject_count = student_subject_count + 1 WHERE subject_id = NEW.subject_id;
END;

-- Trigger to update student_subject_count after delete on enrollments
CREATE TRIGGER update_student_subject_count_after_delete
AFTER DELETE ON enrollments
FOR EACH ROW
BEGIN
    UPDATE enrollments SET student_subject_count = student_subject_count - 1 WHERE subject_id = OLD.subject_id;
END;
"; */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $class_name = htmlspecialchars($_POST['class_name']);
    $teacher_id = htmlspecialchars($_POST['teacher_id']);
    $teacher_name = htmlspecialchars($_POST['teacher_name']);

    // Database connection details
    $servername = "localhost";
    $username = "root"; // Change this if your MySQL username is different
    $password = ""; // Change this if your MySQL password is different
    $dbname = "SchoolManagement"; // Your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO classes (class_name, teacher_id, teacher_name) VALUES ('$class_name', '$teacher_id', '$teacher_name')";

    if ($conn->query($sql) === TRUE) {
        echo "New class added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}



?>
