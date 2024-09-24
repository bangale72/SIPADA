<?php
// Koneksi ke database
include 'config/koneksi.php';

// Ambil judul berita dari parameter URL dan sanitasi input
$judul_url = isset($_GET['judul']) ? mysqli_real_escape_string($conn, $_GET['judul']) : '';
$judul = str_replace('-', ' ', $judul_url);

if (!empty($judul)) {
    // Query untuk mengambil detail berita berdasarkan judul
    $query = "SELECT * FROM berita WHERE judul = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $judul);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $berita = mysqli_fetch_assoc($result);
    } else {
        echo "<p>Berita tidak ditemukan.</p>";
        exit;
    }
} else {
    echo "<p>Judul berita tidak valid.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($berita['judul']); ?> - Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php include 'include/header.php'; ?>
<div class="container mt-3">
    <p class="text-center"><?php echo htmlspecialchars($berita['tanggal']); ?></p>
    <h1 class="text-center"><strong><?php echo htmlspecialchars($berita['judul']); ?></strong></h1>
    <img src="page/uploads/<?php echo htmlspecialchars($berita['images']); ?>" alt="images Berita" class="img-fluid mb-3" style="max-width: 100%; height: auto;">
    <p><?php echo nl2br(htmlspecialchars($berita['isi_berita'])); ?></p>
</div>
<?php include 'include/footer.php'; ?>

