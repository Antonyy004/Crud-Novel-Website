<?php
session_start(); // Memulai sesi

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'web_novel';
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Logout jika tombol logout ditekan
if (isset($_POST['logout'])) {
    session_unset(); // Menghapus semua data sesi
    session_destroy(); // Menghancurkan sesi
    header("Location: login.php"); // Arahkan ke halaman login
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
    <style>
        body {
  font-family: "Montserrat", sans-serif;
  background-color: #fff;
  overflow: auto;
  scrollbar-width: none;
  -ms-overflow-style: none;
  min-height: 100vh;
  display: flex; 
  flex-direction: column;
  justify-content: space-between; 
}

.footer {
  background-color: #fbbc05;
  color: black;
  padding: 40px 20px;
  font-family: "Montserrat", sans-serif;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: auto; 
}

.container {
  margin-bottom: 50px;
}

.card-deck {
  display: flex;
  flex-wrap: wrap; /* Membuat card responsif jika layar kecil */
  justify-content: space-between; /* Memberikan jarak antar card */
}

.card {
  max-width: 30%; /* Membuat card lebih kecil */
  margin-bottom: 15px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.card-body {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.container {
  margin-bottom: 20px;
}

.card-deck {
  display: flex;
  flex-wrap: wrap; /* Membuat card responsif jika layar kecil */
  justify-content: space-between; /* Memberikan jarak antar card */
}

.card {
  max-width: 30%; /* Membuat card lebih kecil */
  margin-bottom: 15px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  height: 250px; /* Membuat tinggi card lebih pendek */
}

.card-body {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%; /* Pastikan card body mengisi seluruh tinggi card */
}

.card-title {
  font-size: 1.25rem;
}

.card-text {
  font-size: 1rem;
  flex-grow: 1; /* Membuat teks berkembang agar mengisi ruang yang ada */
  margin-bottom: 15px;
}

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="indexadmin.php">
            <img src="images/Frame 65.svg" alt="Logo" width="40" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="indexadmin.php">Dashboard</a>
                </li>
            </ul>
            <form class="d-flex" role="search" method="POST">
                <button class="btn btn-outline-danger" type="submit" name="logout">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1>Dashboard Admin</h1>
    <div class="card-deck">
        <div class="card">
            <div class="card-header">
                Manage Novel
            </div>
            <div class="card-body">
                <h5 class="card-title">Manage Your Novels</h5>
                <p class="card-text">Manage all your novel entries here. You can add, edit or delete novels.</p>
                <a href="admin_novels.php" class="btn btn-primary">Go to Manage Novels</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Manage Categories
            </div>
            <div class="card-body">
                <h5 class="card-title">Manage Novel Categories</h5>
                <p class="card-text">Manage categories for your novels here. You can add, edit or delete categories.</p>
                <a href="admin_categories.php" class="btn btn-primary">Go to Manage Categories</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Manage Account
            </div>
            <div class="card-body">
                <h5 class="card-title">Manage Account</h5>
                <p class="card-text">You can manage your account settings here.</p>
                <a href="admin_akun.php" class="btn btn-primary">Go to Manage Account</a>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="footer-bottom">
        <p>&copy; 2025 BacaYuks | All rights reserved</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
