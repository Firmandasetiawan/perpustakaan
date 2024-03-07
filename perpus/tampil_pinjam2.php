<?php
session_start(); // Mulai sesi jika belum dimulai
include('koneksi.php');

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['userid'])) {
    // Redirect ke halaman login jika pengguna belum login
    header("Location: login.php");
    exit;
}

// Dapatkan ID pengguna yang sedang login dari sesi
$userid = $_SESSION['userid'];

// Inisialisasi nomor urut
$no = 1;

// Kueri SQL untuk mendapatkan data peminjaman yang terkait dengan pengguna yang sedang login
$query = "SELECT peminjaman.*, user.namalengkap, buku.judul 
          FROM peminjaman 
          INNER JOIN user ON peminjaman.userid = user.userid 
          INNER JOIN buku ON peminjaman.bukuid = buku.bukuid
          WHERE peminjaman.userid = '$userid'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <!-- Masukkan file CSS Anda di sini -->
</head>
<body>

<?php include "header2.php"; ?>

<section class="content">
    <div class="container">
        <table class="content-table">
            <!--Start Dashboard Content-->
            <div class="card-body">
                <div class="table-responsive">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div>
                                <h1>Peminjaman</h1>
                                <a href="peminjaman2.php" class="btn btn-primary">
                                    <i class="fa fa-edit"></i> Tambah</a>
                                <!-- Link ke file CSS harus ditempatkan di dalam tag head -->
                                <link rel="stylesheet" href="styles.css">
                            </div>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Status Peminjaman</th>
                                        <th></th> <!-- Kolom tambahan -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    // Tampilkan data peminjaman yang terkait dengan pengguna yang sedang login
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row['namalengkap'] . "</td>";
                                        echo "<td>" . $row['judul'] . "</td>";
                                        echo "<td>" . $row['tanggalpeminjaman'] . "</td>";
                                        echo "<td>" . $row['tanggalpengembalian'] . "</td>";
                                        echo "<td>" . $row['statuspeminjaman'] . "</td>";
                                        echo "<td><a href='verifikasi_kembali2.php?id=" . $row['peminjamanid'] . "'><button>Kembalikan</button></a></td>";
                                        echo "</tr>";
                                    }
                                    // Tutup koneksi ke database 
                                    mysqli_close($conn);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</body>
</html>
