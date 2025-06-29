<?php
$host = 'db.be-mons1.bengt.wasmernet.com';
$username = '0d5c216a70dd8000b60a44c86b34';
$password = '06860d5c-216a-7205-8000-2abbc29cfc7b';
$database = 'web_novel';
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category_id = $_GET['id'];

$sql = "SELECT * FROM categories WHERE id = $category_id";
$result = $conn->query($sql);
$category = $result->fetch_assoc();

if (isset($_POST['update_category'])) {
    $category_name = $_POST['category_name'];
    $sql = "UPDATE categories SET name = '$category_name' WHERE id = $category_id";
    if ($conn->query($sql) === TRUE) {
        echo "Kategori berhasil diupdate!";
        header("Location: admin_categories.php");
        exit();
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
    <title>Edit Kategori</title>
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
        .btn-yellow {
    background-color: #fbbc05;
    border-color: #fbbc05;
    color: black;
}

.btn-yellow:hover {
    background-color: #ffcd38;
    border-color: #ffcd38;
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
    <h1>Edit Kategori</h1>
    <form method="POST" action="" class="mb-3">
        <div class="mb-3">
            <input type="text" class="form-control" name="category_name" value="<?php echo $category['name']; ?>" required>
        </div>
        <button type="submit" name="update_category" class="btn btn-yellow">Update Kategori</button>
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
