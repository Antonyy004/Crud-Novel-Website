<?php
session_start(); // Memulai sesi

// Koneksi ke database
$host = 'db.be-mons1.bengt.wasmernet.com';
$username = '0d5c216a70dd8000b60a44c86b34';
$password = '06860d5c-216a-7205-8000-2abbc29cfc7b';
$database = 'web_novel';
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa kredensial
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Pengguna ditemukan, simpan sesi
        $_SESSION['logged_in'] = true;
        header("Location: indexadmin.php"); // Arahkan ke halaman admin setelah login
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Username atau Password salah!</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Montserrat", sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #fbbc05;
        }

        .form-control {
            border-radius: 25px;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #fbbc05;
            border: none;
            border-radius: 25px;
            padding: 10px;
            width: 100%;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #e89a00;
        }

        .alert {
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-top: 20px;
        }

        .footer a {
            color: #fbbc05;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php $conn->close(); ?>
