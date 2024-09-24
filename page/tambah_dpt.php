<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

// Koneksi ke database
include '../config/koneksi.php';

// Proses tambah data DPT
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomor_tps = $_POST['nomor_tps'];
    $nama_pemilih = $_POST['nama_pemilih'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $status_pemilih = $_POST['status_pemilih'];

    // Cek apakah NIK sudah terdaftar di database
    $check_query = "SELECT * FROM daftar_pemilih_tetap WHERE nik = '$nik'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Redirect ke halaman tambah_dpt.php dengan pesan bahwa NIK sudah terdaftar
        header("Location: tambah_dpt.php?status=duplicate_nik");
    } else {
        // Query untuk insert data DPT baru
        $insert_query = "INSERT INTO daftar_pemilih_tetap (nomor_tps, nama_pemilih, nik, alamat, status_pemilih) 
                         VALUES ('$nomor_tps', '$nama_pemilih', '$nik', '$alamat', '$status_pemilih')";
    
        if (mysqli_query($conn, $insert_query)) {
            // Redirect ke halaman data_dpt.php dengan pesan sukses
            header("Location: data_dpt.php?status=success");
        } else {
            // Redirect ke halaman tambah_dpt.php dengan pesan error
            header("Location: tambah_dpt.php?status=error");
        }
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-5">
    <h2>Tambah Data DPT</h2>

    <!-- Alert pesan NIK duplikat -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'duplicate_nik'): ?>
    <div class="alert alert-danger">
        NIK sudah terdaftar! Silakan masukkan NIK yang berbeda.
    </div>
    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
    <div class="alert alert-danger">
        Terjadi kesalahan saat menambahkan data. Silakan coba lagi.
    </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">Form Tambah Data DPT</div>
            <!-- Form untuk upload Excel -->
            <div class="card-body">
                <form action="import_excel.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="file_excel" class="form-label">Upload Files</label>
                        <input type="file" class="form-control" id="file_excel" name="file_excel" accept=".xls, .xlsx" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <form action="tambah_dpt.php" method="POST">
                <div class="mb-3">
                    <label for="nomor_tps" class="form-label">Nomor TPS</label>
                    <input type="text" class="form-control" id="nomor_tps" name="nomor_tps" required>
                </div>
                <div class="mb-3">
                    <label for="nama_pemilih" class="form-label">Nama Pemilih</label>
                    <input type="text" class="form-control" id="nama_pemilih" name="nama_pemilih" required>
                </div>
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="status_pemilih" class="form-label">Status Pemilih</label>
                    <select class="form-select" id="status_pemilih" name="status_pemilih" required>
                        <option value="Terdaftar">Terdaftar</option>
                        <option value="Tidak Terdaftar">Tidak Terdaftar</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
