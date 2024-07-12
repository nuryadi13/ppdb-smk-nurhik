<a href="../siswa/data/upload/"></a>
<?php
include('../pejabat/koneksi.php');

if (isset($_POST['submit'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $nama_orang_tua = $_POST['nama_orangtua'];
    $jurusan = $_POST['jurusan'];

    // Validasi dan sanitasi input
    if (empty($nama_siswa) || empty($nama_orang_tua) || empty($jurusan)) {
        echo "Semua kolom harus diisi.";
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
            $sql = "INSERT INTO siswa (nama_siswa, jurusan, nama_orangtua, fotosiswa, ktp, kk) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssss", $nama_siswa, $jurusan, $nama_orang_tua, $fotosiswa_path, $ktp_path, $kartu_keluarga_path);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);
                    header("Location: data.php");
                    exit; // Keluar dari skrip setelah mengarahkan
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
