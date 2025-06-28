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

// Mengambil data akun berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Fungsi untuk mengupdate akun
if (isset($_POST['update_akun'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "UPDATE users SET username='$username', password='$password' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Akun berhasil diperbarui!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $conn->error . "</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <h2>Edit Akun</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="<?= $row['username'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" value="<?= $row['password'] ?>" required>
        </div>
        <button type="submit" name="update_akun" class="btn btn-primary">Update Akun</button>
    </form>

    <!-- Tombol Kembali -->
    <a href="admin_akun.php" class="btn btn-secondary mt-3">Kembali ke Daftar Akun</a>
</div>

<!-- Footer -->
<footer class="footer">

    <!-- Footer Bottom -->
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
