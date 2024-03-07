<?php
// Sertakan file koneksi database atau fungsi lain yang diperlukan
include('koneksi.php');

// Periksa apakah parameter id peminjaman telah diberikan melalui GET request
if(isset($_GET['id'])) {
    // Tangkap nilai id peminjaman dari parameter GET
    $peminjamanid = $_GET['id'];

    // Lakukan query untuk mendapatkan tanggal pengembalian dari database
    $query = "SELECT tanggalpengembalian FROM peminjaman WHERE peminjamanid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $peminjamanid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $tanggal_kembali = $row['tanggalpengembalian'];

    // Periksa apakah tanggal pengembalian telah lewat
    if (strtotime($tanggal_kembali) < strtotime(date('Y-m-d'))) {
        // Lakukan query untuk mengupdate status peminjaman menjadi 'Telat Dikembalikan'
        $query_update = "UPDATE peminjaman SET statuspeminjaman = 'Telat Dikembalikan' WHERE peminjamanid = ?";
        $stmt_update = $conn->prepare($query_update);
        $stmt_update->bind_param("i", $peminjamanid);
        $stmt_update->execute();
        $stmt_update->close();

        // Tampilkan pesan bahwa pengembalian telat
        echo "Pengembalian telat, status peminjaman telah diubah menjadi 'Telat Dikembalikan'.";
    } else {
        // Lakukan query untuk mengupdate status peminjaman menjadi 'Dikembalikan'
        $query_update = "UPDATE peminjaman SET statuspeminjaman = 'Dikembalikan' WHERE peminjamanid = ?";
        $stmt_update = $conn->prepare($query_update);
        $stmt_update->bind_param("i", $peminjamanid);
        $stmt_update->execute();
        $stmt_update->close();

        // Tampilkan pesan bahwa pengembalian berhasil
        echo "Pengembalian berhasil.";
    }

    // Redirect kembali ke halaman peminjaman.php setelah verifikasi kembali berhasil
    header("Location: tampil_pinjam.php");
    exit();
} else {
    // Jika parameter id tidak diberikan, redirect ke halaman peminjaman.php
    header("Location: tampil_pinjam.php");
    exit();
}
?>
