<?php
// Memulai sesi (jika belum dimulai)
session_start();

// Menghentikan sesi
session_destroy();

// Hapus semua data sesi
$_SESSION = array();

// Redirect ke halaman login atau halaman utama
header("Location: login.php"); // Gantilah 'login.php' dengan halaman tujuan yang sesuai
exit;
?>
