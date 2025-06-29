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
