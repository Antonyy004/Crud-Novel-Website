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

// Menghapus chapter
if (isset($_GET['id'])) {
    $chapter_id = $_GET['id'];

    $sql_delete_chapter = "DELETE FROM chapters WHERE id = $chapter_id";
    if ($conn->query($sql_delete_chapter) === TRUE) {
        echo "Chapter berhasil dihapus!";
        header("Location: admin_novels.php"); // Redirect ke halaman admin novel
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
