<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Lupa Password</h2>
        <form id="verificationForm" method="POST" action="verifikasi.php">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Verifikasi</button>
        </form>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Ganti Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm" method="POST" action="ganti_password.php">
                        <div class="form-group">
                            <label for="newPassword">Password Baru:</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <input type="hidden" id="hiddenEmail" name="email">
                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#verificationForm').submit(function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();

                $.post('verifikasi.php', {name: name, email: email}, function(response) {
                    if (response === "success") {
                        $('#hiddenEmail').val(email);
                        $('#changePasswordModal').modal('show');
                    } else {
                        alert('Data tidak sesuai');
                    }
                });
            });
        });
    </script>
</body>
</html>
