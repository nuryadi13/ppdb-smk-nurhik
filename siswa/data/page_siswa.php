<?php
session_start();
include('../../pejabat/koneksi.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Setelah proses autentikasi berhasil
if (!isset($_SESSION['id'])) {
    echo "ID pengguna tidak ditemukan dalam sesi.";
    exit();
}

$id = $_SESSION['id']; // Ambil ID pengguna dari sesi

// Query untuk mengambil data siswa
$query = "SELECT fotosiswa, nisn FROM siswa WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Ambil data siswa
    $_SESSION['nisn'] = $row['nisn']; // Menyimpan 'nisn' dalam sesi
} else {
    echo "Data siswa tidak ditemukan.";
    exit();
}

// Query untuk mengambil status kelulusan dari tabel hasil_ujian
$nisn = $row['nisn'];
$query_lulus = "SELECT lulus FROM hasil_ujian WHERE nisn = ? ORDER BY id_hasil DESC LIMIT 1";
$stmt_lulus = $koneksi->prepare($query_lulus);
$stmt_lulus->bind_param("s", $nisn);
$stmt_lulus->execute();
$result_lulus = $stmt_lulus->get_result();

if ($result_lulus->num_rows > 0) {
    $row_lulus = $result_lulus->fetch_assoc();
    $status_kelulusan = $row_lulus['lulus'];
} else {
    $status_kelulusan = "Anda belum mengerjakan ujian";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Siswa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            padding-top: 56px;
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }
        .footer {
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            width: 250px;
            overflow-x: hidden;
            transition: all 0.3s;
            display: none; /* Mulai dengan menyembunyikan sidebar di layar kecil */
        }
        .sidebar.active {
            display: block; /* Tampilkan sidebar ketika aktif */
        }
        .sidebar .nav-link {
            color: #ddd;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
        }
        .main-content {
            margin-left: 0; /* Atur margin kembali ke 0 */
            transition: margin-left 0.3s;
        }
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .navbar {
            background-color: #6c757d;
            padding: 10px;
        }
        .navbar-text {
            flex-grow: 1;
        }
        .navbar img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .status {
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .logout {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="navbar-text ml-auto">
                Selamat Datang, <?php echo $_SESSION['username']; ?>!
            </span>
            <div>
                <img src="<?php echo $row["fotosiswa"]; ?>" alt="Foto Siswa" class="profile-img">
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-md-block sidebar" id="sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column" style="padding-top: 40px;">
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php"><i class="fas fa-user"></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../jadwal/info.php"><i class="fas fa-book"></i> Jadwal Pendaftaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="infomasi_ujian.php"><i class="fas fa-book"></i> Tes Ujian</a>
                        </li>
                    </ul>
                    <div class="logout">
                        <a href="javascript:void(0);" onclick="confirmLogout();" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </nav>

            <main role="main" class="col-md-10 ml-md-auto px-4 main-content">
                <div class="status alert alert-info">
                    <span>Status kelulusan kamu saat ini: <strong><?php echo $status_kelulusan; ?></strong></span>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Informasi Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <p>Selamat datang di portal siswa! Di sini kamu bisa mengakses berbagai informasi penting mengenai akademik, jadwal, dan lainnya.</p>
                    </div>
                </div>
                <!-- Add any other content here -->
            </main>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <span class="text-muted">© SMK NURHIK 2024</span>
        </div>
    </footer>

    <script type="text/javascript">
        function confirmLogout() {
            if (confirm("Apakah Anda yakin ingin logout?")) {
                window.location.href = 'logout.php';
            }
        }

        // Script untuk mengatur perilaku sidebar saat hamburger diklik
        document.addEventListener("DOMContentLoaded", function() {
            var sidebarToggle = document.querySelector('.navbar-toggler');
            var sidebar = document.querySelector('#sidebar');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
