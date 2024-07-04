<?php
session_start();
if ($_SESSION['role'] != 'student') {
    header("Location: login.html");
    exit;
}

include 'config.php';

$user_id = $_SESSION['user_id'];

// Fetch the student's details
$sql = "SELECT * FROM students WHERE user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
    // Set session variables
    $_SESSION['student_id'] = $student['student_id'];
    $_SESSION['student_stage'] = $student['student_stage'];
} else {
    echo "No student information found.";
    exit;
}

// Fetch the user's details
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Set session variables
    $_SESSION['full_name'] = $user['full_name'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['gender'] = $user['gender'];
    $_SESSION['birthday'] = $user['birthday'];
    $_SESSION['address'] = $user['address'];
    $_SESSION['city'] = $user['city'];
    $_SESSION['state'] = $user['state'];
    $_SESSION['country'] = $user['country'];
} else {
    echo "No user information found.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['full_name']; ?></h1>
        <nav>
            <a href="student_dashboard.php">Home</a>
            <a href="students.php">Students</a>
            <a href="subjects.php">Subjects</a>
            <a href="enroll_course.php">Enroll in Course</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Student Dashboard</h2>
        <h3>Your Information</h3>
        <table>
            <tr>
                <th>Student ID</th>
                <td><?php echo $_SESSION['student_id']; ?></td>
            </tr>
            <tr>
                <th>Full Name</th>
                <td><?php echo $_SESSION['full_name']; ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?php echo $_SESSION['username']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $_SESSION['email']; ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo $_SESSION['gender']; ?></td>
            </tr>
            <tr>
                <th>Birthday</th>
                <td><?php echo $_SESSION['birthday']; ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo $_SESSION['address']; ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?php echo $_SESSION['city']; ?></td>
            </tr>
            <tr>
                <th>State</th>
                <td><?php echo $_SESSION['state']; ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo $_SESSION['country']; ?></td>
            </tr>
            <tr>
                <th>Stage</th>
                <td><?php echo $_SESSION['student_stage']; ?></td>
            </tr>
        </table>
    </main>
    
</body>
</html>
