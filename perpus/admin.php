<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* CSS untuk header */
        .header {
            background-color: #333; /* Warna latar belakang header */
            color: #fff; /* Warna teks */
            padding: 20px;
            position: fixed; /* Membuat header tetap di posisi */
            top: 0; /* Memulai dari bagian atas */
            left: 0; /* Memulai dari sisi kiri */
            width: 100%; /* Lebar header */
            z-index: 1000; /* Mengatur z-index agar header tampil di atas konten */
        }

        .header h1 {
            margin: 0;
        }

        .header .user-info {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #fff;
        }

        .header .user-info a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <div class="user-info">
            <span>Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin'; ?>!</span>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
