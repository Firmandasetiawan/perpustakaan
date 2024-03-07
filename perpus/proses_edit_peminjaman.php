<?php
// Sertakan file koneksi database
include('koneksi.php');

// Periksa apakah data yang dibutuhkan telah diterima melalui metode POST
if(isset($_POST['peminjamanid']) && isset($_POST['tanggalpeminjaman']) && isset($_POST['tanggalpengembalian'])) {
    // Tangkap data yang diterima
    $peminjamanid = $_POST['peminjamanid']; // Perbaiki penulisan variabel
    $tanggalpeminjaman = $_POST['tanggalpeminjaman'];
    $tanggalpengembalian = $_POST['tanggalpengembalian'];

    // Query untuk mengupdate data peminjaman berdasarkan ID
    $sql = "UPDATE peminjaman SET tanggalpeminjaman = '$tanggalpeminjaman', tanggalpengembalian = '$tanggalpengembalian' WHERE peminjamanid = '$peminjamanid'"; // Perbaiki penulisan variabel

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman riwayat peminjaman
        header("Location: tampil_pinjam.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi ke database
    $conn->close();
} else {
    // Jika data tidak lengkap, kembalikan pengguna ke halaman sebelumnya
    header("Location: edit_pinjam.php?id=" . $_POST['peminjamanid']);
    exit();
}
?>
