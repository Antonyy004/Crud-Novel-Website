<?php
// Koneksi ke database
$host = 'db.be-mons1.bengt.wasmernet.com';
$username = '0d5c216a70dd8000b60a44c86b34';
$password = '06860d5c-216a-7205-8000-2abbc29cfc7b';
$database = 'web_novel';
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil id kategori dari parameter URL
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // Cek apakah kategori ini digunakan di tabel novels
    $check_sql = "SELECT * FROM novels WHERE category_id = $category_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Jika ada novel yang menggunakan kategori ini, tampilkan pesan error
        echo "Kategori ini sedang digunakan oleh beberapa novel. Anda tidak dapat menghapus kategori ini.";
    } else {
        // Jika tidak ada, hapus kategori dari database
        $delete_sql = "DELETE FROM categories WHERE id = $category_id";
        
        if ($conn->query($delete_sql) === TRUE) {
            // Redirect ke halaman list kategori setelah penghapusan berhasil
            echo "<script>
                    alert('Kategori berhasil dihapus!');
                    window.location.href = 'admin_categories.php'; // Ganti dengan halaman daftar kategori Anda
                  </script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "ID kategori tidak ditemukan.";
}

$conn->close();
?>
