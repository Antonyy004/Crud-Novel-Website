<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'web_novel';
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tambah novel
if (isset($_POST['add_novel'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];

    // Menangani gambar cover novel
    $cover_image = "";
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["cover_image"]["name"]);
        move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file);
        $cover_image = $target_file;
    }

    $sql = "INSERT INTO novels (title, content, category_id, cover_image) VALUES ('$title', '$content', '$category_id', '$cover_image')";
    if ($conn->query($sql) === TRUE) {
        echo "Novel berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tampilkan semua novel
$sql = "SELECT * FROM novels";
$novels = $conn->query($sql);

// Ambil kategori untuk dropdown
$sql_categories = "SELECT * FROM categories";
$categories = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Novel dan Chapter</title>
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

.card {
  border: none;
  border-radius: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease-in-out;
  overflow: hidden;
  background-color: #fff;
  min-height: 400px; /* Set minimum height for the card */
  display: flex;
  flex-direction: column; /* Make the card elements align vertically */
}

.card-body {
  padding: 15px;
  display: flex;
  flex-direction: column;
  justify-content: space-between; /* Ensure the button stays at the bottom */
  flex-grow: 1;
  overflow: hidden; /* Prevent content overflow */
}

.card-text {
  flex-grow: 1;
  overflow: auto; /* Ensure long content is scrollable */
}

.card-title {
  font-size: 1.25rem;
  font-weight: bold;
  margin-bottom: 10px;
  color: #333;
}

.card-text {
  font-size: 1rem;
  color: #666;
  margin-bottom: 15px;
  flex-grow: 1;
}

.btn-sm {
  margin-top: 10px; /* Ensure buttons are spaced out */
}

.card-img-top {
  border-bottom: 3px solid #fbbc05;
  height: 300px;
  object-fit: cover;
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
        <h1>Admin - Novel dan Chapter</h1>

        <!-- Form untuk menambah novel -->
        <form method="POST" action="" enctype="multipart/form-data" class="mb-3">
            <h3>Tambah Novel</h3>
            <div class="mb-3">
                <input type="text" class="form-control" name="title" placeholder="Judul Novel" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="content" placeholder="Konten Novel" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <select class="form-select" name="category_id" required>
                    <option value="">Pilih Kategori</option>
                    <?php while($row = $categories->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="cover_image">Cover Novel</label>
                <input type="file" class="form-control" name="cover_image" accept="image/*">
            </div>
            <button type="submit" name="add_novel" class="btn btn-primary">Tambah Novel</button>
        </form>

        <h2>Daftar Novel</h2>
        <div class="row">
            <?php while($row = $novels->fetch_assoc()): ?>
                <div class="col-md-4 mb-3">
    <div class="card">
        <img src="<?php echo $row['cover_image']; ?>" class="card-img-top" alt="Cover Novel">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['title']; ?></h5>
            <p class="card-text"><?php echo substr($row['content'], 0, 100); ?>...</p>
            <a href="edit_novel.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit Novel</a>
            <a href="delete_novel.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete Novel</a>
            <!-- Manage Chapters Button -->
            <a href="manage_chapters.php?novel_id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm mt-2">Manage Chapters</a>
        </div>
    </div>
</div>
            <?php endwhile; ?>
        </div>

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

<?php $conn->close(); ?>
