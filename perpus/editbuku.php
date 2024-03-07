
<?php
// Sertakan file koneksi database
include('koneksi.php');

// Periksa apakah parameter id buku dikirimkan melalui URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil informasi buku berdasarkan BukuID
    $query = "SELECT * FROM buku WHERE bukuid = '$id'";
    $result = mysqli_query($conn, $query);

    // Periksa apakah ada hasil dari query
    if(mysqli_num_rows($result) == 1) {
        // Ambil data buku dari hasil query
        $row = mysqli_fetch_assoc($result);
        $judul = $row['judul'];
        $penulis = $row['penulis'];
        $penerbit = $row['penerbit'];
        $tahun_terbit = $row['tahunterbit'];
    } else {
        // Jika tidak ada hasil dari query, arahkan pengguna kembali ke halaman pendataan buku
        header("Location: buku.php");
        exit();
    }
} else {
    // Jika parameter id buku tidak dikirimkan melalui URL, arahkan pengguna kembali ke halaman pendataan buku
    header("Location: buku.php");
    exit();
}

// Aksi Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul_baru = $_POST['judul'];
    $penulis_baru = $_POST['penulis'];
    $penerbit_baru = $_POST['penerbit'];
    $tahun_terbit_baru = $_POST['tahunterbit'];

    // Query untuk memperbarui informasi buku
    $query_update = "UPDATE buku SET judul = '$judul_baru', penulis = '$penulis_baru', penerbit = '$penerbit_baru', tahunTerbit = '$tahun_terbit_baru' WHERE bukuid = '$id'";
    $result_update = mysqli_query($conn, $query_update);

    // Periksa apakah pembaruan berhasil
    if ($result_update) {
        echo '<script>alert("Informasi buku berhasil diperbarui."); window.location.href = "buku.php";</script>';
    } else {
        echo '<script>alert("Gagal memperbarui informasi buku. Silakan coba lagi.");</script>';
    }
}
?>
<?php include "header.php"; ?>
<section class="content">
    <div class="container">
        <table class="content-table">
            <?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

            <h1>Edit Buku</h1>
            <button onclick="location.href='buku.php';" style="margin-bottom: 20px;">Kembali</button>
            <form action="" method="post">
                <label for="judul">Judul:</label>
                <input type="text" name="judul" value="<?php echo $judul; ?>" required><br>

                <label for="penulis">Penulis:</label>
                <input type="text" name="penulis" value="<?php echo $penulis; ?>" required><br>

                <label for="penerbit">Penerbit:</label>
                <input type="text" name="penerbit" value="<?php echo $penerbit; ?>" required><br>

                <label for="tahunterbit">Tahun Terbit:</label>
                <input type="number" name="tahunterbit" value="<?php echo $tahunterbit; ?>" required><br>

                <input type="submit" value="Simpan Perubahan">
            </form>
        </div>
    </section>
</div>
</body>
</html>

