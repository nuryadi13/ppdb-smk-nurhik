<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            margin-top: 10%;
        }
        .login-form-1 {
            padding: 5%;
            box-shadow: 0px 0px 15px 0px #000;
            background: #ffffff;
        }
        .login-form-1 h3 {
            text-align: center;
            margin-bottom: 12%;
            color: #333;
        }
        .btnSubmit {
            width: 100%;
            border-radius: 1.5rem;
            padding: 1.5%;
            border: none;
            cursor: pointer;
        }
        .login-form-1 .btnSubmit {
            font-weight: 600;
            color: #fff;
            background-color: #0062cc;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-form-1">
                <h3>Login</h3>
                <form action="proses_login.php" method="post">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login" />
                    </div>
                    <div class="form-group">
                        <a href="lupapassword.php" class="ForgetPwd">Forget Password?</a>
                        <br>
                        <a href="../../index.php" style="color: green;">kembali ke halaman utama</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
