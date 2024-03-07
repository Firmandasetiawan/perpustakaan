<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>
    <style>
        /* CSS untuk Tabel Peminjaman */
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table thead th {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .table .action-buttons button {
            margin-right: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .table .action-buttons button:hover {
            background-color: #ddd;
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
                <!--Start Dashboard Content-->
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div>
                                    <h1>Peminjaman</h1>
                                    <a href="peminjaman.php" class="btn btn-primary">
                                        <i class="fa fa-edit"></i> Tambah</a>
                                    <link rel="stylesheet" href="styles.css">
                                </div>
                                <br>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Judul Buku</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status Peminjaman</th>
                                            <th></th> <!-- Kolom tambahan -->
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // Sertakan file koneksi database atau fungsi lain yang diperlukan
                                        include('koneksi.php');
                                        // Inisialisasi nomor urut
                                        $no = 1;
                                        // Ambil data buku dari database
                                        $query = "SELECT peminjaman.*, user.namalengkap, buku.judul 
                                                  FROM peminjaman 
                                                  INNER JOIN user ON peminjaman.userid = user.userid 
                                                  INNER JOIN buku ON peminjaman.bukuid = buku.bukuid";
                                        $result = mysqli_query($conn, $query);
                                        if (!$result) {
                                            die("Query error: " . mysqli_error($conn));
                                        }
                                        // Tampilkan data buku dalam tabel
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $no++ . "</td>";
                                            echo "<td>" . $row['namalengkap'] . "</td>";
                                            echo "<td>" . $row['judul'] . "</td>";
                                            echo "<td>" . $row['tanggalpeminjaman'] . "</td>";
                                            echo "<td>" . $row['tanggalpengembalian'] . "</td>";
                                            echo "<td>" . $row['statuspeminjaman'] . "</td>";
                                            echo "<td><a href='verifikasi_kembali.php?id=" . $row['peminjamanid'] . "'><button>Kembalikan</button></a></td>";
                                            echo "<td><a href='edit_pinjam.php?id=" . $row['peminjamanid'] . "'><button>Edit</button></a> |
                                                <a href='hapus_pinjam.php?id=" . $row['peminjamanid'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus peminjaman ini?\")'>
                                                    <button>Hapus</button>
                                                </a>
                                                </td>";
                                            // Tambahkan tombol verifikasi kembali
                                            echo "</tr>";
                                        }
                                        // Tutup koneksi ke database 
                                        mysqli_close($conn);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
<script>
        function toggleDropdown() {
            var dropdown = document.getElementById("dropdownContent");
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        }
    </script>
