<?php include "header.php"; ?>
<section class="content">
    <div class="container">
        <table class="content-table">
            <?php include "koneksi.php"; ?>
            <!--Start Dashboard Content-->

                                <h1>Data Buku</h1>
                                <a href="tambahbuku.php" class="btn btn-primary">
                                    <i class="fa fa-edit"></i> Tambah</a>
                                <link rel="stylesheet" href="styles.css">
                                <style>
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
        /* CSS untuk Tabel Data Buku */
.content {
    padding: 20px;
}

.table-responsive {
    overflow-x: auto;
}

.card-body {
    padding: 20px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th,
.table td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

.table th {
    background-color: #f2f2f2;
}

.table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table tr:hover {
    background-color: #dddddd;
}

.btn {
    display: inline-block;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-danger {
    background-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-secondary {
    background-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

        </style>
                            </div>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <title>Data Buku</title>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Penerbit</th>
                                        <th>Tahun terbit</th>
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
                                    $query = "SELECT * FROM buku";
                                    $result = mysqli_query($conn, $query);
                                    // Tampilkan data buku dalam tabel
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row['bukuid'] . "</td>";
                                        echo "<td>" . $row['judul'] . "</td>";
                                        echo "<td>" . $row['penulis'] . "</td>";
                                        echo "<td>" . $row['penerbit'] . "</td>";
                                        echo "<td>" . $row['tahunterbit'] . "</td>";
                                        echo "<td><a href='editbuku.php?id=" . $row['bukuid'] . "'><button>Edit</button></a> |
                                             <a href='hapus_buku.php?id=" . $row['bukuid'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus buku ini?\")'>
                                                 <button>Hapus</button></a></td>";
                                        echo "</tr>";
                                    }

                                    // Tutup koneksi ke database 
                                    mysqli_close($conn);
                                    ?>
                                </tbody>
                            </table>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
