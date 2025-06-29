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

// Ambil data novel berdasarkan id
if (isset($_GET['id'])) {
    $novel_id = $_GET['id'];
    $sql = "SELECT * FROM novels WHERE id = $novel_id";
    $result = $conn->query($sql);
    $novel = $result->fetch_assoc();
}

// Update novel
if (isset($_POST['edit_novel'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];

    // Update cover image jika ada perubahan
    $cover_image = $novel['cover_image'];
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["cover_image"]["name"]);
        move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file);
        $cover_image = $target_file;
    }

    $sql_update = "UPDATE novels SET title='$title', content='$content', category_id='$category_id', cover_image='$cover_image' WHERE id=$novel_id";
    if ($conn->query($sql_update) === TRUE) {
        echo "Novel berhasil diperbarui!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil kategori untuk dropdown
$sql_categories = "SELECT * FROM categories";
$categories = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Novel</title>
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
        <h1>Edit Novel</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" class="form-control" name="title" value="<?php echo $novel['title']; ?>" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="content" rows="5" required><?php echo $novel['content']; ?></textarea>
            </div>
            <div class="mb-3">
                <select class="form-select" name="category_id" required>
                    <option value="">Pilih Kategori</option>
                    <?php while($row = $categories->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>" <?php if($novel['category_id'] == $row['id']) echo 'selected'; ?>>
                            <?php echo $row['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="cover_image">Cover Novel</label>
                <input type="file" class="form-control" name="cover_image" accept="image/*">
                <img src="<?php echo $novel['cover_image']; ?>" alt="Cover" class="img-fluid mt-2" style="max-width: 200px;">
            </div>
            <button type="submit" name="edit_novel" class="btn btn-primary">Update Novel</button>
        </form>
    </div>

    <!-- Footer -->
<footer class="footer">
    <div class="footer-bottom">
        <p>&copy; 2025 BacaYuks | All rights reserved</p>
    </div>
</footer>
</body>
</html>

<?php $conn->close(); ?>
