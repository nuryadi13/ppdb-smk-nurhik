<?php
// Include file koneksi database
include_once('../../pejabat/koneksi.php');
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id'])) {
    die("Anda harus login untuk mengakses halaman ini.");
}

$id = $_SESSION['id'];

// Ambil data siswa berdasarkan ID
$query = "SELECT * FROM siswa WHERE id = $id";
$result = mysqli_query($koneksi, $query);

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
    // Ambil data dari form
    $nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
    $nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
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
    $fotosiswa = $_FILES['fotosiswa']['name'];
    $ktp = $_FILES['ktp']['name'];
    $kk = $_FILES['kk']['name'];

    // Handle upload file
    function handleFileUpload($file, $target_dir, $current_value) {
        if ($file['name']) {
            $target_file = $target_dir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                echo "File berhasil diupload.<br>";
                return $target_file;
            } else {
                echo "Error uploading file.<br>";
                return $current_value;
            }
        } else {
            return $current_value;
        }
    }

    $fotosiswa = handleFileUpload($_FILES['fotosiswa'], "upload/", $siswa['fotosiswa']);
    $ktp = handleFileUpload($_FILES['ktp'], "upload/", $siswa['ktp']);
    $kk = handleFileUpload($_FILES['kk'], "upload/", $siswa['kk']);

    // Handle asalSekolah and asalSekolah_lain
    $asalSekolah = mysqli_real_escape_string($koneksi, $_POST['asalSekolah']);
    if ($asalSekolah === 'other') {
        $asalSekolah = mysqli_real_escape_string($koneksi, $_POST['asalSekolah_lain']);
    }

    // Update database
    $query = "UPDATE siswa SET nama_siswa = '$nama_siswa', nisn = '$nisn', username = '$username', email = '$email', jurusan = '$jurusan', asal_sekolah = '$asalSekolah', jenis_kelamin = '$jenis_kelamin', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', alamat_lengkap = '$alamat_lengkap', no_hp_siswa = '$no_hp_siswa', no_hp_orangtua = '$no_hp_orangtua', ukuran_baju = '$ukuran_baju', fotosiswa = '$fotosiswa', ktp = '$ktp', kk = '$kk' WHERE id = $id";

    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil diperbarui!";
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
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
    <form action="edit_profil.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama_siswa">Nama Siswa</label>
            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= htmlspecialchars($siswa['nama_siswa']) ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($siswa['username']) ?>" required>
        </div>
        <div class="form-group">
            <label for="nisn">NISN</label>
            <input type="text" class="form-control" id="nisn" name="nisn" value="<?= htmlspecialchars($siswa['nisn']) ?>" required>
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
                <option value="SMPP NURUL HIKMAH">SMPP NURUL HIKMAH</option>
                                <option value="MTs NURUL HIKMAH">MTs NURUL HIKMAH</option>
                                <option value="SMPN 1 JONGGOL">SMPN 1 JONGGOL</option>
                                <option value="SMPN 2 JONGGOL">SMPN 2 JONGGOL</option>
                                <option value="SMPN 3 JONGGOL">SMPN 3 JONGGOL</option>
                                <option value="MTs JONGGOL">MTs JONGGOL</option>
                                <option value="SMP PGRI JONGGOL">SMP PGRI JONGGOL</option>
                                <option value="SMP PASUNDAN">SMP PASUNDAN</option>
                                <option value="MTs AL-FATMAHIYAH">MTs AL-FATMAHIYAH</option>
                                <option value="MTs LUKMANUL HAKIM">MTs LUKMANUL HAKIM</option>
                                <option value="SMP PGRI GANDOANG">SMP PGRI GANDOANG</option>
                                <option value="SMPN 1 CILEUNGSI">SMPN 1 CILEUNGSI</option>
                                <option value="SMPN 2 CILEUNGSI">SMPN 2 CILEUNGSI</option>
                                <option value="SMPN 4 CILEUNGSI">SMPN 4 CILEUNGSI</option>
                                <option value="MTs QURROTUL AINI CILEUNGSI">MTs QURROTUL AINI CILEUNGSI</option>
                                <option value="Mts HIDAYATUSSALAM">Mts HIDAYATUSSALAM</option>
                                <option value="SMPI BINA TAQWA">SMPI BINA TAQWA</option>
                                <option value="MTs AL-FALAH">MTs AL-FALAH</option>
                                <option value="MTs DARUL ULUM TANJUNG SARI">MTs DARUL ULUM TANJUNG SARI</option>
                                <option value="SMPN TANJUNGSARI">SMPN TANJUNGSARI</option>
                                <option value="MTs YASNIFA">MTs YASNIFA</option>
                                <option value="SMPN 1 CARIU">SMPN 1 CARIU</option>
                                <option value="SMPN 1 CIBARUSAH">SMPN 1 CIBARUSAH</option>
                                <option value="SMPN 2 CIBARUSAH">SMPN 2 CIBARUSAH</option>
                                <option value="SMPN 4 CIBARUSAH">SMPN 4 CIBARUSAH</option>
                                <option value="SMPN 5 CIBARUSAH">SMPN 5 CIBARUSAH</option>
                                <option value="MTs Al-BAQIYATUSSHOLIHAT">MTs Al-BAQIYATUSSHOLIHAT</option>
                                <option value="SMPN 1 SUKA MAKMUR">SMPN 1 SUKAMAKMUR</option>
                                <option value="SMPN 2 SUKAMAKMUR">SMPN 2 SUKAMAKMUR</option>
                                <option value="SMP PUTRA MELATI">SMP PUTRA MELATI</option>
                                <option value="SMP MUTIARA KENCANA">SMP MUTIARA KENCANA</option>
                                <option value="SMPS SEJAHTERA 2">SMPS SEJAHTERA 2</option>
                                <option value="SMPI TAMAN QURANIAH">SMPI TAMAN QURANIAH</option>
                                <option value="SMP IT AL-HASANIYYAH">SMP IT AL-HASANIYYAH</option>
                                <option value="SMP BINA CITRA MANDIRI">SMP BINA CITRA MANDIRI</option>
                                <option value="MTS SA ALIKHLAS">MTS SA ALIKHLAS</option>
                <option value="other">Lainnya</option>
            </select><br><br>

            <div id="asalSekolah_lain" style="display: none;">
                <label for="asalSekolah_lain_input">Tuliskan asal sekolah:</label>
                <input type="text" id="asalSekolah_lain_input" name="asalSekolah_lain">
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
            <label for="no_hp_siswa">No HP Siswa</label>
            <input type="text" class="form-control" id="no_hp_siswa" name="no_hp_siswa" value="<?= htmlspecialchars($siswa['no_hp_siswa']) ?>" required>
        </div>
        <div class="form-group">
            <label for="no_hp_orangtua">No HP Orang Tua</label>
            <input type="text" class="form-control" id="no_hp_orangtua" name="no_hp_orangtua" value="<?= htmlspecialchars($siswa['no_hp_orangtua']) ?>" required>
        </div>
        <div class="form-group">
            <label for="ukuran_baju">Ukuran Baju</label>
            <input type="text" class="form-control" id="ukuran_baju" name="ukuran_baju" value="<?= htmlspecialchars($siswa['ukuran_baju']) ?>" required>
        </div>
        <div class="form-group">
            <label for="fotosiswa">Foto Siswa</label><br>
            <input type="file" id="fotosiswa" name="fotosiswa" class="form-control-file">
            <?php if ($siswa['fotosiswa']): ?>
                <img src="<?= $siswa['fotosiswa'] ?>" class="img-thumbnail mt-2" width="100">
            <?php endif; ?>
        </div>
        <div class="form-group">
        <label for="ktp">KTP</label><br>
            <input type="file" id="ktp" name="ktp" class="form-control-file">
            <?php if ($siswa['ktp']): ?>
            <img src="<?= $siswa['ktp'] ?>" class="img-thumbnail mt-2" width="100">
            <?php endif; ?>
        </div>

        <div class="form-group">
        <label for="kk">KK</label><br>
            <input type="file" id="kk" name="kk" class="form-control-file">
            <?php if ($siswa['kk']): ?>
            <img src="<?= $siswa['kk'] ?>" class="img-thumbnail mt-2" width="100">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
    // Tampilkan input asalSekolah_lain jika pilihan 'Lainnya' dipilih
    function checkWilayah(select) {
        var div_asalSekolah_lain = document.getElementById("asalSekolah_lain");
        if (select.value === "other") {
            div_asalSekolah_lain.style.display = "block";
        } else {
            div_asalSekolah_lain.style.display = "none";
        }
    }
</script>
</body>
</html>
