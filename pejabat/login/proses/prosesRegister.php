<?php
// Koneksi ke database
include '../../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $email = $_POST["email"];
    $username = $_POST["username"];
    $alamat = $_POST["alamat"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Memeriksa apakah password dan konfirmasi password cocok
    if ($password !== $confirm_password) {
        echo "Password dan konfirmasi password tidak cocok.";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Menyimpan data pengguna ke database dengan prepared statement
        $insert_query = "INSERT INTO login (email, username, alamat, password) VALUES (?, ?, ?, ?)";
        $stmt = $koneksi->prepare($insert_query);
        $stmt->bind_param("ssss", $email, $username, $alamat, $hashed_password);

        if ($stmt->execute()) {
            echo "Pendaftaran berhasil. Silakan login <a href='login.php'>di sini</a>.";
        } else {
            echo "Gagal mendaftar: " . $stmt->error;
        }

        $stmt->close();
    }
}

$koneksi->close();
?>
