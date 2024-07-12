<?php
// Mulai sesi
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID siswa tidak ditemukan.");
}


// Ambil ID siswa dari sesi

// Koneksi ke database
include('../pejabat/koneksi.php');

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data siswa berdasarkan ID yang login
$sql = "SELECT * FROM siswa WHERE id= ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Profil Siswa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-header {
            background-color: #6c757d;
            color: #fff;
        }
        .card-body {
            background-color: #dee2e6;
        }
        .table th, .table td {
            background-color: #ced4da;
        }
        .img-caption {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
            color: #495057;
        }
    </style>
</head>
<body>
    <h1 class="text-center" style="font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Profil Siswa</h1>
    <div class="container mt-5">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $row["nama_siswa"]; ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Username</th>
                                        <td><?php echo $row["username"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $row["email"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jurusan</th>
                                        <td><?php echo $row["jurusan"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Asal Sekolah</th>
                                        <td><?php echo $row["asal_sekolah"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td><?php echo $row["jenis_kelamin"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td><?php echo $row["tempat_lahir"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td><?php echo $row["tanggal_lahir"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Lengkap</th>
                                        <td><?php echo $row["alamat_lengkap"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor HP Siswa</th>
                                        <td><?php echo $row["no_hp_siswa"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor HP Orangtua</th>
                                        <td><?php echo $row["no_hp_orangtua"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Ukuran Baju</th>
                                        <td><?php echo $row["ukuran_baju"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Edit Profile</th>
                                        <td><a href="edit_profile.php?id=<?php echo $row['id']; ?> class="btn btn-warning">Edit</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div class='alert alert-warning'>Tidak ada data yang ditemukan.</div>";
        }

        // Tutup statement dan koneksi
        $stmt->close();
        $koneksi->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
