<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah login
if(!isset($_SESSION['username'])) {
    // Jika tidak, alihkan ke halaman login
    header("Location: login.php");
    exit(); // Penting untuk menghentikan eksekusi skrip setelah mengalihkan pengguna
}
// Sertakan file koneksi database
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

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil nilai bulan yang dipilih oleh pengguna, jika ada
$selectedMonth = isset($_GET['bulan']) ? $_GET['bulan'] : date('m'); // Ambil bulan saat ini jika tidak ada yang dipilih
$selectedYear = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y'); // Ambil tahun saat ini jika tidak ada yang dipilih

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* CSS untuk Tabel Riwayat Peminjaman */
.content {
    padding: 20px;
}

.content-table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}

.content-table thead th {
    background-color: #f2f2f2;
    font-weight: bold;
    text-align: left;
    padding: 10px;
}

.content-table tbody td {
    border-bottom: 1px solid #ddd;
    padding: 10px;
}

.content-table tbody tr:hover {
    background-color: #f5f5f5;
}

.content-table tbody td.aksi {
    text-align: center;
}

.content-table tbody td form {
    display: inline-block;
}

.content-table tbody td form button {
    padding: 5px 10px;
    margin: 0 5px;
    cursor: pointer;
}

.no-data {
    text-align: center;
    margin-top: 20px;
}

.btn-back {
    margin-top: 10px;
    display: block;
    margin: 0 auto;
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="tampil.css">
    <style>
                .no-data {
                    text-align: center;
                    margin-top: 20px;
                }
                .btn-back {
                    margin-top: 10px;
                    display: block;
                    margin: 0 auto;
                }
            </style>
             <style>
        /* CSS untuk desain username */
        .username {
            font-size: 18px; /* Ubah ukuran teks sesuai preferensi Anda */
            font-weight: bold; /* Membuat teks menjadi tebal */
            color: #333; /* Warna teks */
            text-align: center;
        }

        /* CSS untuk tata letak tombol navigasi */
        .nav-menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center; /* Pusatkan tombol navigasi */
        }

        .nav-item {
            display: inline-block;
            margin: 0 5px; /* Berikan jarak antara tombol navigasi */
        }

        .nav-item a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-item a:hover {
            background-color: #f0f0f0;
        }

        /* CSS untuk garis horizontal */
        .nav-menu hr {
            display: none; /* Sembunyikan garis */
        }

        /* CSS untuk garis horizontal pada setiap item kecuali yang terakhir */
        .nav-item:not(:last-child) {
            border-right: 1px solid #ccc; /* Berikan garis kanan pada setiap item kecuali yang terakhir */
        }
        .profile-img {
    width: 30px; /* Sesuaikan ukuran gambar profil */
    height: 30px; /* Sesuaikan ukuran gambar profil */
    border-radius: 50%; /* Agar gambar profil menjadi lingkaran */
}
.header {
            position: relative;
        }
        
        .profile {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        
        .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    max-width: 200px; /* Lebar maksimum dropdown */
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    right: 0; /* Mengatur agar dropdown muncul di sebelah kanan */
}

.nav-menu {
    position: relative; /* Mengatur posisi relatif untuk kontainer menu */
}

.nav-menu .nav-item {
    display: inline-block;
    margin-right: 20px; /* Mengatur jarak antar menu */
}

.nav-item .profile {
    position: absolute;
    top: 100%; /* Mengatur agar dropdown muncul di bawah profile */
    right: 0;
    background-color: #f9f9f9;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    z-index: 1;
    display: none;
}

.nav-item .profile a {
    display: block;
    padding: 5px 10px;
    color: #333;
    text-decoration: none;
}

.nav-item:hover .profile {
    display: block; /* Menampilkan dropdown saat profile dihover */
}

        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }


    </style>
</head>
<body>
<?php include "header.php"; ?>
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
                    <div id="table-container">
                        <table class="content-table">
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