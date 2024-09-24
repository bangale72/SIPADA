<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

// Koneksi ke database
include '../config/koneksi.php';

// Dapatkan data berdasarkan ID
$id = $_GET['id'];
$query = "SELECT * FROM daftar_pemilih_tetap WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomor_tps = $_POST['nomor_tps'];
    $nama_pemilih = $_POST['nama_pemilih'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $status_pemilih = $_POST['status_pemilih'];

    // Update data di database
    $update_query = "UPDATE daftar_pemilih_tetap SET 
                     nomor_tps = '$nomor_tps', 
                     nama_pemilih = '$nama_pemilih', 
                     nik = '$nik', 
                     alamat = '$alamat', 
                     status_pemilih = '$status_pemilih' 
                     WHERE id = '$id'";
    
    if (mysqli_query($conn, $update_query)) {
        header("Location: data_dpt.php?status=edited");
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-5">
    <h2>Edit Data DPT</h2>

    <div class="card mb-4">
        <div class="card-header">Form Edit Data DPT</div>
        <div class="card-body">
            <form action="edit_dpt.php?id=<?= $id ?>" method="POST">
                <div class="mb-3">
                    <label for="nomor_tps" class="form-label">Nomor TPS</label>
                    <input type="text" class="form-control" id="nomor_tps" name="nomor_tps" value="<?= $data['nomor_tps'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nama_pemilih" class="form-label">Nama Pemilih</label>
                    <input type="text" class="form-control" id="nama_pemilih" name="nama_pemilih" value="<?= $data['nama_pemilih'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $data['nik'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?= $data['alamat'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="status_pemilih" class="form-label">Status Pemilih</label>
                    <select class="form-select" id="status_pemilih" name="status_pemilih" required>
                        <option value="Terdaftar" <?= $data['status_pemilih'] == 'Terdaftar' ? 'selected' : '' ?>>Terdaftar</option>
                        <option value="Tidak Terdaftar" <?= $data['status_pemilih'] == 'Tidak Terdaftar' ? 'selected' : '' ?>>Tidak Terdaftar</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
