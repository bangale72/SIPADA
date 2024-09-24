<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

// Koneksi ke database
include '../config/koneksi.php';

// Proses tambah data koordinator TPS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomor_tps = $_POST['nomor_tps'];
    $nama_koordinator = $_POST['nama_koordinator'];
    $kontak = $_POST['kontak'];
    $alamat = $_POST['alamat'];

    // Cek apakah kontak sudah terdaftar di database
    $check_query = "SELECT * FROM koordinator_tps WHERE kontak = '$kontak'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Redirect ke halaman tambah_koordinator_tps.php dengan pesan bahwa kontak sudah terdaftar
        header("Location: tambah_koordinator_tps.php?status=duplicate_kontak");
    } else {
        // Query untuk insert data Koordinator TPS baru
        $insert_query = "INSERT INTO koordinator_tps (nomor_tps, nama_koordinator, kontak, alamat) 
                         VALUES ('$nomor_tps', '$nama_koordinator', '$kontak', '$alamat')";
    
        if (mysqli_query($conn, $insert_query)) {
            // Redirect ke halaman data_koordinator_tps.php dengan pesan sukses
            header("Location: data_koordinator_tps.php?status=success");
        } else {
            // Redirect ke halaman tambah_koordinator_tps.php dengan pesan error
            header("Location: tambah_koordinator_tps.php?status=error");
        }
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-5">
    <h2>Tambah Koordinator TPS</h2>

    <!-- Alert pesan kontak duplikat -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'duplicate_kontak'): ?>
    <div class="alert alert-danger">
        kontak sudah terdaftar! Silakan masukkan kontak yang berbeda.
    </div>
    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
    <div class="alert alert-danger">
        Terjadi kesalahan saat menambahkan data. Silakan coba lagi.
    </div>
    <?php endif; ?>

    <!-- Form untuk upload Excel -->
    <div class="card-body mb-3">
        <form action="import_excel.php" method="POST" enctype="multipart/form-data">
            <div class="mb-2">
                <label for="file_excel" class="form-label">Upload Files</label>
                <input type="file" class="form-control" id="file_excel" name="file_excel" accept=".xls, .xlsx" required>
            </div>
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
    </div>
    <div class="card-body">
        <form action="tambah_koordinator_tps.php" method="POST">
            <div class="mb-3">
                <label for="nomor_tps" class="form-label">Nomor TPS</label>
                <input type="text" class="form-control" id="nomor_tps" name="nomor_tps" required>
            </div>
            <div class="mb-3">
                <label for="nama_koordinator" class="form-label">Nama Koordinator</label>
                <input type="text" class="form-control" id="nama_koordinator" name="nama_koordinator" required>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">Kontak</label>
                <input type="text" class="form-control" id="kontak" name="kontak" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Koordinator</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
