<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Exam with Questions</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">BUAT UJIAN</h1>
        <form id="create_exam_form" action="proses_admin.php" method="POST">
            <div class="form-group">
                <label for="nama_ujian">Nama Ujian:</label>
                <input type="text" class="form-control" id="nama_ujian" name="nama_ujian" required>
            </div>
            <div class="form-group">
                <label for="jumlah_soal">Jumlah Soal:</label>
                <input type="number" class="form-control" id="jumlah_soal" name="jumlah_soal" required>
            </div>
            <div class="form-group">
                <label for="durasi">Durasi (menit):</label>
                <input type="number" class="form-control" id="durasi" name="durasi" required>
            </div>
            <div class="form-group">
                <label for="nilai_minimum">Minimum Nilai:</label>
                <input type="number" class="form-control" id="nilai_minimum" name="nilai_minimum" required>
            </div>
            
            <!-- Container untuk daftar pertanyaan -->
            <div id="questions_container">
                <!-- Pertanyaan akan ditambahkan di sini secara dinamis -->
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-success" id="add_question_btn">Tambah Pertanyaan</button>
        </form>
    </div>

    <script>
$(document).ready(function() {
    // Menambahkan pertanyaan secara dinamis sesuai dengan jumlah soal yang diinginkan
    $('#add_question_btn').click(function() {
        var jumlah_soal = $('#jumlah_soal').val();
        var questions_html = '';

        for (var i = 1; i <= jumlah_soal; i++) {
            questions_html += '<div class="card mb-3">';
            questions_html += '<div class="card-body">';
            questions_html += '<h5 class="card-title">Question ' + i + '</h5>';
            questions_html += '<div class="form-group">';
            questions_html += '<label for="pertanyaan' + i + '">Pertanyaan:</label>';
            questions_html += '<input type="text" class="form-control" id="pertanyaan' + i + '" name="pertanyaan' + i + '" required>';
            questions_html += '</div>';
            questions_html += '<div class="form-group">';
            questions_html += '<label for="jawaban_a' + i + '">Jawaban A:</label>';
            questions_html += '<input type="text" class="form-control" id="jawaban_a' + i + '" name="jawaban_a' + i + '" required>';
            questions_html += '</div>';
            questions_html += '<div class="form-group">';
            questions_html += '<label for="jawaban_b' + i + '">Jawaban B:</label>';
            questions_html += '<input type="text" class="form-control" id="jawaban_b' + i + '" name="jawaban_b' + i + '" required>';
            questions_html += '</div>';
            questions_html += '<div class="form-group">';
            questions_html += '<label for="jawaban_c' + i + '">Jawaban C:</label>';
            questions_html += '<input type="text" class="form-control" id="jawaban_c' + i + '" name="jawaban_c' + i + '" required>';
            questions_html += '</div>';
            questions_html += '<div class="form-group">';
            questions_html += '<label for="jawaban_d' + i + '">Jawaban D:</label>';
            questions_html += '<input type="text" class="form-control" id="jawaban_d' + i + '" name="jawaban_d' + i + '" required>';
            questions_html += '</div>';
            questions_html += '<div class="form-group">';
            questions_html += '<label for="jawaban_benar' + i + '">Jawaban Benar:</label>';
            questions_html += '<select class="form-control" id="jawaban_benar' + i + '" name="jawaban_benar' + i + '" required>';
            questions_html += '<option value="A">A</option>';
            questions_html += '<option value="B">B</option>';
            questions_html += '<option value="C">C</option>';
            questions_html += '<option value="D">D</option>';
            questions_html += '</select>';
            questions_html += '</div>';
            questions_html += '</div>';
            questions_html += '</div>';
        }

        $('#questions_container').html(questions_html);
    });

    // Validasi sebelum mengirimkan formulir
    $('#create_exam_form').submit(function(e) {
        var jumlah_soal = $('#jumlah_soal').val();
        var jumlah_pertanyaan = $('[id^=pertanyaan]').length;

        if (jumlah_pertanyaan < jumlah_soal) {
            alert('Tolong isi dulu semua pertanyaan.');
            e.preventDefault(); // Menghentikan pengiriman formulir jika validasi gagal
        }
    });
});
</script>

</body>
</html>
