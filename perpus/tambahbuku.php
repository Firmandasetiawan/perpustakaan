<?php include "header.php"; ?>
<section class="content">
    <div class="container">
        <table class="content-table">
            <?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Buku</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    include('koneksi.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tahunterbit = $_POST['tahunterbit'];
        $randomID = rand(100000000, 999999999);

        $query = "INSERT INTO buku (bukuid, judul, penulis, penerbit, tahunterbit) 
                  VALUES ('$randomID','$judul', '$penulis', '$penerbit', $tahunterbit)";

        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<script>alert("Buku berhasil ditambahkan."); window.location.href = "buku.php";</script>';
        } else {
            echo '<script>alert("Gagal menambahkan buku. Silakan coba lagi.");</script>';
        }
    }

    mysqli_close($conn);
    ?>
 
                <h2>Form Tambah Buku</h2>
                <form action="" method="post">
                    <label for="judul">Judul:</label>
                    <input type="text" name="judul" required><br>

                    <label for="penulis">Penulis:</label>
                    <input type="text" name="penulis" required><br>

                    <label for="penerbit">Penerbit:</label>
                    <input type="text" name="penerbit" required><br>

                    <label for="tahunterbit">Tahun Terbit:</label>
                    <input type="number" name="tahunterbit" required><br>

                    <input type="submit" value="Tambah Buku">
                    <button onclick="location.href='buku.php';" style="margin-bottom: 20px;" >kembali</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
