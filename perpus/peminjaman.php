
<?php
// Mulai sesi
session_start();

include "koneksi.php";

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Inisialisasi variabel untuk menyimpan pesan kesalahan
$error = '';

// Inisialisasi variabel untuk menyimpan nama siswa
$nama_siswa = '';

// Cek apakah sesi username telah diset
if(isset($_SESSION['username'])) {
    // Ambil username dari sesi
    $username = $_SESSION['username'];
    
    // Query untuk mendapatkan nama lengkap siswa berdasarkan username
    $query = "SELECT namalengkap FROM user WHERE username = '$username'";
    $result = $conn->query($query);
    
    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_siswa = $row['namalengkap'];
    } else {
        // Jika data tidak ditemukan, berikan pesan kesalahan
        $error = "Nama siswa tidak ditemukan.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $userid = $_SESSION['userid']; // Menggunakan UserID dari sesi yang sedang aktif
    $bukuid = $_POST['bukuid'];
    $tanggalpeminjaman = $_POST['tanggalpeminjaman'];
    $tanggalpengembalian = $_POST['tanggalpengembalian'];
    $statuspeminjaman = $_POST['statuspeminjaman'];
    $randomID = rand(100000000, 999999999);

    // Validasi input
    if (empty($bukuid) || empty($tanggalpeminjaman) || empty($tanggalpengembalian) || empty($statuspeminjaman)) {
        $error = "Semua field harus diisi.";
    } else {
        // Query untuk menyimpan data peminjaman ke dalam tabel peminjaman
        $sql = "INSERT INTO peminjaman (peminjamanid, userid, bukuid, tanggalpeminjaman, tanggalpengembalian, statuspeminjaman)
                VALUES ('$randomID', '$userid', '$bukuid', '$tanggalpeminjaman', '$tanggalpengembalian', '$statuspeminjaman')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Data peminjaman berhasil ditambahkan!"); window.location.href = "tampil_pinjam.php";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>
<?php include "header.php"; ?>
<section class="content">
    <div class="container">
        <table class="content-table">
            <?php include "koneksi.php"; ?>


            <h2>Form Tambah Peminjaman</h2>
            <link rel="stylesheet" href="styles.css">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="userid">Nama Siswa:</label><br>
                <input type="text" value="<?php echo $nama_siswa; ?>" readonly><br>

                <label for="bukuid">Nama Buku:</label><br>
                <select name="bukuid" required>
                    <?php
                    // Query untuk mendapatkan data BukuID dan judul buku dari tabel buku
                    $query = "SELECT bukuid, judul FROM buku";
                    $result = $conn->query($query);

                    // Tampilkan pilihan dalam dropdown
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['bukuid']."'>".$row['judul']."</option>";
                    }
                    ?>
                </select><br>

                <label class="col-sm-2 col-form-label" for="tanggalpeminjaman">Tanggal Peminjaman:</label><br>
                <input  type="date" name="tanggalpeminjaman" required><br>

                <label class="col-sm-2 col-form-label" for="tanggalpengembalian">Tanggal Pengembalian:</label><br>
                <input type="date" name="tanggalpengembalian" required><br>

                <label class="col-sm-2 col-form-label" for="statuspeminjaman">Status Peminjaman:</label><br>
                <input type="text" name="statuspeminjaman" required><br>

                <input type="submit" value="Tambah Peminjaman">
            </form>
            
            <!-- Tampilkan pesan kesalahan jika ada -->
            <span style="color: red;"><?php echo $error; ?></span>
        </section>
    </div>
</div>
