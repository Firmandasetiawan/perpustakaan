<?php
include "koneksi.php";

// Ambil ID buku dari URL
$buku_id = $_GET['id'];

// Query untuk menghapus buku dari database berdasarkan ID
$sql = "DELETE FROM buku WHERE bukuid = '$buku_id'";

if ($conn->query($sql) === TRUE) {
    // Redirect kembali ke halaman tampil_buku.php setelah menghapus buku
    header("Location: buku.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
