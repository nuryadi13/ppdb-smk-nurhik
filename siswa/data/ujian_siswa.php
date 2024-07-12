<?php
session_start();

// Cek jika tidak ada session 'nisn', redirect ke halaman login
if (!isset($_SESSION['nisn'])) {
    header("Location: login.php");
    exit();
}

$nisn = $_SESSION['nisn'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_ujian = $_POST['id_ujian'];
    $nisn = $_POST['nisn'];
    $jawaban_siswa = $_POST['jawaban'];

    // Koneksi ke database (sesuaikan dengan konfigurasi Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ppdb-nurhik";

    $koneksi = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Ambil jawaban benar dan nilai minimum
    $query_pertanyaan = "SELECT id_pertanyaan, jawaban_benar FROM pertanyaan WHERE id_ujian = $id_ujian";
    $result_pertanyaan = mysqli_query($koneksi, $query_pertanyaan);

    $jumlah_pertanyaan = mysqli_num_rows($result_pertanyaan);
    $jawaban_benar = 0;

    while ($row = mysqli_fetch_assoc($result_pertanyaan)) {
        $id_pertanyaan = $row['id_pertanyaan'];
        $jawaban_benar_pertanyaan = $row['jawaban_benar'];

        if (isset($jawaban_siswa[$id_pertanyaan]) && $jawaban_siswa[$id_pertanyaan] == $jawaban_benar_pertanyaan) {
            $jawaban_benar++;
        }
    }

    // Hitung nilai
    $nilai = ($jawaban_benar / $jumlah_pertanyaan) * 100;

    // Ambil nilai minimum
    $query_ujian = "SELECT nilai_minimum FROM ujian WHERE id_ujian = $id_ujian";
    $result_ujian = mysqli_query($koneksi, $query_ujian);
    $ujian = mysqli_fetch_assoc($result_ujian);
    $nilai_minimum = $ujian['nilai_minimum'];

    // Tentukan kelulusan
    $lulus = $nilai >= $nilai_minimum ? "lulus" : "belum lulus";

    // Simpan hasil ujian ke database
    $query_simpan = "INSERT INTO hasil_ujian (nisn, id_ujian, nilai, lulus) VALUES ('$nisn', '$id_ujian', '$nilai', '$lulus')";
    if (mysqli_query($koneksi, $query_simpan)) {
        echo json_encode(['lulus' => $lulus]);
    } else {
        echo json_encode(['lulus' => "error"]);
    }

    $koneksi->close();
}
?>

<!-- Halaman HTML untuk mengerjakan ujian -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mengerjakan Ujian</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Mengerjakan Ujian</h2>
        <div id="exam_timer" class="alert alert-info"></div>

        <form id="exam_form" action="ujian_siswa.php" method="POST">
            <?php
            // Skrip PHP untuk mengambil informasi ujian dan pertanyaan
            if (isset($_GET['id_ujian']) && !empty($_GET['id_ujian'])) {
                $id_ujian = $_GET['id_ujian'];
                echo '<input type="hidden" name="id_ujian" value="' . $id_ujian . '">';
                echo '<input type="hidden" name="nisn" value="' . $nisn . '">'; // Ambil NISN dari sesi

                // Koneksi ke database (sesuaikan dengan konfigurasi Anda)
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
                        echo '<label><strong>Pertanyaan :</strong> ' . $row['pertanyaan'] . '</label><br>';
                        echo '<input type="hidden" name="jawaban[' . $row['id_pertanyaan'] . ']" value="' . $row['jawaban_benar'] . '">'; // Simpan jawaban benar untuk validasi di PHP
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

                $koneksi->close();
            } else {
                echo "ID Ujian tidak ditemukan.";
                exit;
            }
            ?>
            <button type="submit" class="btn btn-primary" id="submit_button">Submit</button>
        </form>
    </div>

    <script>
        // Function to start countdown timer
        function startTimer(duration) {
            var durasi = duration; // Durasi dalam detik
            var timer = setInterval(function() {
                var minutes = Math.floor(durasi / 60);
                var seconds = durasi % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;
                document.getElementById('exam_timer').innerHTML = minutes + ":" + seconds;
                durasi--;

                if (durasi < 0) {
                    clearInterval(timer);
                    finishExam(); // Panggil fungsi finishExam() jika waktu habis
                }
            }, 1000);
        }

        // Panggil startTimer setelah halaman dimuat
        startTimer(<?php echo isset($durasi_ujian) ? $durasi_ujian : 0; ?>);

        // Function to show result modal
        function showResultModal(lulus) {
            var message = lulus === "lulus" ? 'Selamat! Anda lulus ujian.' : 'Maaf, Anda belum lulus ujian.';
            Swal.fire({
                title: 'Hasil Ujian',
                text: message,
                icon: lulus === "lulus" ? 'success' : 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php'; // Redirect ke halaman setelah modal ditutup
                }
            });
        }

        // Function to finish exam
        function finishExam() {
            document.getElementById('submit_button').disabled = true; // Disable tombol submit
            document.getElementById('exam_form').submit(); // Submit form

            // AJAX untuk menyimpan hasil ujian dan menampilkan modal
            $.ajax({
                type: 'POST',
                url: 'ujian_siswa.php',
                data: $('#exam_form').serialize(),
                success: function(response) {
                    var result = JSON.parse(response);
                    showResultModal(result.lulus);
                },
                error: function() {
                    // Tangani error jika terjadi kesalahan
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan saat memproses hasil ujian.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }

        // Event listener untuk submission form
        $('#exam_form').on('submit', function(e) {
            e.preventDefault(); // Mencegah submission form
            finishExam(); // Panggil finishExam saat form disubmit
        });
    </script>
</body>
</html>
