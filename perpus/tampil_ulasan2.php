<?php 
session_start();

?>
<?php include "header2.php"; ?>
<section class="content">
    <div class="container">
        <table class="content-table">
            <?php include "koneksi.php"; ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="styles.css">

                <title>Tampil Ulasan Buku</title>
            </head>
            <body>
                <h1>Ulasan Buku</h1>
                <a href="ulasan2.php" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah</a>
                <table border="1">
                    <tr>
                        <th>No</th>
                        <th>Ulasan ID</th>
                        <th>User ID</th>
                        <th>Buku ID</th>
                        <th>Ulasan</th>
                        <th>Rating</th>
                    </tr>
                    <?php
                    include 'koneksi.php';

                    $userid = $_SESSION['userid']; // Mendapatkan ID pengguna yang sedang login

                    $query = "SELECT ulasanbuku.*, user.namalengkap, buku.judul 
                              FROM ulasanbuku 
                              INNER JOIN user ON ulasanbuku.userid = user.userid 
                              INNER JOIN buku ON ulasanbuku.bukuid = buku.bukuid
                              WHERE ulasanbuku.userid = $userid"; // Memuat hanya ulasan yang terkait dengan pengguna yang sedang login
                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        die("Query error: " . mysqli_error($conn));
                    }

                    $no = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row["ulasanid"] . "</td>";
                            echo "<td>" . $row["namalengkap"] . "</td>";
                            echo "<td>" . $row["judul"] . "</td>";
                            echo "<td>" . $row["ulasan"] . "</td>";
                            echo "<td>" . $row["rating"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada ulasan.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </table>
            </body>
            </html>
        </section>
    </div>
</div>
