<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            margin-top: 100px;
        }
        .card {
            background-color: #f8f9fa; /* Warna abu pada card */
            border: 2px;
        }
        .card-title {
            color: #333; /* Warna teks judul card */
        }
        .form-group label {
            color: #333; /* Warna teks label form */
        }
        .btn-success {
            background-color: #28a745; /* Warna latar belakang tombol Login */
            border-color: #28a745; /* Warna border tombol Login */
        }
        .btn-success:hover {
            background-color: #218838; /* Warna latar belakang tombol Login saat dihover */
            border-color: #1e7e34; /* Warna border tombol Login saat dihover */
        }
        .btn-primary {
            background-color: #007bff; /* Warna latar belakang tombol Daftar */
            border-color: #007bff; /* Warna border tombol Daftar */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Warna latar belakang tombol Daftar saat dihover */
            border-color: #0056b3; /* Warna border tombol Daftar saat dihover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <!-- Kolom untuk gambar -->
            <div class="col-md-6">
                <img src="../img/login-kartun.png" width="500px" alt="Gambar Login" class="img-fluid rounded"> 
                <!-- Pastikan menggunakan gambar yang valid atau sesuaikan URL dengan gambar Anda -->
            </div>
            <!-- Kolom untuk form -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center" style="font-family:'Times New Roman', Times, serif"><b>Hallo Admin</b></h2>
                        <form method="POST" action="proses.php">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" name="username" placeholder="masukkan username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" placeholder="masukkan password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-sm">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
