<?php
// Koneksi ke database
session_start();
include '../pejabat/koneksi.php';
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data dari form
$password_lama = $_POST['password_lama'];
$password_baru = $_POST['password_baru'];
$konfirmasi_password = $_POST['konfirmasi_password'];

// Query untuk mengambil password lama dari database
$username = $_SESSION['username']; // Gantilah ini dengan cara Anda menyimpan username pada sesi
$query = "SELECT password FROM admin WHERE username = '$username'";
$result = $koneksi->query($query);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Memeriksa apakah password lama sesuai dengan password yang ada di database
    if (password_verify($password_lama, $hashed_password)) {
        // Password lama sesuai, lanjutkan dengan perubahan password baru
        if ($password_baru === $konfirmasi_password) {
            // Hash password baru
            $hashed_password_baru = password_hash($password_baru, PASSWORD_BCRYPT);

            // Query untuk mengganti password baru
            $update_query = "UPDATE admin SET password = '$hashed_password_baru' WHERE username = '$username'";
            if ($koneksi->query($update_query) === TRUE) {
                echo "Password berhasil diubah.";
            } else {
                echo "Error: " . $update_query . "<br>" . $koneksi->error;
            }
        } else {
            echo "Konfirmasi password baru tidak sesuai.";
        }
    } else {
        echo "Password lama tidak sesuai.";
    }
} else {
    echo "Username tidak ditemukan.";
}

$koneksi->close();
?>
