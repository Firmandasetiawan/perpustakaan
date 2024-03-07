<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <style>
        /* CSS untuk tombol navigasi */
        .sidebar {
            background-color: #333; /* Warna latar belakang sidebar */
            color: #fff; /* Warna teks */
            width: 250px; /* Lebar sidebar */
            height: 100%; /* Tinggi sidebar */
            position: fixed; /* Membuat sidebar tetap di posisi */
            top: 0; /* Memulai dari bagian atas */
            left: 0; /* Memulai dari sisi kiri */
            overflow-y: auto; /* Aktifkan scrolling jika konten lebih panjang dari tinggi sidebar */
        }

        .sidebar .header {
            padding: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li a {
            display: block;
            padding: 15px;
            color: #fff;
            text-decoration: none;
        }

        .sidebar ul li a:hover {
            background-color: #555; /* Warna latar belakang saat hover */
        }

        .content {
            margin-left: 250px; /* Sesuaikan dengan lebar sidebar */
            padding: 20px;
        }

        .navbar {
            background-color: #555; /* Warna latar belakang navbar */
            color: #fff; /* Warna teks navbar */
            padding: 10px;
            margin-bottom: 20px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 250px;
        }

        .navbar .profile-img {
            width: 30px; /* Sesuaikan ukuran gambar profil */
            height: 30px; /* Sesuaikan ukuran gambar profil */
            border-radius: 50%; /* Agar gambar profil menjadi lingkaran */
        }

        .navbar .profile {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 20px;
            cursor: pointer;
        }

        .navbar .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            max-width: 200px; /* Lebar maksimum dropdown */
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0; /* Mengatur agar dropdown muncul di sebelah kanan */
            top: calc(100% + 5px);
        }

        .navbar .profile:hover .dropdown-content {
            display: block; /* Menampilkan dropdown saat profile dihover */
        }

        .navbar .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .navbar .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="header">
            <h1>Perpustakaan</h1>
        </div>
        <ul>
            <li>
                <a href="admin_dashboard.php">
                    <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="buku.php">
                    <i class="zmdi zmdi-book-image"></i> <span>Data Buku</span>
                </a>
            </li>
            <li>
                <a href="tampil_pinjam.php">
                    <i class="zmdi zmdi-book"></i> <span>Peminjaman</span>
                </a>
            </li>
            <li>
                <a href="tampil_ulasan.php">
                    <i class="zmdi zmdi-grid"></i> <span>Ulasan</span>
                </a>
            </li>
            <li>
                <a href="anggota.php">
                    <i class="zmdi zmdi-grid"></i> <span>Daftar Anggota</span>
                </a>
            </li>
            <li>
                <a href="laporan.php">
                    <i class="zmdi zmdi-assignment-alert"></i> <span>Laporan</span>
                </a>
            </li>
            <li class="sidebar-header">________</li>
            <li>
                <a href="profil.php" target="_blank">
                    <i class="zmdi zmdi-lock"></i> <span>Profil</span>
                </a>
            </li>
            <li>
                <a href="login.php" target="_blank">
                    <i class="zmdi zmdi-lock"></i> <span>Login</span>
                </a>
            </li>
            <li>
                <a href="logout.php" target="_blank">
                    <i class="zmdi zmdi-lock"></i> <span>Logout</span>
                </a>
            </li>
            <li>
                <a href="registrasi.php" target="_blank">
                    <i class="zmdi zmdi-account-circle"></i> <span>Registrasi   </span>
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
        <div class="navbar">
            <div class="profil" onclick="toggleDropdown()">
                <img src="img/profile.JPEG" alt="Profil" class="profile-img">
                <div class="dropdown-content" id="dropdownContent">
                    <a href="profil.php">Profil</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
            <div class="header">
                <h1>Perpustakaan</h1>
            </div>
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
