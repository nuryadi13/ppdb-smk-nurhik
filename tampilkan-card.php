<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daftar Kegiatan</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card {
      margin-bottom: 15px;
    }
    .card-img-top {
      height: auto; /* Biarkan gambar menyesuaikan tinggi secara otomatis */
      max-height: 200px; /* Batas tinggi maksimal untuk menghindari gambar terlalu besar */
      object-fit: contain; /* Menjaga proporsi gambar tanpa memotong */
    }
    .card-body {
      padding: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Daftar Kegiatan</h2>
    <div class="row">
      <?php
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              // Tambahkan path relatif ke folder 'images' (ganti 'images' dengan nama folder yang sesuai)
              $gambar_path = 'img-kegiatan/' . $row['gambar'];
              echo '
              <div class="col-md-4"> 
                <div class="card"> 
                  <img src="' . $gambar_path . '" class="card-img-top" alt="' . $row['judul'] . '"> 
                  <div class="card-body"> 
                    <h5 class="card-title">' . $row['judul'] . '</h5> 
                    <p class="card-text">' . $row['deskripsi'] . '</p> 
                  </div> 
                </div> 
              </div>';
          }
      } else {
          echo "<p>Tidak ada kegiatan yang ditemukan.</p>";
      }
      ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
