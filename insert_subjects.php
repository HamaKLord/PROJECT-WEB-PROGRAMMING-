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

// Array of subjects
$subjects = [
    ['101', 'Mathematics'],
    ['102', 'Science'],
    ['103', 'English'],
    ['104', 'History'],
    ['105', 'Geography'],
    ['106', 'Physics'],
    ['107', 'Chemistry'],
    ['108', 'Biology'],
    ['109', 'Computer Science'],
    ['110', 'Physical Education'],
    ['111', 'Art'],
    ['112', 'Music'],
    ['113', 'French'],
    ['114', 'Spanish'],
    ['115', 'Economics']
];

// Insert subjects into the subjects table
foreach ($subjects as $subject) {
    $sql = "INSERT INTO subjects (subject_id, subject_name) VALUES ('$subject[0]', '$subject[1]')";
    if ($conn->query($sql) === TRUE) {
        echo "Subject $subject[1] inserted successfully.<br>";
    } else {
        echo "Error inserting subject $subject[1]: " . $conn->error . "<br>";
    }
}

$conn->close();
?>
