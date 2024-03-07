<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah login
if(!isset($_SESSION['username'])) {
    // Jika tidak, alihkan ke halaman login
    header("Location: login.php");
    exit(); // Penting untuk menghentikan eksekusi skrip setelah mengalihkan pengguna
}

// Sisipkan file koneksi database
include('koneksi.php');

// Fungsi untuk mengedit peminjaman
function editPeminjaman($conn, $peminjamanID) {
    // Implementasikan logika untuk mengedit peminjaman di sini
    // Misalnya, Anda bisa mengarahkan pengguna ke halaman edit peminjaman dengan membawa ID peminjaman
    header("Location: editpeminjaman.php?id=" . $peminjamanID);
    exit();
}

// Fungsi untuk menghapus peminjaman
function hapusPeminjaman($conn, $peminjamanID) {
    // Lakukan penghapusan data peminjaman dari database
    $sql = "DELETE FROM peminjaman WHERE PeminjamanID = '$peminjamanID'";
    if ($conn->query($sql) === TRUE) {
        echo "Peminjaman berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Periksa apakah ada permintaan POST untuk menghapus peminjaman
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_peminjaman'])) {
    $peminjamanID = $_POST['peminjaman_id'];
    hapusPeminjaman($conn, $peminjamanID);
}

// Periksa apakah ada permintaan POST untuk mengedit peminjaman
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_peminjaman'])) {
    $peminjamanID = $_POST['peminjaman_id'];
    editPeminjaman($conn, $peminjamanID);
}

$selectedMonth = isset($_GET['bulan']) ? $_GET['bulan'] : date('m'); // Ambil bulan saat ini jika tidak ada yang dipilih
$selectedYear = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y'); // Ambil tahun saat ini jika tidak ada yang dipilih
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
<?php include "header1.php"; ?>
<section class="content">
    <div class="container">
        <table class="content-table">
            <?php include "koneksi.php"; ?>
    
                </div>
            </nav>
        </div>
        <style>
            /* Gaya untuk mencetak hanya tabel */
            @media print {
                body * {
                    visibility: hidden;
                }
                #table-container, #table-container * {
                    visibility: visible;
                }
                #table-container {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
            }
        </style>

    </header>
    <link rel="stylesheet" href="styles.css">
    <section class="content">
        <div class="container">
            <h2>Laporan Peminjaman</h2>
            <form action="" method="get">
                <label for="bulan">Pilih Bulan:</label>
                <select name="bulan" id="bulan">
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        $monthName = date('F', mktime(0, 0, 0, $i, 1));
                        $selected = ($i == $selectedMonth) ? 'selected' : ''; // Tambahkan ini untuk menentukan opsi yang dipilih
                        echo "<option value='$i' $selected>$monthName</option>";
                    }
                    ?>
                </select>
                <label for="tahun">Pilih Tahun:</label>
                <select name="tahun" id="tahun">
                    <?php
                    $currentYear = date('Y');
                    for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                        $selected = ($i == $selectedYear) ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
                <button type="submit">Tampilkan</button>
                <button type="button" onclick="cetakData()">Cetak</button>
            </form>

            <?php
            // Query untuk mengambil data peminjaman dari semua peminjam berdasarkan bulan dan tahun yang dipilih
            $sql = "SELECT peminjamanid, user.username, buku.judul, peminjaman.tanggalpeminjaman, peminjaman.tanggalpengembalian, peminjaman.statuspeminjaman 
                    FROM peminjaman 
                    JOIN buku ON peminjaman.bukuid = buku.bukuid
                    JOIN user ON peminjaman.userid = user.userid
                    WHERE MONTH(peminjaman.tanggalpeminjaman) = '$selectedMonth'
                    AND YEAR(peminjaman.tanggalpeminjaman) = '$selectedYear'";
            $result = $conn->query($sql);

            // Periksa apakah query berhasil dieksekusi
            if ($result) {
                if ($result->num_rows > 0) {
                    ?>

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pengguna</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Status Peminjaman</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td><?= $row['judul'] ?></td>
                                        <td><?= $row['tanggalpeminjaman'] ?></td>
                                        <td><?= $row['tanggalpengembalian'] ?></td>
                                        <td><?= $row['statuspeminjaman'] ?></td>
                                    </tr>
                                    <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="no-data">
                        <p>Tidak ada riwayat peminjaman.</p>
                        <!-- Tambahkan link atau tombol untuk kembali ke halaman sebelumnya -->
                    </div>
                    <?php
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            ?>
        </div>
    </section>

<script>
    function cetakData() { var bulan = document.getElementById("bulan").value; var tahun = document.getElementById("tahun").value; window.location.href = "print.php?bulan=" + bulan + "&tahun=" + tahun; }
</script>
</body>
</html>

<?php
// Tutup koneksi ke database
$conn->close();
?>
