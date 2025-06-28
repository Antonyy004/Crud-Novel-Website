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

// Menghapus novel
if (isset($_GET['id'])) {
    $novel_id = $_GET['id'];

    // Menghapus semua chapter yang terkait dengan novel
    $sql_delete_chapters = "DELETE FROM chapters WHERE novel_id = $novel_id";
    $conn->query($sql_delete_chapters);

    // Menghapus novel
    $sql_delete_novel = "DELETE FROM novels WHERE id = $novel_id";
    if ($conn->query($sql_delete_novel) === TRUE) {
        echo "Novel berhasil dihapus!";
        header("Location: admin_novels.php"); // Redirect ke halaman admin novel
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
