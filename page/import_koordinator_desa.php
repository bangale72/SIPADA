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

        $nama_desa = mysqli_real_escape_string($conn, $row[0]);
        $nama_koordinator = mysqli_real_escape_string($conn, $row[1]);
        $kontak = mysqli_real_escape_string($conn, $row[2]);
        $alamat = mysqli_real_escape_string($conn, $row[3]);

        // Cek apakah kontak sudah terdaftar di database
        $check_query = "SELECT * FROM koordinator_desa WHERE kontak = '$kontak'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) == 0) {
            // Query untuk insert data DPT baru
            $insert_query = "INSERT INTO koordinator_desa (nama_desa, nama_koordinator, kontak, alamat) 
                             VALUES ('$nama_desa', '$nama_koordinator', '$kontak', '$alamat')";
            mysqli_query($conn, $insert_query);
        }
    }

    // Redirect ke halaman data_dpt.php dengan pesan sukses
    header("Location: data_koordinator_desa.php?status=success");
} else {
    header("Location: tambah_koordinator_desa.php?status=error");
}
?>
