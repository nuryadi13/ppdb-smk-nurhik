<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ppdb-nurhik";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil semua data dari tabel 'kegiatan'
$sql = "SELECT id, judul, deskripsi, gambar FROM kegiatan";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
      .video-background {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: -1;
          overflow: hidden;
      }

      .video-background video {
          min-width: 100%;
          min-height: 100%;
          width: auto;
          height: auto;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          z-index: -1;
      }

      .card {
          margin-bottom: 15px;
      }
      .card-img-top {
          height: auto;
          max-height: 200px;
          object-fit: contain;
      }
      .card-body {
          padding: 10px;
      }

      body {
          padding-top: 10px;
          background-color: gray;
          font-family: 'Times New Roman', Times, serif;
      }

      .header {
          text-align: center;
          color: white;
          padding: 20px;
      }

      .header img {
          width: 100px;
          vertical-align: middle;
          margin-right: 10px;
      }

      .header h1 {
          display: inline;
          font-weight: bold;
          font-size: 3em;
      }

      @media (max-width: 768px) {
          .header h1 {
              font-size: 2em;
          }

          .card {
              margin-bottom: 10px;
          }

          .card-body {
              padding: 5px;
          }
      }

      @media (max-width: 576px) {
          .header h1 {
              font-size: 1.5em;
          }

          .header img {
              width: 50px;
          }
      }

      .container img {
              width: 100%;
              padding-left: 0;
              padding-bottom: 20px;
              border-radius: 20px;
      }

      @media only screen and (max-width: 768px) {
          .container img {
              width: 100%;
              padding-left: 0;
              padding-bottom: 20px;
              border-radius: 20px;
          }
      }

      @media only screen and (max-width: 480px) {
        .container b {
          text-align: center;
          font-size: small;
        }
          .container img {
              width: 100%;
              padding-left: 0;
              padding-bottom: 10px;
              border-radius: 15px;
          }
      }

      @media only screen and (max-width: 480px) {
         .carousel-container img {
            width: 100%;
            height: auto;
            padding-right: 20px;
        }
      }

      footer {
          padding: 10px;
          background-color: #333;
          color: white;
          position: fixed;
          bottom: 0;
          width: 100%;
      }
    </style>
</head>
<body>
  <div class="video-background">
        <video autoplay muted loop>
            <source src="img-kegiatan/bg-video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
  </div>
  <div class="backgroundgunung">
    <div class="header">
        <img style="padding-bottom: 18px;" src="img/logo.png" alt="Logo NH">
        <h1>SISTEM PPDB SMK NURUL HIKMAH</h1>
    </div>
    <br><br> 
    <div class="carousel-container element">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/profil-nh.jpg" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/ws.png" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/profil-nh.jpg" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <br><br>
    <h3 class="text-center" style="color: white;">&nbsp;&nbsp;Daftar Sekarang
        <a class="nav-link active btn btn-primary" style="color: white; display: inline-block; padding-top: 2px; padding-bottom: 2px; background-color: blue;" aria-current="page" href="./siswa/data/index.php">Daftar</a>
    </h3>
    <h3 class="text-center" style="color: white;">&nbsp;&nbsp;Sudah Punya Akun?
        <a class="nav-link active btn btn-success" style="color: white; display: inline-block; padding-top: 2px; padding-bottom: 2px; background-color: green;" aria-current="page" href="./siswa/data/login_siswa.php">Login</a>
    </h3>
    <br><br>
    <!-- <h6 class="text-center" style="color:white">Lihat siapa saja yang sudah daftar !!   <a class="btn btn-danger" href="tampilandata.php" style="display: inline;">Lihat</a></h6> -->
    <br><br>
    <div data-aos="zoom-in-down">
        <div class="container">
            <h5 style="font-family: arial; text-align:center; color:white"><b> ------------------- Kegiatan ------------------ </b></h5>
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    $delay = 0;
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <div class="col-4 col-sm-4 col-md-4 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="' . $delay . '">
                            <div class="card">
                                <img src="' . $row['gambar'] . '" class="card-img-top" alt="' . $row['judul'] . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['judul'] . '</h5>
                                    <p class="card-text">' . $row['deskripsi'] . '</p>
                                </div>
                            </div>
                        </div>';
                        $delay += 100;
                    }
                } else {
                    echo "<p>Tidak ada kegiatan yang ditemukan.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div>
          <h5 style="font-family: arial; text-align:center; color:white"><b>------------------- Biaya Pendaftaran ------------------ </b> </h5>
          <img src="img-kegiatan/biaya.png" class="bg-jadwal" alt="biaya">
        </div>
        <div>
          <h5 style="font-family: arial; text-align:center; color:white"><b>------------------- Jadwal PPDB ------------------ </b> </h5>
          <img src="img-kegiatan/jadwal ppdb.png" class="bg-jadwal" alt="biaya">
        </div><br><br><br>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<footer class="text-center">Allright Reserved By Yadi &hearts;</footer>
<script>
  AOS.init();
</script>
</body>
</html>
