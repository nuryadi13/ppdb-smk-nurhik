<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center"><a class="mt-5 text-center btn btn-success"><b>Halaman Admin</b></a></h1>
        <!-- Daftar data -->
        <a class="btn btn-primary" href="tambah_Siswa/index.php">Tambah Data</a>
        <table class="table mt-5">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Siswa</th>
                    <th>Nama Orang Tua</th>
                    <th>Foto Siswa</th>
                    <th>KTP</th>
                    <th>KK</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include "../pejabat/koneksi.php";
                // Ambil data dari database
                $query = "SELECT * FROM siswa";
                $result = mysqli_query($koneksi, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nama_siswa'] . "</td>";
                    echo "<td>" . $row['nama_orangtua'] . "</td>";
                    echo "<td><img src='" . $row['fotosiswa'] . "' width='100'></td>";
                    echo "<td><a href='" . $row['ktp'] . "' target='_blank'>Lihat KTP</a></td>";
                    echo "<td><a href='" . $row['kk'] . "' target='_blank'>Lihat KK</a></td>";
                    echo "<td>
                            <a href='edit_data.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='hapus_data.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }

                // Tutup koneksi database
                mysqli_close($koneksi);
                ?>
            </tbody>
        </table>
    </div>

    <!-- Tambahkan Bootstrap JavaScript (JQuery dan Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
