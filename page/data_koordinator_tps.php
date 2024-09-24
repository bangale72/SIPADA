<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

include '../config/koneksi.php';

$query = "SELECT * FROM koordinator_tps";
$result = mysqli_query($conn, $query);
?>

<?php include 'header.php'; ?>
<div class="container mt-3">
    <h2>Data Koordinator TPS</h2>

    <!-- Tombol Tambah Koordinator -->
    <a href="tambah_koordinator_tps.php" class="btn btn-sm btn-success mb-3"><i class="bi bi-plus my-icon"></i> Tambah Koordinator</a>

    <!-- Tampilkan pesan jika ada -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
        <div class="alert alert-success">Data berhasil dihapus!</div>
    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'edited'): ?>
        <div class="alert alert-success">Data berhasil diedit!</div>
    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'added'): ?>
        <div class="alert alert-success">Data berhasil ditambahkan!</div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead class="text-center">
            <tr>
                <th>No TPS</th>
                <th>Nama Koordinator</th>
                <th>Kontak</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['nomor_tps']; ?></td>
                <td><?= $row['nama_koordinator']; ?></td>
                <td><?= $row['kontak']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td>
                    <!-- Tombol Edit -->
                    <a href="edit_koordinator_tps.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pen"></i></a>
                    <!-- Tombol Hapus -->
                    <a href="hapus_koordinator_tps.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>
