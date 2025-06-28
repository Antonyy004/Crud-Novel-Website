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

// Tambah kategori
if (isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    $sql = "INSERT INTO categories (name) VALUES ('$category_name')";
    if ($conn->query($sql) === TRUE) {
        echo "Kategori berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tampilkan semua kategori
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kategori</title>
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
        <h1>Admin - Kategori</h1>
        
        <!-- Form untuk menambah kategori -->
        <form method="POST" action="" class="mb-3">
            <div class="mb-3">
                <input type="text" class="form-control" name="category_name" placeholder="Nama Kategori" required>
            </div>
            <button type="submit" name="add_category" class="btn btn-primary">Tambah Kategori</button>
        </form>
        
        <h2>Daftar Kategori</h2>
        <ul class="list-group">
            <?php while($row = $result->fetch_assoc()): ?>
                <li class="list-group-item">
                    <?php echo $row['name']; ?>
                    <a href="edit_category.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm float-end ms-2">Edit</a>
                    <a href="delete_category.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm float-end">Delete</a>
                </li>
            <?php endwhile; ?>
        </ul>
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
