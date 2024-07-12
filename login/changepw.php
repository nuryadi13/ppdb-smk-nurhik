<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: gray;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        .form-field {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-field label {
            display: block;
            margin-bottom: 5px;
        }
        .form-field input {
            width: 90%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-field input:focus {
            border-color: #009578;
        }
        .submit-button {
            background-color: #009578;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .submit-button:hover {
            background-color: #007b63;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Ubah Password</h2>
        <form method="post" action="process_changepw.php">
            <div class="form-field">
                <label for="password_lama">Password Lama:</label>
                <input type="password" name="password_lama" id="password_lama" required>
            </div>
            <div class="form-field">
                <label for="password_baru">Password Baru:</label>
                <input type="password" name="password_baru" id="password_baru" required>
            </div>
            <div class="form-field">
                <label for="konfirmasi_password">Konfirmasi Password Baru:</label>
                <input type="password" name="konfirmasi_password" id="konfirmasi_password" required>
            </div>
            <input type="submit" class="submit-button" value="Ubah Password">
        </form>
    </div>
</body>
</html>
