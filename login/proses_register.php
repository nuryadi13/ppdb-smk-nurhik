<?php
// Koneksi ke database
include '../pejabat/koneksi.php';
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form pendaftaran
$username = $_POST['username'];
$password = $_POST['password'];

// Hash kata sandi untuk keamanan
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Query untuk memasukkan data pendaftaran ke dalam tabel "admin"
$query = "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')";

if ($koneksi->query($query) === TRUE) {
    // Pendaftaran berhasil, redirect ke halaman login
    header("Location: login.php");
} else {
    // Pendaftaran gagal
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
