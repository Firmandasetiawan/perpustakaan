<?php
// Include database connection file
include 'koneksi.php';

// Start PHP session
session_start();

// Check if form data has been submitted
if(isset($_POST['login'])) {
    // Get data from login form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    // Query to check if username and level combination exists
    $sql = "SELECT * FROM user WHERE username='$username' AND level='$level'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // If data is found, retrieve user data
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify password using password_verify
        if(password_verify($password, $hashedPassword)) {
            // Set session variables for user
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['level'] = $row['level'];

            // Redirect user based on their level
            switch ($level) {
                case 'Admin':
                    header('Location: admin.dashboard.php');
                    exit;
                case 'Petugas':
                    header('Location: petugas.dashboard.php');
                    exit;
                case 'Peminjam':
                    header('Location: peminjam.dashboard.php');
                    exit;
                default:
                    // If level is invalid, redirect to login page with error message
                    header('Location: login.php?error=level_invalid');
                    exit;
            }
        } else {
            // If password doesn't match, redirect back to login page with error message
            header('Location: login.php?error=login_failed');
            exit;
        }
    } else {
        // If no data found, redirect back to login page with error message
        header('Location: login.php?error=login_failed');
        exit;
    }
} else {
    // If form data not submitted, redirect back to login page with error message
    header('Location: login.php?error=form_not_submitted');
    exit;
}

// Close database connection
$conn->close();
?>
