<?php
$host = 'db.be-mons1.bengt.wasmernet.com';
$username = '0d5c216a70dd8000b60a44c86b34';
$password = '06860d5c-216a-7205-8000-2abbc29cfc7b';
$database = 'web_novel';
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['novel_id'])) {
    $novel_id = $_GET['novel_id'];

    $sql_chapters = "SELECT * FROM chapters WHERE novel_id = $novel_id";
    $chapters = $conn->query($sql_chapters);
}

if (isset($_POST['add_chapter'])) {
    $chapter_title = $_POST['chapter_title'];
    $chapter_content = $_POST['chapter_content'];

    $sql = "INSERT INTO chapters (novel_id, title, content) VALUES ('$novel_id', '$chapter_title', '$chapter_content')";
    if ($conn->query($sql) === TRUE) {
        echo "Chapter berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Chapters</title>
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

        .card {
            width: 18rem;
            height: 20rem;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1.1rem;
        }

        .card-text {
            font-size: 0.9rem;
        }

        .btn-sm {
            margin-top: 5px;
        }

        .btn-warning, .btn-danger {
            width: 100%; 
            margin-bottom: 5px; 
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
    <h1>Manage Chapters</h1>
    <form method="POST" action="" class="mb-3">
        <h3>Tambah Chapter</h3>
        <div class="mb-3">
            <input type="text" class="form-control" name="chapter_title" placeholder="Judul Chapter" required>
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="chapter_content" placeholder="Konten Chapter" rows="5" required></textarea>
        </div>
        <button type="submit" name="add_chapter" class="btn btn-primary">Tambah Chapter</button>
    </form>

    <h2>Daftar Chapter</h2>
    <div class="row">
        <?php while($row = $chapters->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['title']; ?></h5>
                        <p class="card-text"><?php echo substr($row['content'], 0, 100); ?>...</p>
                        <a href="edit_chapter.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit Chapter</a>
                        <a href="delete_chapter.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete Chapter</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<footer class="footer">
    <div class="footer-bottom">
        <p>&copy; 2025 BacaYuks | All rights reserved</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
