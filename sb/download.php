<?php
if (isset($_GET['files'])) {
    $files = unserialize(urldecode($_GET['files']));
    
    // Membuat daftar gambar dengan label berdasarkan bagian pada tabel
    echo '<h1>Pilih gambar untuk diunduh:</h1>';
    echo '<ul>';
    echo '<li><a href="download.php?file=' . urlencode($files[0]) . '">Foto Siswa</a></li>';
    echo '<li><a href="download.php?file=' . urlencode($files[1]) . '">KTP</a></li>';
    echo '<li><a href="download.php?file=' . urlencode($files[2]) . '">KK</a></li>';
    echo '</ul>';
} elseif (isset($_GET['file'])) {
    $file = '../siswa/data/' . urldecode($_GET['file']);
    if (file_exists($file)) {
        $label = '';
        
        // Menentukan label berdasarkan bagian gambar yang diunduh
        if (strpos($file, 'fotosiswa') !== false) {
            $label = 'Foto Siswa';
        } elseif (strpos($file, 'ktp') !== false) {
            $label = 'KTP';
        } elseif (strpos($file, 'kk') !== false) {
            $label = 'KK';
        }
        
        // Header untuk menentukan nama file yang akan diunduh
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $label . '-' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        echo 'File tidak ditemukan.';
    }
}
?>
