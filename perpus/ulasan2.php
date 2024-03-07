<?php include "header2.php"; ?>
<section class="content">
    <div class="container">
        <table class="content-table">
            <?php include "koneksi.php"; ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST["userid"];
    $bukuid = $_POST["bukuid"];
    $ulasan = $_POST["ulasan"];
    $rating = $_POST["rating"];
    $randomID = rand(100000, 999999);

    $sql = "INSERT INTO ulasanbuku (ulasanid, userid, bukuid, ulasan, rating) VALUES ('$randomID', '$userid', '$bukuid', '$ulasan', '$rating')";

    if ($conn->query($sql) === TRUE) {
        echo "Ulasan berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Ulasan Buku</title>
</head>
<body>
    <h1>Tambah Ulasan</h1>
    <form action="" method="post">
        <label class="col-sm-2 col-form-label" for="userid">Nama Siswa:</label>
<select name="userid" required>
<?php
    include "koneksi.php";

    // Periksa apakah pengguna sudah login dan nama pengguna tersimpan dalam sesi
    session_start();
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // Query untuk mendapatkan ID pengguna berdasarkan nama pengguna yang sedang login
        $queryUserID = "SELECT userid FROM user WHERE username = '$username'";
        $resultUserID = $conn->query($queryUserID);
        if($resultUserID->num_rows > 0) {
            $rowUserID = $resultUserID->fetch_assoc();
            $userID = $rowUserID['userid'];

            // Query untuk mendapatkan nama lengkap pengguna berdasarkan ID pengguna
            $queryNamaLengkap = "SELECT namalengkap FROM user WHERE userid = '$userID'";
            $resultNamaLengkap = $conn->query($queryNamaLengkap);
            if($resultNamaLengkap->num_rows > 0) {
                $rowNamaLengkap = $resultNamaLengkap->fetch_assoc();
                $namaLengkap = $rowNamaLengkap['namalengkap'];

                // Tampilkan nama lengkap pengguna sebagai opsi dalam dropdown
                echo "<option value='".$userID."'>".$namaLengkap."</option>";
            }
        }
    }

    // Tutup koneksi
    $conn->close();
?>
</select><br>

        </select><br>

        <label class="col-sm-2 col-form-label" for="bukuid">Buku:</label>
        <select name="bukuid" required>
        <?php
            include "koneksi.php";

            // Query untuk mendapatkan data BukuID dari tabel buku
            $query = "SELECT bukuid, judul FROM buku";
            $result = $conn->query($query);

            // Tampilkan pilihan dalam dropdown
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row['bukuid']."'>".$row['judul']."</option>";
            }

            // Tutup koneksi
            $conn->close();
        ?>
        </select><br>

        <label class="col-sm-2 col-form-label" for="ulasan">Ulasan:</label>
        <textarea name="ulasan" required></textarea><br>

        <label class="col-sm-2 col-form-label" for="rating">Rating:</label>
        <input type="number" name="rating" min="1" max="5" required><br>

        <input type="submit" value="Tambah Ulasan">
        <a href="tampil_ulasan2.php" class="btn btn-primary">
                                    <i class="fa fa-edit"></i> Kembali</a>

    </form>
</body>
</html>