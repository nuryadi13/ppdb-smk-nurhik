<?php
include "../../pejabat/koneksi.php";
// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Query untuk memeriksa kecocokan nama dan email
    $sql = "SELECT * FROM siswa WHERE nama_siswa='$name' AND email='$email'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        // Jika data cocok, kirim respons sukses
        echo "success";
    } else {
        // Jika data tidak cocok, kirim respons gagal
        echo "failure";
    }
}

$koneksi->close();
?>
