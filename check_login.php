<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE username = '$username_email' OR email = '$username_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == 'student') {
                header("Location: student_dashboard.php");
            } elseif ($user['role'] == 'teacher') {
                header("Location: teacher_dashboard.php");
            } elseif ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            }
            else {
                echo "<script>
                        alert('Username or Password is incorrect.');
                        window.location.href = 'login.html';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Username or Password is incorrect.');
                    window.location.href = 'login.html';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Username or Password is incorrect.');
                window.location.href = 'login.html';
              </script>";
    }
}
$conn->close();
?>
