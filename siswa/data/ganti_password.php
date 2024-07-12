<?php
include "../../pejabat/koneksi.php";

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['newPassword'];
    $email = $_POST['email'];

    // Update password baru tanpa enkripsi
    $sql = "UPDATE siswa SET password='$newPassword' WHERE email='$email'";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>
                alert('Password berhasil diubah');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>
