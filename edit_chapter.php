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

// Ambil data chapter berdasarkan id
if (isset($_GET['id'])) {
    $chapter_id = $_GET['id'];
    $sql = "SELECT * FROM chapters WHERE id = $chapter_id";
    $result = $conn->query($sql);
    $chapter = $result->fetch_assoc();
}

// Update chapter
if (isset($_POST['edit_chapter'])) {
    $novel_id = $_POST['novel_id'];
    $title = $_POST['chapter_title'];
    $content = $_POST['chapter_content'];

    $sql_update = "UPDATE chapters SET title='$title', content='$content', novel_id='$novel_id' WHERE id=$chapter_id";
    if ($conn->query($sql_update) === TRUE) {
        echo "Chapter berhasil diperbarui!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil novel untuk dropdown
$sql_novels = "SELECT * FROM novels";
$novels = $conn->query($sql_novels);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Chapter</title>
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
            margin-top: 10px;
        }

        .btn-warning {
            margin-right: 10px;
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
        <h1>Edit Chapter</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <select class="form-select" name="novel_id" required>
                    <option value="">Pilih Novel</option>
                    <?php while($row = $novels->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>" <?php if($chapter['novel_id'] == $row['id']) echo 'selected'; ?>>
                            <?php echo $row['title']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="chapter_title" value="<?php echo $chapter['title']; ?>" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="chapter_content" rows="5" required><?php echo $chapter['content']; ?></textarea>
            </div>
            <button type="submit" name="edit_chapter" class="btn btn-primary">Update Chapter</button>
        </form>
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
