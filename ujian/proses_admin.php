<?php
// Pastikan koneksi ke database sudah dibuat sebelumnya
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ppdb-nurhik";

$koneksi= new mysqli($servername, $username, $password, $dbname);

// Periksa apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form untuk ujian
    $nama_ujian = $_POST['nama_ujian'];
    $jumlah_soal = $_POST['jumlah_soal'];
    $durasi = $_POST['durasi'];
    $nilai_minimum = $_POST['nilai_minimum'];

    // Query untuk menyimpan data ujian ke dalam tabel ujian
    $query_ujian = "INSERT INTO ujian (nama_ujian, jumlah_soal, durasi, nilai_minimum) 
                    VALUES ('$nama_ujian', '$jumlah_soal', '$durasi', '$nilai_minimum')";

    if (mysqli_query($koneksi, $query_ujian)) {
        $id_ujian = mysqli_insert_id($koneksi); // Dapatkan ID ujian yang baru saja dimasukkan

        // Query untuk menyimpan pertanyaan-pertanyaan ke dalam tabel pertanyaan
        for ($i = 1; $i <= $jumlah_soal; $i++) {
            $pertanyaan = $_POST["pertanyaan$i"];
            $jawaban_a = $_POST["jawaban_a$i"];
            $jawaban_b = $_POST["jawaban_b$i"];
            $jawaban_c = $_POST["jawaban_c$i"];
            $jawaban_d = $_POST["jawaban_d$i"];
            $jawaban_benar = $_POST["jawaban_benar$i"];

            $query_pertanyaan = "INSERT INTO pertanyaan (id_ujian, pertanyaan, jawaban_a, jawaban_b, jawaban_c, jawaban_d, jawaban_benar) 
                                VALUES ('$id_ujian', '$pertanyaan', '$jawaban_a', '$jawaban_b', '$jawaban_c', '$jawaban_d', '$jawaban_benar')";

            mysqli_query($koneksi, $query_pertanyaan);
        }

        echo "Exam with questions created successfully!";
    } else {
        echo "Error creating exam: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
