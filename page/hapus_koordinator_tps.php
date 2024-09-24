<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

// Koneksi ke database
include '../config/koneksi.php';

// Dapatkan ID dan hapus data berdasarkan ID
$id = $_GET['id'];
$query = "DELETE FROM koordinator_tps WHERE id = '$id'";

if (mysqli_query($conn, $query)) {
    header("Location: data_koordinator_tps.php?status=deleted");
} else {
    echo "Gagal menghapus data.";
}
?>
