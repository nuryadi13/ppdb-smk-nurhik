<?php
// Hubungkan ke database
require_once "../pejabat/koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data berdasarkan ID
    $query = "DELETE FROM siswa WHERE id = $id";
    mysqli_query($koneksi, $query);

    // Redirect kembali ke halaman admin
    header("Location: index.php");
}
?>
