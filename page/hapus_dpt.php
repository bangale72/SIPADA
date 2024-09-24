<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

// Koneksi ke database
include '../config/koneksi.php';

// Dapatkan ID dan hapus data berdasarkan ID
$id = $_GET['id'];
$query = "DELETE FROM daftar_pemilih_tetap WHERE id = '$id'";

if (mysqli_query($conn, $query)) {
    header("Location: data_dpt.php?status=deleted");
} else {
    echo "Gagal menghapus data.";
}
?>
