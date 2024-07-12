<?php
// Koneksi ke database (ganti sesuai dengan informasi database Anda)

include 'koneksi.php';


// Tangkap data dari form
$nama = $_POST['nama'];
$jabatan = $_POST['jabatan'];
$alamat = $_POST['alamat'];

// Upload gambar
$gambar = $_FILES['gambar']['name'];
$gambar_tmp = $_FILES['gambar']['tmp_name'];
$gambar_path = "uploads/" . $gambar;
move_uploaded_file($gambar_tmp, $gambar_path);

// Simpan data ke database
$sql = "INSERT INTO pejabat (nama, jabatan, alamat, gambar) VALUES ('$nama', '$jabatan', '$alamat', '$gambar_path')";

if (mysqli_query($koneksi, $sql)) {
    echo "Data berhasil disimpan.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>
