
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5 text-center">Form Pendaftaran Siswa Baru</h2>
        <form method="POST" action="proses/prosesRegister.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" name="alamat">
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password:</label>
                <input type="password" class="form-control" name="confirm_password" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
include 'footer.php';
?>

