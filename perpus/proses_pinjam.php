
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <style>
        .container {
            text-align: center;
            margin-top: 100px;
        }
        .button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
<?php
include "koneksi.php";

// Inisialisasi variabel untuk menyimpan pesan kesalahan
$error = '';

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $userid = $_POST['userid'];
    $bukuid = $_POST['bukuid'];
    $tanggalpeminjaman = $_POST['tanggalpeminjaman'];
    $tanggalpengembalian = $_POST['tanggalpengembalian'];
    $statuspeminjaman = $_POST['statuspeminjaman'];
    $randomID = rand(100000, 999999);

    // Validasi input (contoh sederhana)
    if (empty($userid) || empty($bukuid) || empty($tanggalpeminjaman) || empty($tanggalpengembalian) || empty($statuspeminjaman)) {
        $error = "Semua field harus diisi";
    } else {
        // Lakukan proses tambah peminjaman ke database
        $query = "INSERT INTO peminjaman (userid, bukuid, tanggalpeminjaman, tanggalpengembalian, statuspeminjaman) 
                  VALUES ('$randomID', '$userid', '$bukuid', '$tanggalpeminjaman', '$tanggalpengembalian', '$statuspeminjaman')";
        if (mysqli_query($conn, $query)) {
            echo "Peminjaman berhasil ditambahkan";
        } else {
            $error = "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}
?>

</div>

</body>
</html>
