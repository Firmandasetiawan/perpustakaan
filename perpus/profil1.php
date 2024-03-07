<?php
// Sertakan file koneksi database
include('koneksi.php');

// Periksa apakah session telah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah pengguna telah masuk
if (!isset($_SESSION['userid'])) {
    // Redirect ke halaman login jika pengguna belum masuk
    header("Location: login.php");
    exit;
}

// Ambil ID pengguna dari sesi
$user_id = $_SESSION['userid'];

// Inisialisasi variabel
$username = $email = $namaLengkap = $alamat = '';
$error = '';
$success_message = '';

// Ambil data pengguna berdasarkan ID
$sql = "SELECT * FROM user WHERE userid = $user_id";
$result = $conn->query($sql);

if ($result) {
    // Jika query berhasil dijalankan
    if ($result->num_rows > 0) {
        // Jika data pengguna ditemukan, isi variabel dengan nilai yang ada
        $row = $result->fetch_assoc();
        $username = isset($row['username']) ? $row['username'] : '';
        $email = isset($row['email']) ? $row['email'] : '';
        $namaLengkap = isset($row['namalengkap']) ? $row['namalengkap'] : '';
        $alamat = isset($row['alamat']) ? $row['alamat'] : '';
    } else {
        // Jika tidak ada data pengguna yang sesuai dengan ID, tampilkan pesan error
        $error = 'Tidak ada data pengguna yang ditemukan.';
    }
} else {
    // Jika terjadi kesalahan saat menjalankan query, tangani error
    $error = "Error: " . $conn->error;
}

// Proses update profil jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $namaLengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];

    // Query untuk melakukan update data pengguna
    $sql_update = "UPDATE user SET username='$username', email='$email', namalengkap='$namaLengkap', alamat='$alamat' WHERE userid=$user_id";

    if ($conn->query($sql_update) === TRUE) {
        // Jika update berhasil, arahkan kembali ke halaman dashboard dengan notifikasi
        $_SESSION['success_message'] = "Profil berhasil diperbarui!";
        header("Location: petugas_dashboard.php");
        exit;
    } else {
        // Jika terjadi kesalahan saat update, tangani error
        $error = "Error: Gagal diubah!!!!" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section class="content">
        <div class="container">
            <?php if($error != ''): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if($success_message != ''): ?>
                <div class="success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>"><br><br>
                <label for="email">Email:</label><br>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br><br>
                <label for="nama_lengkap">Nama Lengkap:</label><br>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo $namaLengkap; ?>"><br><br>
                <label for="alamat">Alamat:</label><br>
                <textarea id="alamat" name="alamat"><?php echo $alamat; ?></textarea><br><br>
                <input type="submit" value="Update">
            </form>
            <form method="post" action="ubah_password.php">
                <button type="submit">Ubah Password</button>
            </form>
        </div>
    </section>
</body>
</html>
