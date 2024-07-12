<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "ppdb_alhidayah";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Melakukan penghapusan data berdasarkan ID
    $query = "DELETE FROM siswa WHERE id = $id";

    if (mysqli_query($koneksi, $query)) {
        // Data berhasil dihapus
        session_start();
        $_SESSION['success_message'] = "Data berhasil dihapus.";
        header("Location: index.php"); // Ganti "index.php" dengan halaman Anda yang sesuai
        exit();
    } else {
        // Kesalahan saat menghapus data
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "ID data tidak ditemukan.";
}


// Tutup koneksi database
mysqli_close($koneksi);
?>
