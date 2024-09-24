<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

// Koneksi ke database
include '../config/koneksi.php';

// Proses tambah data Koordinator Kecamatan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kecamatan = $_POST['nama_kecamatan'];
    $nama_koordinator = $_POST['nama_koordinator'];
    $kontak = $_POST['kontak'];
    $alamat = $_POST['alamat'];

    // Cek apakah kontak sudah terdaftar di database
    $check_query = "SELECT * FROM koordinator_kecamatan WHERE kontak = '$kontak'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Redirect ke halaman tambah_koordinator_kecamatan.php dengan pesan bahwa kontak sudah terdaftar
        header("Location: tambah_koordinator_kecamatan.php?status=duplicate_kontak");
    } else {
        // Query untuk insert data Koordinator kecamatan baru
        $insert_query = "INSERT INTO koordinator_kecamatan (nama_kecamatan, nama_koordinator, kontak, alamat) 
                        VALUES ('$nama_kecamatan', '$nama_koordinator', '$kontak', '$alamat')";
    
        if (mysqli_query($conn, $insert_query)) {
            // Redirect ke halaman data_koordinator_kecamatan.php dengan pesan sukses
            header("Location: data_koordinator_kecamatan.php?status=success");
        } else {
            // Redirect ke halaman tambah_koordinator_kecamatan.php dengan pesan error
            header("Location: tambah_koordinator_kecamatan.php?status=error");
        }
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-3">
    <h2>Tambah Koordinator kecamatan</h2>

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
        <form action="import_koordinator_kecamatan.php" method="POST" enctype="multipart/form-data">
            <div class="mb-2">
                <label for="file_excel" class="form-label">Upload Files</label>
                <input type="file" class="form-control" id="file_excel" name="file_excel" accept=".xls, .xlsx" required>
            </div>
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
    </div> 

    <div class="card-body">
        <form action="tambah_koordinator_kecamatan.php" method="POST">
            <div class="mb-3">
                <label for="nama_kecamatan" class="form-label">Kecamatan</label>
                <input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan" required>
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
