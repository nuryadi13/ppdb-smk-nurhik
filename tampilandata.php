<?php
include "pejabat/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-danger"><< Kembali</a>
        <h4 class="text-center"><b>Hallo, &#129303; Berikut Siswa-siswa Keren Yang Mendaftar !!</b></h4><br><br>
        <?php
        // Ambil data dari database
        $query = "SELECT * FROM siswa";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Nama Siswa</th>
                        <th>Asal Sekolah</th>
                        <th>Jurusan yang dipilih</th>
                        <th>Foto Siswa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor_urut = 1; // Inisialisasi nomor urut
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr class="text-center">
                            <td><?= $nomor_urut ?></td>
                            <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
                            <td><?= htmlspecialchars($row['asal_sekolah']) ?></td>
                            <td><?= htmlspecialchars($row['jurusan']) ?></td>
                            <td><img src="siswa/data/<?= htmlspecialchars($row['fotosiswa']) ?>" alt="Gambar KK" width="100" height="100"></td>
                        </tr>
                        <?php
                        $nomor_urut++; // Tambahkan 1 setiap kali loop iterasi
                    }
                    ?>
                </tbody>
            </table>
            <?php
            mysqli_free_result($result);
        } else {
            echo "Gagal mengambil data dari database.";
        }
        mysqli_close($koneksi);
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
