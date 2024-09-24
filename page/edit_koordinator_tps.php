<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

// Koneksi ke database
include '../config/koneksi.php';

// Dapatkan data berdasarkan ID
$id = $_GET['id'];
$query = "SELECT * FROM koordinator_tps WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomor_tps = $_POST['nomor_tps'];
    $nama_koordinator = $_POST['nama_koordinator'];
    $kontak = $_POST['kontak'];
    $alamat = $_POST['alamat'];

    $update_query = "UPDATE koordinator_tps SET 
                     nomor_tps = '$nomor_tps', 
                     nama_koordinator = '$nama_koordinator', 
                     kontak = '$kontak', 
                     alamat = '$alamat' 
                     WHERE id = '$id'";
    
    if (mysqli_query($conn, $update_query)) {
        header("Location: data_koordinator_tps.php?status=edited");
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-5">
    <h2>Edit Koordinator TPS</h2>
    <form action="edit_koordinator_tps.php?id=<?= $id ?>" method="POST">
        <div class="mb-3">
            <label for="nomor_tps" class="form-label">Nomor TPS</label>
            <input type="text" class="form-control" id="nomor_tps" name="nomor_tps" value="<?= $data['nomor_tps'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama_koordinator" class="form-label">Nama Koordinator</label>
            <input type="text" class="form-control" id="nama_koordinator" name="nama_koordinator" value="<?= $data['nama_koordinator'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" class="form-control" id="kontak" name="kontak" value="<?= $data['kontak'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?= $data['alamat'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
<?php include 'footer.php'; ?>
