<?php
require 'koneksi.php';
session_start();

// Check if cookie is set
if (isset($_COOKIE['userid']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['userid'];
    $key = $_COOKIE['key'];

    // Fetch user data based on cookie
    $result = $conn->query("SELECT * FROM user WHERE userid = '$id'");
    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify cookie
        if ($key === $row['userid']) {
            $_SESSION['login'] = true;
            $_SESSION['userid'] = $row['userid']; // Store user id in session
        }
    }
}

// Handle form submission
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check for empty fields
    if (empty($username) || empty($password)) {
        echo "<script>alert('Username dan password wajib diisi'); window.location='login.php';</script>";
        exit;
    }
    $result = $conn->query("SELECT * FROM user WHERE username = '$username'");
        if ($result->num_rows === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($password == $row["password"]) {
            // Set session variables
            $_SESSION["login"] = true;
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['level'] = $row['level'];
            $level = $row['level'];

            // Redirect based on user level
            switch ($level) {
                case 'Admin':
                    header("Location: admin_dashboard.php");
                    exit;
                case 'Petugas':
                    header("Location: petugas_dashboard.php");
                    exit;
                case 'Peminjam':
                    header("Location: peminjam_dashboard.php");
                    exit;
            }
        } else {
            echo "<script>alert('Password salah'); window.location='login.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Username tidak ditemukan'); window.location='login.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('img/p.jpg'); /* Ganti 'nama-file-gambar.jpg' dengan path atau URL gambar Anda */
    background-size: cover; /* Untuk memastikan gambar latar belakang menutupi seluruh area */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 300px; /* Atur lebar kotak sesuai kebutuhan */
    padding: 30px;
    background-color: #20af6c;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    text-align: center;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #00ff88;
    color: #fff;
    border: none;
    border-radius: 300px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #000000;
}

.error {
    color: red;
    text-align: center;
    margin-bottom: 10px;
}
        </style>

</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login" name="login">
        </form>
    </div>
</body>
</html>