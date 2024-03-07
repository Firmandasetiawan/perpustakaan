<?php 
include('koneksi.php');

// Start the session
session_start();

// Retrieve data from query parameters
$selectedMonth = $_GET['bulan'];
$selectedYear = $_GET['tahun'];

// Query to fetch data based on selected month and year
$sql = "SELECT peminjamanid, user.username, buku.judul, peminjaman.tanggalpeminjaman, peminjaman.tanggalpengembalian, peminjaman.statuspeminjaman 
        FROM peminjaman 
        JOIN buku ON peminjaman.Bukuid = buku.bukuid
        JOIN user ON peminjaman.Userid = user.userid
        WHERE MONTH(peminjaman.tanggalpeminjaman) = '$selectedMonth'
        AND YEAR(peminjaman.tanggalpeminjaman) = '$selectedYear'";
$result = $conn->query($sql);

// Check if the query executed successfully
if ($result) {
    // Start HTML document
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>...............</title>
    </head>
    <body>
        <div style="text-align: center;">
            <h1>Laporan Peminjaman Buku</h1>
        </div>
        <!-- Table to display fetched data -->
        <table border="1">
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
                // Counter for numbering rows
                $no = 1;
                // Loop through each row of fetched data
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
                    $no++; // Increment row counter
                }
                ?>
            </tbody>
        </table>
        <!-- Include signature and name of the librarian -->
        <div style="text-align: right;">
            <p>data peminjaman pada tanggal ... / <?= $selectedMonth ?> / <?= $selectedYear ?></p>
            <p> ________</p>
            <?php 
                // Check if the session variable is set before displaying it
                if(isset($_SESSION['username'])) {
                    echo "<p>" . $_SESSION['username'] . "</p>";
                } else {
                    echo "<p>Session username not set.</p>";
                }
            ?>
        </div>
        <!-- Include JavaScript for printing -->
        <script>
            // Use window.print() to trigger printing when the page loads
            window.onload = function() {
                window.print();
            };
        </script>
    </body>
    </html>
    <?php
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>