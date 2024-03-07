<?php include "header.php"; ?>
<section class="content">
    <div class="container">
        <table class="content-table">
            <?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* CSS untuk desain username */
        /* Kode CSS lainnya */
    </style>
</head>
<body>

    <section class="content">
        <div class="container">
            <h2>Edit Peminjaman</h2>
            <?php
// Sertakan file koneksi database
include('koneksi.php');

// Periksa apakah data peminjaman ID telah diterima
if(isset($_GET['id'])) {
    // Tangkap ID peminjaman dari parameter URL
    $peminjamanid = $_GET['id'];

    // Query untuk mengambil data peminjaman dari tabel peminjaman berdasarkan ID
    $sql = "SELECT * FROM peminjaman WHERE peminjamanid = '$peminjamanid'";
    
    // Jalankan query
    $result = $conn->query($sql);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Periksa apakah ada data yang ditemukan
        if ($result->num_rows > 0) {
            // Ambil data peminjaman dari hasil query
            $row = $result->fetch_assoc();
            // Tampilkan formulir untuk mengedit peminjaman
            echo "<form action='proses_edit_peminjaman.php' method='POST'>";
            echo "<input type='hidden' name='peminjamanid' value='" . $row['peminjamanid'] . "'>";
            echo "Tanggal Peminjaman: <input type='date' name='tanggalpeminjaman' value='" . $row['tanggalpeminjaman'] . "'><br>";
            echo "Tanggal Pengembalian: <input type='date' name='tanggalpengembalian' value='" . $row['tanggalpengembalian'] . "'><br>";
            echo "<input type='submit' value='Simpan'>";
            echo "</form>";
        } else {
            echo "Peminjaman tidak ditemukan.";
        }
    } else {
        // Tampilkan pesan kesalahan jika query tidak berhasil dieksekusi
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Tampilkan pesan jika ID peminjaman tidak diberikan
    echo "ID peminjaman tidak diberikan.";
}

// Tutup koneksi ke database
$conn->close();
?>


        </div>
    </section>
</body>
</html>
