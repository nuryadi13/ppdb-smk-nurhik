<?php
// Periksa metode request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $judul = $_POST["judul"];
    $deskripsi = $_POST["deskripsi"];

    // Proses unggahan gambar
    if (isset($_FILES["gambar"])) {
        $file_name = $_FILES["gambar"]["name"];
        $file_tmp = $_FILES["gambar"]["tmp_name"];
        $file_size = $_FILES["gambar"]["size"];
        $file_error = $_FILES["gambar"]["error"];
        
        // Validasi file jika diperlukan
        if ($file_error === 0) {
            $file_destination = "img-kegiatan/" . basename($file_name); // Gunakan basename untuk keamanan
            $move_success = move_uploaded_file($file_tmp, $file_destination); // Simpan file yang diunggah
            
            if ($move_success) {
                // Koneksi ke database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ppdb-nurhik";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Query untuk menyimpan data card dan nama file gambar
                $sql = "INSERT INTO kegiatan (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$file_destination')";

                if ($conn->query($sql) === TRUE) {
    // Jika data berhasil disimpan, tampilkan konfirmasi dan pengalihan berdasarkan pilihan pengguna
    echo "<script>
            if (confirm('Berhasil simpan data. Klik OK untuk kembali, atau Cancel untuk pindah ke halaman admin.')) {
                // Jika pengguna memilih OK
                window.location.href = 'card.php'; // Tetap di halaman
            } else {
                // Jika pengguna memilih Cancel
                window.location.href = 'card.php'; // Pindah ke halaman admin
            }
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


                $conn->close();
            } else {
                echo "Terjadi kesalahan saat memindahkan file";
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah file";
        }
    }
}
?>
