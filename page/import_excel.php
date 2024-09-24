<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

// Koneksi ke database
include '../config/koneksi.php';

// Include PhpSpreadsheet
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file_excel'])) {
    $file_excel = $_FILES['file_excel']['tmp_name'];

    // Load file excel menggunakan PhpSpreadsheet
    $spreadsheet = IOFactory::load($file_excel);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    // Looping melalui setiap baris data
    foreach ($data as $index => $row) {
        if ($index == 0) {
            // Lewati baris pertama (header)
            continue;
        }

        $nomor_tps = mysqli_real_escape_string($conn, $row[0]);
        $nama_pemilih = mysqli_real_escape_string($conn, $row[1]);
        $nik = mysqli_real_escape_string($conn, $row[2]);
        $alamat = mysqli_real_escape_string($conn, $row[3]);
        $status_pemilih = mysqli_real_escape_string($conn, $row[4]);

        // Cek apakah NIK sudah terdaftar di database
        $check_query = "SELECT * FROM daftar_pemilih_tetap WHERE nik = '$nik'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) == 0) {
            // Query untuk insert data DPT baru
            $insert_query = "INSERT INTO daftar_pemilih_tetap (nomor_tps, nama_pemilih, nik, alamat, status_pemilih) 
                             VALUES ('$nomor_tps', '$nama_pemilih', '$nik', '$alamat', '$status_pemilih')";
            mysqli_query($conn, $insert_query);
        }
    }

    // Redirect ke halaman data_dpt.php dengan pesan sukses
    header("Location: data_dpt.php?status=success");
} else {
    header("Location: tambah_dpt.php?status=error");
}
?>
