<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'web_novel';
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil kategori dari database
$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
    .category-btn {
        margin: 5px;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 25px;
        border: 1px solid #fbbc05; /* Ubah border agar sesuai dengan warna tema */
        color: #fbbc05; /* Warna teks tombol */
        text-decoration: none; /* Menghilangkan underline pada link */
    }
    .category-btn:hover {
        background-color: #fbbc05; /* Warna background saat dihover */
        color: white; /* Warna teks saat dihover */
        text-decoration: none; /* Menghilangkan garis bawah saat hover */
        outline: none; /* Menghilangkan garis biru saat dihover */
    }
    .category-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: start;
        margin-top: 20px;
    }

    .container {
        margin-bottom: 300px;
        border: solid black;
        border-radius: 20px;
        padding: 40px;
    }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/Frame 65.svg" alt="Logo" width="40" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="novels.php">Novel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Tentang Kami</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Daftar Kategori</h1>

        <!-- Menampilkan kategori sebagai tombol -->
        <div class="category-container">
            <?php while ($row = $result_categories->fetch_assoc()): ?>
                <!-- Perhatikan bahwa kita menambahkan parameter `category` di URL -->
                <a href="category_novels.php?category=<?php echo $row['id']; ?>" class="btn btn-outline-primary category-btn">
                    <?php echo $row['name']; ?>
                </a>
            <?php endwhile; ?>
        </div>

    </div>

    <!-- Footer -->
<footer class="footer">
    <div class="footer-content">

        <div class="footer-left">
            <h5>BacaYuks</h5>
            <p>Tempat di mana setiap halaman <br>membawa kamu pada cerita yang baru,<br> penuh kejutan, dan penuh inspirasi.</p>
        </div>

        <!-- Navigation Links Section -->
        <div class="footer-center">
            <h5>Menu</h5>
            <ul class="footer-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Novel</a></li>
                <li><a href="#">Kategori</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </div>

        <!-- Social Media Links Section -->
        <div class="footer-right">
            <h5>Follow Us</h5>
            <ul class="social-media">
                <li><a href="#" class="social-icon"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                <li><a href="#" class="social-icon"><i class="fab fa-twitter"></i> Twitter</a></li>
                <li><a href="#" class="social-icon"><i class="fab fa-instagram"></i> Instagram</a></li>
            </ul>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <p>&copy; 2025 BacaYuks | All rights reserved</p>
    </div>
</footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php $conn->close(); ?>
