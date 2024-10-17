<?php
// Mulai output buffering
ob_start();

// Periksa apakah sesi sudah dimulai, jika belum, mulai sesi
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set session
$_SESSION['id_pelanggan'] = '';
$_SESSION['kode_pelanggan'] = '';
$_SESSION['nama_pelanggan'] = '';
$_SESSION['foto'] = '';

// Hapus session
unset($_SESSION['id_pelanggan']);
unset($_SESSION['kode_pelanggan']);
unset($_SESSION['nama_pelanggan']);
unset($_SESSION['foto']);
session_unset();
session_destroy();

// Redirect ke index.php
header("Location: ../index.php");
exit();

// Hentikan output buffering dan kirim output
ob_end_flush();
?>
