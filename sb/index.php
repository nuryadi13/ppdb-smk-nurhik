<?php
session_start();

// Periksa apakah sesi username sudah ada
if (!isset($_SESSION['username'])) {
    // Jika tidak ada sesi username, alihkan pengguna ke halaman login
    header('Location: ../login/login.php');
    exit; // Pastikan untuk menghentikan eksekusi kode lebih lanjut
}

$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SMK NURUL HIKMAH</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-xbF02Efqiq/n4Ok5OcQQ6sA3lECE3uZDDBbFCtONlWjYYb66MSAMQ70Og5F5a6IH"
          crossorigin="anonymous">
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <!-- Dark Mode Button -->
  </head>

  <body>
    <!-- Page Wrapper -->
    <div id="wrapper" class="dark-mode">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-text mx-3">Admin SMK Nurhik</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a href="../login/changepw.php" class="btn btn-dark">Change Password</a>
          <a href="../ujian/page_admin.php" class="btn btn-dark">Tambah Ujian</a>
          <a href="../jadwal/jadwal.php" class="btn btn-dark">Tambah Jadwal PPDB</a>
          <a href="../card.php" class="btn btn-dark">Tambah Kegian PPDB</a>
          <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - User Information -->
              <?php
              include '../pejabat/koneksi.php';
              $sql = "SELECT username FROM admin";
              $result = $koneksi->query($sql);

              if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $username = $row['username'];
              } else {
                  $username = "Default Username"; // Set a default username in case there are no results
              }
              ?>

              <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username; ?></span>
                      <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
                  </a>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div>
              <h1 class="text-center" style="color: black; font-family: 'Times New Roman', Times, serif;"><b>Informasi  Data</b></h1>
            </div>
            <!-- tampilan data -->
            <div class="container mt-5">
              <h4 class="text-center"><b>Hallo, &#129303; Berikut Siswa-siswa Keren Yang Mendaftar !!</b></h4><br><br>
              <?php
              // Ambil data dari database
              $host = "localhost";
              $username = "root";
              $password = "";
              $database = "ppdb-nurhik";

              $koneksi = mysqli_connect($host, $username, $password, $database);

              if (!$koneksi) {
                  die("Koneksi ke database gagal: " . mysqli_connect_error());
              }

              $query = "SELECT siswa.*, (
                          SELECT lulus 
                          FROM hasil_ujian 
                          WHERE siswa.nisn = hasil_ujian.nisn 
                          ORDER BY hasil_ujian.id_hasil DESC 
                          LIMIT 1
                        ) AS lulus
                        FROM siswa";
              $result = mysqli_query($koneksi, $query);

              if ($result) {
                // Proses Pencarian
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Ambil data dari database
$query = "SELECT siswa.*, (
            SELECT lulus 
            FROM hasil_ujian 
            WHERE siswa.nisn = hasil_ujian.nisn 
            ORDER BY hasil_ujian.id_hasil DESC 
            LIMIT 1
          ) AS lulus
          FROM siswa";

if (!empty($keyword)) {
    $query .= " WHERE nama_siswa LIKE '%$keyword%' OR nisn LIKE '%$keyword%'";
}

$result = mysqli_query($koneksi, $query);

if ($result) {
    // Tampilkan data sesuai hasil query
} else {
    echo "Gagal mengambil data dari database.";
}
                  ?>
                  <!-- Form Pencarian -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari berdasarkan nama siswa atau NISN" name="keyword">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
        </div>
    </div>
</form>

                  <a class="btn btn-primary" href="../siswa/data/index.php">Tambah Data</a>  <br><br>
                  <div class="table-responsive">
                      <table class="table table-bordered">
                          <thead>
                              <tr class="text-center">
                                  <th>No.</th>
                                  <th>Nama Siswa</th>
                                  <th>NISN</th>
                                  <th>Status Kelulusan</th>
                                  <th>Detail</th>
                                  <th>Action</th>
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
                                      <td><?= htmlspecialchars($row['nisn']) ?></td>
                                      <td><?= htmlspecialchars($row['lulus']) ?></td>
                                      <td><a href="profile_siswa.php?id=<?php echo $row['id']; ?>" style="color: inherit; text-decoration: none;">Lihat <i class="fa fa-user" aria-hidden="true"></i></a></td>
                                      <td>
                                        <a href="download.php?files=<?= urlencode(serialize(array($row['fotosiswa'], $row['ktp'], $row['kk']))) ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i></a>
                                        <a class="btn btn-warning btn-sm" href="edit_profile.php?id=<?= $row['id']; ?>"><i class="fa-solid fa-pen"></i></a>
                                        <a class="btn btn-danger btn-sm" onclick="konfirmasiHapus(<?= $row['id'] ?>)"><i class="fa-solid fa-trash"></i></a>
                                      </td>
                                  </tr>
                                  <?php
                                  $nomor_urut++; // Tambahkan 1 setiap kali loop iterasi
                              }
                              ?>
                          </tbody>
                      </table>
                  </div>

                  <?php
                  mysqli_free_result($result);
              } else {
                  echo "Gagal mengambil data dari database.";
              }
              mysqli_close($koneksi);
              ?>
            </div>
          </div>
        </div>
        <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Yakin ingin logout?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Pilih "Logout" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
              <a class="btn btn-primary" href="../login/logout.php">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Bootstrap core JavaScript-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="js/sb-admin-2.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <!-- Dark Mode Button -->
      <script>
        $(document).ready(function() {
          // Tombol untuk mengubah mode
          $('#darkModeButton').click(function() {
            $('body').toggleClass('dark-mode');
            $('table').toggleClass('table-dark');
          });
        });
      </script>
    </div>
  </body>
</html>
