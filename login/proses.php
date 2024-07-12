<?php
session_start();
// Koneksi ke database
include '../pejabat/koneksi.php';
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mencari data pengguna berdasarkan username
$query = "SELECT * FROM admin WHERE username = '$username'";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verifikasi kata sandi
    if (password_verify($password, $row['password'])) {
        // Login berhasil, lakukan sesuatu (misalnya, set sesi pengguna dan redirect)
        session_start();
        $_SESSION['username'] = $username;
        header("Location: ../sb/index.php"); // Ganti dengan halaman yang sesuai
    } else {
        // Kata sandi salah
    echo "<script>alert('Password Salah.'); window.location.href = 'login.php';</script>";
    }
} else {
    echo "<script>alert('Pengguna tidak ditemukan.'); window.location.href = 'login.php';</script>";
}
$koneksi->close();
?>
