<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $nama_lengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];
    $level = $_POST['level'];
    $randomID = rand(100000000, 999999999);

    // Hash password sebelum menyimpannya ke dalam database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (userid, username, password, email, namalengkap, alamat, level)
            VALUES ('$randomID', '$username', '$hashed_password', '$email', '$nama_lengkap', '$alamat', '$level')";

    if ($conn->query($sql) === TRUE) {
        echo '<div style="color: green;">Registrasi berhasil untuk pengguna: ' . $username . '</div>';
        // Arahkan pengguna ke halaman login setelah registrasi berhasil
        header("Location: login.php");
        exit(); // Pastikan tidak ada output lain sebelum header
    } else {
        echo '<div style="color: red;">Error: ' . $conn->error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="regis.css">

</head>
<body>
    <h2>Registrasi</h2>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="namalengkap" required><br>
        <input type="text" name="alamat" placeholder="Alamat" required><br>
        <select name="level">
                <option value="Admin">Admin</option>
                <option value="Petugas">Petugas</option>
                <option value="Peminjam">Peminjam</option>
              </select><br>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
