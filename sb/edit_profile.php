<?php
// Include file koneksi database
include_once('../pejabat/koneksi.php');
session_start();

// Cek apakah parameter ID ada dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID siswa tidak ditemukan.");
}

// Ambil data siswa berdasarkan ID
$query = "SELECT * FROM siswa WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    $siswa = mysqli_fetch_assoc($result);
    if (!$siswa) {
        die("Data tidak ditemukan untuk ID: $id");
    }
} else {
    die("Error executing query: " . mysqli_error($koneksi));
}

// Proses form jika metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form dan lakukan validasi jika diperlukan
    $nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $alamat_lengkap = mysqli_real_escape_string($koneksi, $_POST['alamat_lengkap']);
    $no_hp_siswa = mysqli_real_escape_string($koneksi, $_POST['no_hp_siswa']);
    $no_hp_orangtua = mysqli_real_escape_string($koneksi, $_POST['no_hp_orangtua']);
    $ukuran_baju = mysqli_real_escape_string($koneksi, $_POST['ukuran_baju']);
    $asalSekolah = mysqli_real_escape_string($koneksi, $_POST['asalSekolah']);
    
    // Handle asalSekolah and asalSekolah_lain
    if ($asalSekolah === 'other') {
        $asalSekolah = mysqli_real_escape_string($koneksi, $_POST['asalSekolah_lain']);
    }

    // Update data ke database
    $query = "UPDATE siswa SET nama_siswa = ?, username = ?, email = ?, jurusan = ?, asal_sekolah = ?, jenis_kelamin = ?, tempat_lahir = ?, tanggal_lahir = ?, alamat_lengkap = ?, no_hp_siswa = ?, no_hp_orangtua = ?, ukuran_baju = ? WHERE id = ?";
    
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssssssssi', $nama_siswa, $username, $email, $jurusan, $asalSekolah, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat_lengkap, $no_hp_siswa, $no_hp_orangtua, $ukuran_baju, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Data berhasil diperbarui!";
    } else {
        echo "Error updating record: " . mysqli_stmt_error($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            background-color: #343a40;
            padding: 20px;
            border-radius: 10px;
            color: #f8f9fa;
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
        }
        .form-control, .form-control-file {
            background-color: #495057;
            color: #f8f9fa;
            border-color: #6c757d;
        }
        .form-control::placeholder {
            color: #adb5bd;
        }
        .btn-primary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-primary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .img-thumbnail {
            background-color: #495057;
            border-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Edit Profile Siswa</h2>
        <form action="edit_profile.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= htmlspecialchars($siswa['nama_siswa']) ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($siswa['username']) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($siswa['email']) ?>" required>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= htmlspecialchars($siswa['jurusan']) ?>" required>
            </div>
            <div class="form-group">
                <label for="asalSekolah">Asal Sekolah:</label><br>
                <select id="asalSekolah" name="asalSekolah" onchange="checkWilayah(this)"  class="form-control" required>
                    <option value="">Pilih sekolah asal</option>
                    <option value="SMPP NURUL HIKMAH" <?= ($siswa['asal_sekolah'] === 'SMPP NURUL HIKMAH') ? 'selected' : '' ?>>SMPP NURUL HIKMAH</option>
                    <!-- Daftar sekolah lainnya di sini -->
                    <option value="other" <?= ($siswa['asal_sekolah'] !== 'SMPP NURUL HIKMAH') ? 'selected' : '' ?>>Lainnya</option>
                </select><br><br>

                <div id="asalSekolah_lain" style="<?= ($siswa['asal_sekolah'] === 'SMPP NURUL HIKMAH') ? 'display: none;' : 'display: block;' ?>">
                    <label for="asalSekolah_lain_input">Tuliskan asal sekolah:</label>
                    <input type="text" id="asalSekolah_lain_input" name="asalSekolah_lain" value="<?= htmlspecialchars($siswa['asal_sekolah']) ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?= ($siswa['jenis_kelamin'] === 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= ($siswa['jenis_kelamin'] === 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= htmlspecialchars($siswa['tempat_lahir']) ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $siswa['tanggal_lahir'] ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat_lengkap">Alamat Lengkap</label>
                <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3" required><?= htmlspecialchars($siswa['alamat_lengkap']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="no_hp_siswa">Nomor HP Siswa</label>
                <input type="tel" class="form-control" id="no_hp_siswa" name="no_hp_siswa" value="<?= htmlspecialchars($siswa['no_hp_siswa']) ?>" required>
            </div>
            <div class="form-group">
                <label for="no_hp_orangtua">Nomor HP Orang Tua / Wali</label>
                <input type="tel" class="form-control" id="no_hp_orangtua" name="no_hp_orangtua" value="<?= htmlspecialchars($siswa['no_hp_orangtua']) ?>" required>
            </div>
            <div class="form-group">
                <label for="ukuran_baju">Ukuran Baju</label>
                <input type="text" class="form-control" id="ukuran_baju" name="ukuran_baju" value="<?= htmlspecialchars($siswa['ukuran_baju']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
        function checkWilayah(select) {
            var asalSekolah_lain_div = document.getElementById("asalSekolah_lain");
            if (select.value === "other") {
                asalSekolah_lain_div.style.display = "block";
            } else {
                asalSekolah_lain_div.style.display = "none";
            }
        }
    </script>
</body>
</html>
