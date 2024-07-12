<!DOCTYPE html>
<html>
<head>
    <title>Form Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
include '../pejabat/koneksi.php';
$nama_siswa = "";
$jurusan = "";
$nama_orangtua = "";
$fotosiswa = "";
$ktp = "";
$kk = "";
$selected_id = "";

if (isset($_GET['id'])) {
    $selected_id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $sql = "SELECT * FROM siswa WHERE id = '$selected_id'";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            $nama_siswa = $row['nama_siswa'];
            $jurusan = $row['jurusan'];
            $nama_orangtua = $row['nama_orangtua'];
            $fotosiswa = $row['fotosiswa'];
            $ktp = $row['ktp'];
            $kk = $row['kk'];
        }
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<div class="container"><br>
    <a href="index.php" class="btn btn-danger"><< Kembali</a>
    <h2 class="text-center"><b>Edit Data</b></h2>
    <form action="proses_edit.php" method="post" enctype="multipart/form-data" id="editForm">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($selected_id); ?>">
        <div class="form-group">
            <label for="nama_siswa">Nama Siswa:</label>
            <input type="text" class="form-control" id="nama_siswa" value="<?php echo htmlspecialchars($nama_siswa); ?>" name="nama_siswa" required>
        </div>
        <div class="form-group">
            <label for="jurusan">Pilih jurusan:</label>
            <select name="jurusan" id="jurusan" class="form-control" required>
                <option value="Pilih" <?php if ($jurusan == 'Pilih') echo 'selected'; ?>>Pilih</option>
                <option value="A" <?php if ($jurusan == 'A') echo 'selected'; ?>>jurusan A</option>
                <option value="B" <?php if ($jurusan == 'B') echo 'selected'; ?>>jurusan B</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nama_orangtua">Nama Orang Tua:</label>
            <input type="text" class="form-control" id="nama_orangtua" name="nama_orangtua" value="<?php echo htmlspecialchars($nama_orangtua); ?>" required>
        </div>

        <div class="form-group">
            <label for="fotosiswa">Unggah Foto Siswa :</label>
            <input type="file" class="form-control-file" id="fotosiswa" name="fotosiswa" accept=".jpg, .png">
        </div>

        <div class="form-group">
            <label for="ktp">Unggah KTP Anda :</label>
            <input type="file" class="form-control-file" id="ktp" name="ktp" accept=".jpg, .png">
        </div>

        <div class="form-group">
            <label for="kk">Unggah Foto KK:</label>
            <input type="file" class="form-control-file" id="kk" name="kk" accept=".jpg, .png">
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
    </form>
</div>

<script>
    // Validasi form dengan JavaScript
    document.getElementById("editForm").addEventListener("submit", function(event) {
        const namaSiswa = document.getElementById("nama_siswa").value;
        const jurusan = document.getElementById("jurusan").value;
        const namaOrangTua = document.getElementById("nama_orangtua").value;

        if (namaSiswa.trim() === "" || jurusan === "Pilih" || namaOrangTua.trim() === "") {
            alert("Semua kolom harus diisi.");
            event.preventDefault(); // Mencegah pengiriman form jika ada kesalahan
        }
    });
</script>
</body>
</html>
