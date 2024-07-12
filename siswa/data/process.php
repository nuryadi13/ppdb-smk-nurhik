<?php
include('../../pejabat/koneksi.php');

if (isset($_POST['submit'])) {
    $nama_siswa = htmlspecialchars($_POST['nama_siswa']);
    $nisn = htmlspecialchars($_POST['nisn']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $alamat_lengkap = htmlspecialchars($_POST['alamat_lengkap']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $asalSekolah = htmlspecialchars($_POST['asalSekolah']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $tempat_lahir = htmlspecialchars($_POST['tempat_lahir']);
    $tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);
    $alamat_lengkap = htmlspecialchars($_POST['alamat_lengkap']);
    $no_hp_siswa = htmlspecialchars($_POST['no_hp_siswa']);
    $no_hp_orangtua = htmlspecialchars($_POST['no_hp_orangtua']);
    $ukuran_baju = htmlspecialchars($_POST['ukuran_baju']);

    if ($asalSekolah === 'other') {
        $asalSekolah = htmlspecialchars($_POST['asalSekolah_lain']);
    }

    // Fungsi untuk mengubah format tanggal dari dd-mm-yyyy ke yyyy-mm-dd
    function ubahFormatTanggal($tanggal) {
        $tanggalArray = explode('-', $tanggal);
        return $tanggalArray[2] . '-' . $tanggalArray[1] . '-' . $tanggalArray[0];
    }

    // Ubah format tanggal lahir
    $tanggal_lahir = ubahFormatTanggal($tanggal_lahir);

    // Validasi dan sanitasi input
    if (empty($nama_siswa)|| empty($nisn)|| empty($username) || empty($password) || empty($email) || empty($jurusan) || empty($asalSekolah) || empty($jenis_kelamin) || empty($tempat_lahir) || empty($tanggal_lahir)
    || empty($alamat_lengkap) || empty($no_hp_siswa) || empty($no_hp_orangtua) || empty($ukuran_baju)) {
        echo '<script>alert("Semua kolom harus diisi"); window.location = "index.php";</script>';
        exit;
    }

    $allowedExtensions = array("png", "jpg", "jpeg", "gif");

    $fotosiswa_file = $_FILES['fotosiswa'];
    $kartu_keluarga_file = $_FILES['kk'];
    $ktp_file = $_FILES['ktp'];

    $fotosiswa_extension = pathinfo($fotosiswa_file['name'], PATHINFO_EXTENSION);
    $kartu_keluarga_extension = pathinfo($kartu_keluarga_file['name'], PATHINFO_EXTENSION);
    $ktp_extension = pathinfo($ktp_file['name'], PATHINFO_EXTENSION);

    if (
        in_array(strtolower($fotosiswa_extension), $allowedExtensions) &&
        in_array(strtolower($kartu_keluarga_extension), $allowedExtensions) &&
        in_array(strtolower($ktp_extension), $allowedExtensions)
    ) {
        $uploadDirectory = 'upload/';
        $fotosiswa_path = $uploadDirectory . basename($fotosiswa_file['name']);
        $kartu_keluarga_path = $uploadDirectory . basename($kartu_keluarga_file['name']);
        $ktp_path = $uploadDirectory . basename($ktp_file['name']);

        // Pindahkan file yang diunggah ke folder 'upload/'
        if (
            move_uploaded_file($fotosiswa_file['tmp_name'], $fotosiswa_path) &&
            move_uploaded_file($kartu_keluarga_file['tmp_name'], $kartu_keluarga_path) &&
            move_uploaded_file($ktp_file['tmp_name'], $ktp_path)
        ) {
            // Simpan data ke database dengan prepared statement
            $sql = "INSERT INTO siswa (nama_siswa, nisn, username, password, email, jurusan, asal_sekolah, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat_lengkap, no_hp_siswa, no_hp_orangtua, ukuran_baju, fotosiswa, ktp, kk) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_prepare($koneksi, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssssssssssssss", $nama_siswa, $nisn, $username, $password, $email, $jurusan, $asalSekolah, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat_lengkap, $no_hp_siswa, $no_hp_orangtua, $ukuran_baju, $fotosiswa_path, $ktp_path, $kartu_keluarga_path);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);
                    header("Location: data.php");
                    exit;
                } else {
                    echo "Error: " . mysqli_error($koneksi);
                }
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        echo "Tipe file yang diunggah tidak valid. Hanya file PNG, JPG, JPEG, dan GIF yang diizinkan.";
    }
}
?>
