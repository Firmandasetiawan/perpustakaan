<?php
include "koneksi.php";

// Ambil ID peminjaman dari URL
$peminjaman_id = $_GET['id'];

// Query untuk menghapus peminjaman dari database berdasarkan ID
$sql = "DELETE FROM peminjaman WHERE peminjamanid = '$peminjaman_id'";

if ($conn->query($sql) === TRUE) {
    // Redirect kembali ke halaman tampil_pinjam.php setelah menghapus peminjaman
    header("Location: tampil_pinjam1.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
