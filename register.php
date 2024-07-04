<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $role = $_POST['role'];

    // Check if username or email already exists
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Username or Email already exists.');
                window.location.href = 'register.html';
              </script>";
    } else {
        // Insert user into the users table
        $sql = "INSERT INTO users (full_name, username, password, email, gender, birthday, address, city, state, country, role) 
                VALUES ('$full_name', '$username', '$password', '$email', '$gender', '$birthday', '$address', '$city', '$state', '$country', '$role')";

        if ($conn->query($sql) === TRUE) {
            $user_id = $conn->insert_id;

            if ($role == 'student') {
                $student_stage = $_POST['student_stage'];
                $sql = "INSERT INTO students (user_id, student_name, student_stage) VALUES ('$user_id', '$full_name', '$student_stage')";
            } elseif ($role == 'teacher') {
                $sql = "INSERT INTO teachers (user_id, teacher_name) VALUES ('$user_id', '$full_name')";
            } elseif ($role == 'admin') {
                $sql = "INSERT INTO admin (user_id, admin_name) VALUES ('$user_id', '$full_name')";
            }

            if ($role == 'student' || $role == 'teacher' || $role == 'admin') {
                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                            alert('Registration Successful. Press OK to go to the login page.');
                            window.location.href = 'login.html';
                          </script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
