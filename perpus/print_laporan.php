<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Buku</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Peminjaman Buku</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Sertakan file koneksi database
            include('koneksi.php');

            // Ambil data peminjaman dari database
            $query = "SELECT peminjaman.*, user.namalengkap, buku.judul 
                      FROM peminjaman 
                      INNER JOIN user ON peminjaman.userid = user.userid 
                      INNER JOIN buku ON peminjaman.bukuid = buku.bukuid";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("Query error: " . mysqli_error($conn));
            }

            // Tampilkan data peminjaman dalam tabel
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['namalengkap'] . "</td>";
                echo "<td>" . $row['judul'] . "</td>";
                echo "<td>" . $row['tanggalpeminjaman'] . "</td>";
                echo "<td>" . $row['tanggalpengembalian'] . "</td>";
                echo "<td>" . $row['statuspeminjaman'] . "</td>";
                echo "</tr>";
            }

            // Tutup koneksi ke database 
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
    <!-- Tombol untuk mencetak -->
    <button onclick="window.print();">Cetak Laporan</button>
</body>
</html>
