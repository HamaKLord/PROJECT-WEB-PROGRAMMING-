<?php
session_start();
if ($_SESSION['role'] != 'student') {
    header("Location: login.html");
    exit;
}

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id']; // Single course ID

    // Check if the student ID exists
    $sql = "SELECT * FROM students WHERE student_id = '$student_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "<script>alert('Invalid Student ID');</script>";
    } else {
        $row = $result->fetch_assoc();
        $student_name = $row['student_name'];

        // Check if the course ID exists
        $sql = "SELECT * FROM subjects WHERE subject_id = '$course_id'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            echo "<script>alert('Invalid Course ID');</script>";
        } else {
            $row = $result->fetch_assoc();
            $course_name = $row['subject_name'];

            // Insert into the enrollment table
            $sql = "INSERT INTO enrollment (student_id, student_name, course_id, course_name) VALUES ('$student_id', '$student_name', '$course_id', '$course_name')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Enrolled in course successfully');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll in Course - School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Enroll in Course</h1>
        <nav>
            <a href="student_dashboard.php">Home</a>
            <a href="students.php">Students</a>
            <a href="subjects.php">Subjects</a>
            <a href="enroll_course.php">Enroll in Course</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Enroll in a Course</h2>
        <form id="enroll-course-form" action="enroll_course.php" method="post">
            <label for="student_id">Student ID:</label>
            <input type="text" id="student_id" name="student_id" required>
            <br>
            <label for="course_id">Course ID:</label>
            <input type="text" id="course_id" name="course_id" required>
            <br>
            <button type="submit">Enroll</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 School Management System. All rights reserved.</p>
    </footer>
</body>
</html>
