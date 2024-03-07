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
                <link rel="stylesheet" href="styles.css">

                <title>Tampil Ulasan Buku</title>
                <style> .profile-img {
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
        </style>
            </head>
            <body>
                <h1>Ulasan Buku</h1>
                <a href="ulasan.php" class="btn btn-primary">
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

                    $query = "SELECT ulasanbuku.*, user.namalengkap, buku.judul 
                              FROM ulasanbuku 
                              INNER JOIN user ON ulasanbuku.userid = user.userid 
                              INNER JOIN buku ON ulasanbuku.bukuid = buku.bukuid";
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
            </body>
            </html>
        </section>
    </div>
</div>
