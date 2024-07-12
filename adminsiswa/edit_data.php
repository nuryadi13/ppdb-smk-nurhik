<?php
// Hubungkan ke database
include "../pejabat/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data dari database berdasarkan ID
    $query = "SELECT * FROM siswa WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_siswa = $_POST['nama_siswa'];
    $nama_orangtua = $_POST['nama_orangtua'];

    // Lakukan validasi dan perubahan data di sini

    // Redirect kembali ke halaman admin
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Data Siswa</h1>
    <form action="edit_data.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>Nama Siswa:</label>
        <input type="text" name="nama_siswa" value="<?php echo $row['nama_siswa']; ?>" required><br>
        
        <label>Nama Orang Tua:</label>
        <input type="text" name="nama_orangtua" value="<?php echo $row['nama_orangtua']; ?>" required><br>
        
        <input type="submit" value="Simpan Perubahan">
    </form>
</body>
</html>
