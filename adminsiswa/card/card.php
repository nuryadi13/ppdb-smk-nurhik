<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Tambah Card Baru</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="container">
      <h2>Tambah Card Baru</h2>
      <!-- Pastikan menggunakan enctype="multipart/form-data" -->
      <form action="../../proses_card.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="judul">Judul:</label>
          <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul" required />
        </div>
        <div class="form-group">
          <label for="deskripsi">Deskripsi:</label>
          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi" required></textarea>
        </div>
        <div class="form-group">
          <label for="gambar">Unggah Gambar:</label>
          <input type="file" class="form-control-file" id="gambar" name="gambar" accept="image/*" required />
        </div>
        <button type="submit" class="btn btn-primary">Tambah Card</button>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
