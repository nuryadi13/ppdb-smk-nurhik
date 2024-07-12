<?php
// Mulai sesi
session_start();

// Hapus semua variabel sesi
$_SESSION = array();

// Jika ingin menghapus sesi juga (bukan hanya data sesi), hapus juga cookie sesi
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Akhir sesi
session_destroy();

// Redirect ke halaman login_siswa.php
header("Location: login_siswa.php");
exit;
?>
