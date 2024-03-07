<?php include "header.php"; ?>

<section class="content">
    <div class="container">
        <?php include "koneksi.php"; ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Registrasi</title>
            <link rel="stylesheet" href="styles.css">
            <style>
            </style>
        </head>
        <body>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "perpus";

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Fungsi untuk melakukan registrasi
        function register($conn) {
            echo "<h2>Registrasi</h2>";

            // Tampilkan pesan sukses jika ada
            if (isset($_SESSION['success_message'])) {
                echo '<div style="color: green;">' . $_SESSION['success_message'] . '</div>';
                unset($_SESSION['success_message']); // Hapus pesan sukses setelah ditampilkan
            }

            echo '<form method="post" action="">';
            echo 'Username: <input type="text" name="username" required><br>';
            echo 'Password: <input type="text" name="password" required><br>';
            echo 'Email: <input type="text" name="email" required><br>';
            echo 'Nama Lengkap: <input type="text" name="namalengkap" required><br>';
            echo 'Alamat:<input type="text" name="alamat" required><br>';
            echo 'Level: <select name="level">
                        <option value="Admin">Admin</option>
                        <option value="Petugas">Petugas</option>
                        <option value="Peminjam">Peminjam</option>
                      </select><br>';
            echo '<input type="submit" value="Register">';
            echo '</form>';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];
                $nama_lengkap = $_POST['namalengkap'];
                $alamat = $_POST['alamat'];
                $level = $_POST['level'];
                $randomID = rand(100000000, 999999999);

                $sql = "INSERT INTO user (userid, username, password, email, namalengkap, alamat, level)
                        VALUES ('$randomID', '$username', '$password', '$email', '$nama_lengkap', '$alamat', '$level')";

                if ($conn->query($sql) === TRUE) {
                    // Set pesan sukses dan arahkan pengguna ke halaman login setelah registrasi berhasil
                    $_SESSION['success_message'] = "Registrasi berhasil untuk pengguna: $username";
                    header("Location: login.php");
                    exit(); // Pastikan tidak ada output lain sebelum header
                } else {
                    echo '<div style="color: red;">Error: ' . $conn->error . '</div>';
                }
            }
        }

        // Panggil fungsi registrasi
        register($conn);
        $conn->close();
        ?>

        </body>
        </html>
    </div>
</section>
