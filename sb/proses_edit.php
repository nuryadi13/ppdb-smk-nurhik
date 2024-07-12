<?php
include('../pejabat/koneksi.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama_siswa = $_POST['nama_siswa'];
    $nama_orang_tua = $_POST['nama_orangtua'];
    $jurusan = $_POST['jurusan'];

    // Validasi dan sanitasi input
    if (empty($nama_siswa) || empty($nama_orang_tua) || empty($jurusan)) {
        echo "Semua kolom harus diisi.";
        exit;
    }

    // Proses file yang diunggah
    $uploadPath = '../siswa/data/';
    
    if ($_FILES['fotosiswa']['error'] == UPLOAD_ERR_OK) {
        $fotosiswa_tmp = $_FILES['fotosiswa']['tmp_name'];
        $fotosiswa_name = uniqid() . '_' . $_FILES['fotosiswa']['name']; // Menambahkan unik id untuk nama file
        if (move_uploaded_file($fotosiswa_tmp, $uploadPath . $fotosiswa_name)) {
            // File berhasil diunggah
        } else {
            echo "Gagal mengunggah file fotosiswa.";
            exit;
        }
    }

    if ($_FILES['ktp']['error'] == UPLOAD_ERR_OK) {
        $ktp_tmp = $_FILES['ktp']['tmp_name'];
        $ktp_name = uniqid() . '_' . $_FILES['ktp']['name'];
        if (move_uploaded_file($ktp_tmp, $uploadPath . $ktp_name)) {
            // File berhasil diunggah
        } else {
            echo "Gagal mengunggah file KTP.";
            exit;
        }
    }

    if ($_FILES['kk']['error'] == UPLOAD_ERR_OK) {
        $kk_tmp = $_FILES['kk']['tmp_name'];
        $kk_name = uniqid() . '_' . $_FILES['kk']['name'];
        if (move_uploaded_file($kk_tmp, $uploadPath . $kk_name)) {
            // File berhasil diunggah
        } else {
            echo "Gagal mengunggah file KK.";
            exit;
        }
    }

    // Persiapkan pernyataan SQL
    $sql = "UPDATE siswa SET nama_siswa = ?, jurusan = ?, nama_orangtua = ?, fotosiswa = ?, ktp = ?, kk = ? WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        // Mengikat parameter dengan aman
        mysqli_stmt_bind_param($stmt, "ssssssi", $nama_siswa, $jurusan, $nama_orang_tua, $fotosiswa_name, $ktp_name, $kk_name, $id);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            // Redirect setelah berhasil
            header("Location: data.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
