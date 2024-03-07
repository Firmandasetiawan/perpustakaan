<?php
// Sertakan file koneksi database
include('koneksi.php');

// Periksa apakah parameter id telah diterima dari URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    // Sanitasi parameter id untuk mencegah SQL Injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Buat dan jalankan query untuk menghapus anggota berdasarkan id
    $sql = "DELETE FROM user WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Jika penghapusan berhasil, arahkan pengguna kembali ke halaman daftar anggota dengan pesan sukses
        header("Location:anggota.php?pesan=Anggota berhasil dihapus.");
        exit();
    } else {
        // Jika terjadi kesalahan, arahkan pengguna kembali ke halaman daftar anggota dengan pesan error
        header("Location:anggota.php?pesan=Gagal menghapus anggota: " . $conn->error);
        exit();
    }
} else {
    // Jika parameter id tidak diberikan, arahkan pengguna kembali ke halaman daftar anggota dengan pesan error
    header("Location:anggota.php?pesan=ID anggota tidak valid.");
    exit();
}

// Tutup koneksi ke database
$conn->close();
?>
