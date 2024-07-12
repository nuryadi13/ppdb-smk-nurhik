<!DOCTYPE html>
<html>
<head>
    <title>Form Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        /* Tambahkan border ke formulir */
        .form-container {
            border: 2px solid #cccccc; /* Border 2px dengan warna abu-abu */
            border-radius: 10px; /* Tambahkan border-radius untuk sudut melengkung */
            padding: 20px; /* Padding dalam formulir */
            background-color: #f9f9f9; /* Latar belakang formulir */
        }
        
        /* Tambahkan animasi saat input mendapat fokus */
        .form-control:focus {
            border-color: #4CAF50; /* Ubah warna border saat fokus */
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.5); /* Tambahkan efek bayangan */
            transition: border-color 0.3s, box-shadow 0.3s; /* Efek transisi */
        }

        /* Animasi untuk tombol saat hover */
        .btn-primary:hover {
            background-color: #3e8e41; /* Warna berubah saat hover */
            transition: background-color 0.3s; /* Transisi perubahan warna */
        }
        .header {
            text-align: center;
            color: white;
            background-color: #333;
            padding: 20px;
        }

        /* Gaya untuk gambar dalam header */
        .header img {
            width: 100px;
            vertical-align: middle;
            margin-right: 10px; /* Jarak antara gambar dan teks */
        }

        /* Gaya untuk teks dalam header */
        .header h1 {
            display: inline; /* Membuat teks dan gambar dalam baris yang sama */
            font-weight: bold;
            font-size: 3em; /* Ukuran font dapat disesuaikan */
        }
    </style>
</head>
<body>
        <div class="header">
        <img style="padding-bottom: 18px;" src="../../img/logo.png" alt="Logo NH">
        <h1>Ayo Daftar Raihlah Impianmu</h1>
    </div>
    <div class="container"><br>
    
        <!-- <a href="../../index.php">&lt;&lt; Kembali</a> -->
        
        <!-- Bagian row untuk gambar dan form -->
        <div class="row">
            
            <!-- Kolom untuk gambar -->
            <div class="col-md-7"> <!-- Ukuran kolom diperbesar -->
                <img src="../../img/register2.png" alt="Foto PAUD Al-Hidayah" class="img-fluid"
                style="padding-top: 20px; height: 600px;"> <!-- Perbesar gambar -->
            </div>

            <!-- Kolom untuk formulir -->
            <div class="col-md-5"> <!-- Ukuran kolom diperkecil -->
                <div class="form-container"> <!-- Tambahkan border ke formulir -->
                    <h2 class="text-center"><b>Daftar</b></h2>
                    <form action="process.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama_siswa">Nama Calon Siswa:</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama*" required>
                        </div>
                        <div class="form-group">
                            <label for="nisn">NISN:</label>
                            <input type="text" class="form-control" maxlength="10" id="nisn" name="nisn" placeholder="NISN*" required>
                        </div>
                        <!-- inputan login -->
                        <div class="username">
                            <label for="username">Buat nama pengguna untuk login</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="pengguna*" required>
                        </div>
                        <div class="password">
                            <label for="password">Buat Password untuk login</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="password*" required>
                        </div>
                        <div class="email">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="email*" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="jurusan">Pilih Jurusan:</label>
                            <select name="jurusan" id="jurusan" class="form-control" required>
                                <option value="Pilih">Pilih*</option>
                                <option value="Akuntansi dan Keuangan Lembaga (AKL)">Akuntansi dan Keuangan Lembaga (AKL)</option>
                                <option value="Manajemen Perkantoran dan Layanan Bisnis (MPLB)">Manajemen Perkantoran dan Layanan Bisnis (MPLB)</option>
                                <option value="Teknik Jaringan Komputer dan Telekomunikasi (TJKT)">Teknik Jaringan Komputer dan Telekomunikasi (TJKT)</option>
                            </select>
                        </div>
                        <!-- asal sekolaj -->
                        <label for="asalSekolah">Asal Sekolah</label><br>
                            <select id="asalSekolah" name="asalSekolah" onchange="checkWilayah(this)" class="form-control" required>
                                <option value="">Pilih sekolah asal*</option>
                                <option value="SMPP NURUL HIKMAH">SMPP NURUL HIKMAH</option>
                                <option value="MTs NURUL HIKMAH">MTs NURUL HIKMAH</option>
                                <option value="SMPN 1 JONGGOL">SMPN 1 JONGGOL</option>
                                <option value="SMPN 2 JONGGOL">SMPN 2 JONGGOL</option>
                                <option value="SMPN 3 JONGGOL">SMPN 3 JONGGOL</option>
                                <option value="MTs JONGGOL">MTs JONGGOL</option>
                                <option value="SMP PGRI JONGGOL">SMP PGRI JONGGOL</option>
                                <option value="SMP PASUNDAN">SMP PASUNDAN</option>
                                <option value="MTs AL-FATMAHIYAH">MTs AL-FATMAHIYAH</option>
                                <option value="MTs LUKMANUL HAKIM">MTs LUKMANUL HAKIM</option>
                                <option value="SMP PGRI GANDOANG">SMP PGRI GANDOANG</option>
                                <option value="SMPN 1 CILEUNGSI">SMPN 1 CILEUNGSI</option>
                                <option value="SMPN 2 CILEUNGSI">SMPN 2 CILEUNGSI</option>
                                <option value="SMPN 4 CILEUNGSI">SMPN 4 CILEUNGSI</option>
                                <option value="MTs QURROTUL AINI CILEUNGSI">MTs QURROTUL AINI CILEUNGSI</option>
                                <option value="Mts HIDAYATUSSALAM">Mts HIDAYATUSSALAM</option>
                                <option value="SMPI BINA TAQWA">SMPI BINA TAQWA</option>
                                <option value="MTs AL-FALAH">MTs AL-FALAH</option>
                                <option value="MTs DARUL ULUM TANJUNG SARI">MTs DARUL ULUM TANJUNG SARI</option>
                                <option value="SMPN Tanjungsari">SMPN Tanjungsari</option>
                                <option value="MTs YASNIFA">MTs YASNIFA</option>
                                <option value="SMPN 1 CARIU">SMPN 1 CARIU</option>
                                <option value="SMPN 1 CIBARUSAH">SMPN 1 CIBARUSAH</option>
                                <option value="SMPN 2 CIBARUSAH">SMPN 2 CIBARUSAH</option>
                                <option value="SMPN 4 CIBARUSAH">SMPN 4 CIBARUSAH</option>
                                <option value="SMPN 5 CIBARUSAH">SMPN 5 CIBARUSAH</option>
                                <option value="MTs Al-BAQIYATUSSHOLIHAT">MTs Al-BAQIYATUSSHOLIHAT</option>
                                <option value="SMPN 1 SUKA MAKMUR">SMPN 1 SUKAMAKMUR</option>
                                <option value="SMPN 2 SUKAMAKMUR">SMPN 2 SUKAMAKMUR</option>
                                <option value="SMP PUTRA MELATI">SMP PUTRA MELATI</option>
                                <option value="SMP MUTIARA KENCANA">SMP MUTIARA KENCANA</option>
                                <option value="SMPS SEJAHTERA 2">SMPS SEJAHTERA 2</option>
                                <option value="SMPI TAMAN QURANIAH">SMPI TAMAN QURANIAH</option>
                                <option value="SMP IT AL-HASANIYYAH">SMP IT AL-HASANIYYAH</option>
                                <option value="SMP BINA CITRA MANDIRI">SMP BINA CITRA MANDIRI</option>
                                <option value="MTS SA ALIKHLAS">MTS SA ALIKHLAS</option>
                                <!-- Tambahkan wilayah lain sesuai kebutuhan -->
                                <option value="other">Lainnya</option>
                            </select><br><br>

                            <div id="asalSekolah_lain" style="display: none;">
                                <label for="asalSekolah_lain">Tuliskan asal sekolah:</label>
                                <input type="text" id="asalSekolah_lain" name="asalSekolah_lain">
                            </div>
                        <!-- end asal sekolaj -->

                        <div class="jenis_kelamin">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                <option value="Pilih">Pilih*</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="tempat lahir*" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                            <input type="text" class="form-control datepicker" id="tanggal_lahir" name="tanggal_lahir" placeholder="tanggal lahir*" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat_lengkap">Alamat Lengkap:</label>
                           <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="4" placeholder="alamat lengkap*" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="no_hp_siswa">No HP Siswa(aktif)</label>
                            <input type="text" id="no_hp_siswa" name="no_hp_siswa" required class="form-control" value="+62">
                        </div>
                        <div class="form-group">
                            <label for="no_hp_orangtua">No HP Orangtua (aktif)</label>
                            <input type="text" id="no_hp_orangtua" name="no_hp_orangtua" required class="form-control" value="+62">
                        </div>
                        <div class="form-group">
                            <label for="ukuran_baju">Ukuran Baju</label>
                            <select name="ukuran_baju" id="ukuran_baju">
                                <option value="pilih">pilih</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                                <option value="XXXL">XXXL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fotosiswa">Unggah Foto Calon Siswa:</label>
                            <input type="file" class="form-control-file" id="fotosiswa" name="fotosiswa" accept=".jpg, .png" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="ktp">Unggah KTP Orang tua/Wali:</label>
                            <input type="file" class="form-control-file" id="ktp" name="ktp" accept=".jpg, .png" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="kk">Unggah Foto KK:</label>
                            <input type="file" class="form-control-file" id="kk" name="kk" accept=".jpg, .png" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                    </form>
                </div> <!-- Akhir div form-container -->
            </div>
        </div> <!-- Akhir dari div row -->
    </div>
    <script>
        function checkWilayah(select) {
            var asalSekolah_lain = document.getElementById('asalSekolah_lain');
            if (select.value === 'other') {
                asalSekolah_lain.style.display = 'block';
            } else {
                asalSekolah_lain.style.display = 'none';
            }
        }
    </script>
    <!-- tanggal lahir -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/i18n/jquery.ui.datepicker-id.min.js"></script>
    <!-- <script>
        $(function() {
            $.datepicker.setDefaults($.datepicker.regional["id"]);
            $("#tanggal_lahir").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script> -->
     <script>
        $(document).ready(function() {
            $.datepicker.setDefaults($.datepicker.regional['id']);
            $(".datepicker").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                regional: "id"
            });
        });

        function checkWilayah(selectElement) {
            if (selectElement.value === "other") {
                document.getElementById("wilayahContainer").style.display = "block";
                document.getElementById("wilayah").setAttribute("required", "true");
            } else {
                document.getElementById("wilayahContainer").style.display = "none";
                document.getElementById("wilayah").removeAttribute("required");
            }
        }
    </script>
    <!-- batas nomor NISN -->
     <script>
    document.getElementById('nisn').addEventListener('input', function (e) {
        var nisn = e.target.value;
        if (nisn.length > 10) {
            e.target.value = nisn.slice(0, 10);
        }
        if (!/^\d*$/.test(nisn)) {
            e.target.value = nisn.replace(/\D/g, '');
        }
    });
</script>
</body>
</html>
