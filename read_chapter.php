<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'web_novel';
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['chapter_id'])) {
    $chapter_id = $_GET['chapter_id'];
    $sql = "SELECT * FROM chapters WHERE id = $chapter_id";
    $result = $conn->query($sql);
    $chapter = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $chapter['title']; ?></title>
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

        .chapter-content {
            background-color: #f1f1f1; /* Grey background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
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
                        <a class="nav-link" href="list_categories.php">Genre</a>
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
        <h1><?php echo $chapter['title']; ?></h1>
        <div class="chapter-content">
            <p><?php echo nl2br($chapter['content']); ?></p>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <h5>BacaYuks</h5>
                <p>Tempat di mana setiap halaman <br>membawa kamu pada cerita yang baru,<br> penuh kejutan, dan penuh inspirasi.</p>
            </div>
            <div class="footer-center">
                <h5>Menu</h5>
                <ul class="footer-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Novel</a></li>
                    <li><a href="#">Kategori</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-right">
                <h5>Follow Us</h5>
                <ul class="social-media">
                    <li><a href="#" class="social-icon"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                    <li><a href="#" class="social-icon"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li><a href="#" class="social-icon"><i class="fab fa-instagram"></i> Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 BacaYuks | All rights reserved</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
