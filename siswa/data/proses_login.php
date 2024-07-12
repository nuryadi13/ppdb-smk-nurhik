<?php
session_start();
include('../../pejabat/koneksi.php'); // Pastikan file ini berisi koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Query untuk memeriksa data login
    $query = "SELECT id, username, nisn FROM siswa WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($result) > 0) {
        // Jika username dan password cocok
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id']; // Menyimpan id dalam sesi
        $_SESSION['nisn'] = $row['nisn'];
        $_SESSION['username'] = $row['username']; // Menyimpan username dalam sesi

        header("Location: page_siswa.php");
        exit();
    } else {
        // Jika username dan password tidak cocok
        echo "<script>alert('Pengguna tidak ditemukan'); window.location.href='login_siswa.php';</script>";
        exit();
    }
} else {
    // Debugging untuk memastikan script ini dipanggil
    echo "Request method is not POST.";
}
?>
