<!DOCTYPE html>
<html>
<head>
    <title>Form Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container"><br>
        <a href="../index.php" class="btn btn-danger"><< Kembali</a>
        <h2 class="text-center"><b>Pendaftaran Siswa PAUD Al-Hidayah</b></h2>
        <form action="process.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_siswa">Nama Siswa:</label>
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
            </div>
           <div class="form-group">
    <label for="kelas">Pilih Kelas:</label>
    <select name="kelas" id="kelas">
        <option value="Pilih">Pilih</option>
        <option value="A">Kelas A</option>
        <option value="B">Kelas B</option>
    </select><br>
</div>

            <div class="form-group">
                <label for="nama_orangtua">Nama Orang Tua:</label>
                <input type="text" class="form-control" id="nama_orangtua" name="nama_orangtua" required>
            </div>
            <div class="form-group">
                <label for="fotosiswa">Unggah Foto Siswa :</label>
                <input type="file" class="form-control-file" id="fotosiswa" name="fotosiswa" accept=".jpg, .png" required>
            </div>
            <div class="form-group">
                <label for="ktp">Unggah KTP Anda :</label>
                <input type="file" class="form-control-file" id="ktp" name="ktp" accept=".jpg, .png" required>
            </div>
            <div class="form-group">
                <label for="kk">Unggah Foto KK:</label>
                <input type="file" class="form-control-file" id="kk" name="kk" accept=".jpg, .png" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
