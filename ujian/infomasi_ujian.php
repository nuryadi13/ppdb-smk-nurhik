<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ppdb-nurhik";

$koneksi = new mysqli($servername, $username, $password, $dbname);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mendapatkan semua informasi ujian
$query_ujian = "SELECT * FROM ujian";
$result_ujian = mysqli_query($koneksi, $query_ujian);

if (!$result_ujian) {
    die("Error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informasi Ujian</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Informasi Ujian</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Ujian</th>
                    <th>Jumlah Soal</th>
                    <th>Durasi (menit)</th>
                    <th>Nilai Minimum</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result_ujian) > 0) {
                    while ($ujian = mysqli_fetch_assoc($result_ujian)) {
                        echo '<tr>';
                        echo '<td>' . $ujian['nama_ujian'] . '</td>';
                        echo '<td>' . $ujian['jumlah_soal'] . '</td>';
                        echo '<td>' . $ujian['durasi'] . '</td>';
                        echo '<td>' . $ujian['nilai_minimum'] . '</td>';
                        echo '<td><a href="ujian_siswa.php?id_ujian=' . $ujian['id_ujian'] . '" class="btn btn-primary">Mulai Ujian</a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">Tidak ada ujian yang tersedia.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Tutup koneksi
mysqli_close($koneksi);
?>
