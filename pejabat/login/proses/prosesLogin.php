<?php
// Koneksi ke database
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cari pengguna berdasarkan username
    $select_query = "SELECT id, username, password_hash FROM login WHERE username = ?";
    $stmt = $koneksi->prepare($select_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Ambil hasil dari query
        $stmt->bind_result($user_id, $db_username, $db_password_hash);
        $stmt->fetch();

        // Memeriksa apakah password sesuai
        if (password_verify($password, $db_password_hash)) {
            echo "Login berhasil. Selamat datang, $db_username!";
        } else {
            echo "Login gagal. Password salah.";
        }
    } else {
        echo "Login gagal. Pengguna dengan username tersebut tidak ditemukan.";
    }

    $stmt->close();
}

$koneksi->close();
?>

