<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mengerjakan Ujian</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Mengerjakan Ujian</h2>
        <div id="exam_timer" class="alert alert-info"></div>

        <form id="exam_form" action="ujian_siswa.php" method="POST">
            <?php
            if (isset($_GET['id_ujian']) && !empty($_GET['id_ujian'])) {
                $id_ujian = $_GET['id_ujian'];
                echo '<input type="hidden" name="id_ujian" value="' . $id_ujian . '">';
                echo '<input type="hidden" name="nisn" value="1234567890">'; // Sesuaikan dengan NISN siswa yang sedang login

                // Koneksi ke database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ppdb-nurhik";

                $koneksi = new mysqli($servername, $username, $password, $dbname);

                if ($koneksi->connect_error) {
                    die("Koneksi gagal: " . $koneksi->connect_error);
                }

                // Dapatkan informasi ujian
                $query_ujian = "SELECT * FROM ujian WHERE id_ujian = $id_ujian";
                $result_ujian = mysqli_query($koneksi, $query_ujian);

                if (mysqli_num_rows($result_ujian) > 0) {
                    $ujian = mysqli_fetch_assoc($result_ujian);

                    // Hitung durasi ujian dalam detik
                    $durasi_ujian = $ujian['durasi'] * 60; // Convert to seconds

                    // Query untuk mendapatkan pertanyaan ujian
                    $query_pertanyaan = "SELECT * FROM pertanyaan WHERE id_ujian = $id_ujian";
                    $result_pertanyaan = mysqli_query($koneksi, $query_pertanyaan);

                    // Tampilkan pertanyaan-pertanyaan
                    while ($row = mysqli_fetch_assoc($result_pertanyaan)) {
                        echo '<div class="form-group">';
                        echo '<label>' . '<strong>Pertanyaan : </strong>' . $row['pertanyaan'] . '</label>';
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="radio" name="jawaban[' . $row['id_pertanyaan'] . ']" value="A" required>';
                        echo '<label class="form-check-label">' . $row['jawaban_a'] . '</label>';
                        echo '</div>';
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="radio" name="jawaban[' . $row['id_pertanyaan'] . ']" value="B">';
                        echo '<label class="form-check-label">' . $row['jawaban_b'] . '</label>';
                        echo '</div>';
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="radio" name="jawaban[' . $row['id_pertanyaan'] . ']" value="C">';
                        echo '<label class="form-check-label">' . $row['jawaban_c'] . '</label>';
                        echo '</div>';
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="radio" name="jawaban[' . $row['id_pertanyaan'] . ']" value="D">';
                        echo '<label class="form-check-label">' . $row['jawaban_d'] . '</label>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "Ujian tidak ditemukan.";
                }
            } else {
                echo "ID Ujian tidak ditemukan.";
                exit;
            }
            ?>
            <button type="submit" class="btn btn-primary" id="submit_button">Submit</button>
        </form>
    </div>

    <script>
        // Fungsi untuk menghitung mundur waktu ujian
        function startTimer(duration) {
            var durasi = duration; // Durasi sudah dalam detik
            var timer = setInterval(function() {
                var minutes = Math.floor(durasi / 60);
                var seconds = durasi % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;
                document.getElementById('exam_timer').innerHTML = minutes + ":" + seconds;
                durasi--;

                if (durasi < 0) {
                    clearInterval(timer);
                    finishExam();
                }
            }, 1000);
        }

        // Panggil fungsi startTimer setelah halaman dimuat
        startTimer(<?php echo isset($durasi_ujian) ? $durasi_ujian : 0; ?>);

        // Fungsi untuk menampilkan modal hasil ujian
        function showResultModal(lulus) {
            var message = lulus ? 'Selamat! Anda lulus ujian.' : 'Maaf, Anda belum lulus ujian.';
            Swal.fire({
                title: 'Hasil Ujian',
                text: message,
                icon: lulus ? 'success' : 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to another page or do something else
                    window.location.href = 'index.php'; // Change this URL as needed
                }
            });
        }

        // Fungsi untuk menyelesaikan ujian
        function finishExam() {
            document.getElementById('submit_button').disabled = true; // Disable submit button
            document.getElementById('exam_form').submit(); // Submit the form

            // Simulasi pengiriman nilai ke database (gunakan AJAX di save_exam.php)
            $.ajax({
                type: 'POST',
                url: 'save_exam.php',
                data: $('#exam_form').serialize(),
                success: function(response) {
                    var result = JSON.parse(response);
                    showResultModal(result.lulus);
                }
            });
        }

        // Event listener untuk submit form ujian
        $('#exam_form').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission
            finishExam();
        });
    </script>
</body>
</html>
