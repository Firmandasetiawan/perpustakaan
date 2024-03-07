<?php include "header1.php"; ?>
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
                                <h1>Data Buku</h1>
                                <link rel="stylesheet" href="styles.css">
                                <a href="tambahbuku1.php" class="btn btn-primary">
                                    <i class="fa fa-edit"></i> Tambah</a>
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
                                        echo "<td><a href='editbuku1.php?id=" . $row['bukuid'] . "'><button class='edit-btn'>Edit</button></a> |
                                             <a href='hapus_buku1.php?id=" . $row['bukuid'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus buku ini?\")'>
                                                 <button class='delete-btn'>Hapus</button></a></td>";
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

<style>
/* Gaya untuk tabel */
.table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
}

.table th, .table td {
    padding: 8px;
    text-align: left;
}

.table th {
    background-color: #f2f2f2;
    color: #333;
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table tbody tr:hover {
    background-color: #ddd;
}

/* Gaya untuk tombol tambah */
.add-btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.add-btn:hover {
    background-color: #0056b3;
}

/* Gaya untuk tombol edit */
.edit-btn {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.edit-btn:hover {
    background-color: #218838;
}

/* Gaya untuk tombol hapus */
.delete-btn {
    background-color: #dc3545;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.delete-btn:hover {
    background-color: #c82333;
}
</style>
