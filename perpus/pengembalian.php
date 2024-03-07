<?php include "sidebar.php"; ?>
<div class="content">
    <div class="header">
        <section class="content">
            <?php include "koneksi.php"; ?>
            <!--Start Dashboard Content-->
            <div class="card-body">
                <div class="table-responsive">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div>
                                <h1>Pengembalian</h1>
                                <a href="peminjaman.php" class="btn btn-primary">
                                    <i class="fa fa-edit"></i> Tambah</a>
                                <link rel="stylesheet" href="tampil.css">
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
                                        <th>Aksi</th>
                                        <th>Verifikasi Kembali</th> <!-- Kolom tambahan -->
                                        
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
                                        echo "<td><a href='edit_pinjam.php?id=" . $row['bukuid'] . "'><button>Edit</button></a> |
                                            <a href='hapus_pinjam.php?id=" . $row['peminjamanid'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus peminjaman ini?\")'>
                                                <button>Hapus</button>
                                            </a>
                                            </td>";
                                        // Tambahkan tombol verifikasi kembali
                                        echo "<td><a href='verifikasi_kembali.php?id=" . $row['peminjamanid'] . "'><button>Verifikasi Kembali</button></a></td>";
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
