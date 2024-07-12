<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4" style="mt-4"><br><br>
                <h3>Welcome Please Register!!</h3>
                <form method="POST" action="proses_register.php">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" placeholder="masukkan username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" placeholder="masukkan password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>