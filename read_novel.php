<?php
// Koneksi ke database
$host = 'db.be-mons1.bengt.wasmernet.com';
$username = '0d5c216a70dd8000b60a44c86b34';
$password = '06860d5c-216a-7205-8000-2abbc29cfc7b';
$database = 'web_novel';
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $novel_id = $_GET['id'];
    $sql = "SELECT * FROM novels WHERE id = $novel_id";
    $result = $conn->query($sql);
    $novel = $result->fetch_assoc();

    // Ambil nama kategori berdasarkan category_id dari tabel novels
    $category_id = $novel['category_id'];
    $sql_category = "SELECT name FROM categories WHERE id = $category_id";
    $result_category = $conn->query($sql_category);
    $category = $result_category->fetch_assoc();

    // Mendapatkan chapter untuk novel ini
    $sql_chapters = "SELECT * FROM chapters WHERE novel_id = $novel_id ORDER BY created_at";
    $chapters = $conn->query($sql_chapters);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $novel['title']; ?></title>
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
        /* Layout Gambar dan Sinopsis */
        .novel-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 40px;
            border: 5px solid #fbbc05;
            border-radius: 15px;
            padding: 20px;
        }
        .novel-img {
            flex: 0 0 40%;
            max-width: 100%;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .novel-synopsis {
            flex: 1;
            font-size: 1rem;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .novel-synopsis h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .novel-synopsis p {
            color: #555;
            line-height: 1.6;
            text-align: justify;
        }

        /* Styling untuk chapter card */
        .chapter-card {
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .chapter-card .list-group-item {
            cursor: pointer;
            color: #fbbc05; /* Warna kuning untuk teks */
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .chapter-card .list-group-item:hover {
            background-color: black;
            color: white;
            transform: translateY(-5px);
        }
        .chapter-card .list-group-item a {
        color: #fbbc05; /* Warna kuning untuk teks */
        text-decoration: none; /* Menghapus garis bawah pada tautan */
        font-weight: bold; /* Membuat teks lebih tebal */
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .novel-container {
                flex-direction: column;
                align-items: center;
            }
            .novel-img {
                width: 80%;
                margin-bottom: 20px;
            }
            .novel-synopsis {
                width: 80%;
            }
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
        <h1><?php echo $novel['title']; ?> / <span class="badge bg-warning"><?php echo $category['name']; ?></span></h1>

        <!-- Layout Gambar dan Sinopsis -->
        <div class="novel-container">
            <div class="novel-img">
                <img src="<?php echo $novel['cover_image']; ?>" class="img-fluid" alt="Cover Novel">
            </div>
            <div class="novel-synopsis">
                <h3>Sinopsis</h3>
                <p><?php echo nl2br($novel['content']); ?></p>
            </div>
        </div>

        <!-- Daftar Chapter -->
        <div class="chapter-card">
            <h3>Daftar Chapter</h3>
            <ul class="list-group">
                <?php while ($chapter = $chapters->fetch_assoc()): ?>
                    <li class="list-group-item">
                        <a href="read_chapter.php?chapter_id=<?php echo $chapter['id']; ?>">
                            <?php echo $chapter['title']; ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
