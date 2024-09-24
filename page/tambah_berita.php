<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
include '../config/koneksi.php';

// Proses penambahan berita
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $isi_berita = mysqli_real_escape_string($conn, $_POST['isi_berita']);
    $target_dir = "uploads/";

    // Format judul untuk URL
    $judul_url = str_replace(' ', '-', $judul);

    // Proses upload images
    $images = $_FILES['images']['name'];
    $target_file = $target_dir . basename($images);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file benar-benar gambar
    $check = getimagesize($_FILES["images"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File bukan gambar.');</script>";
        $uploadOk = 0;
    }

    // Cek apakah file sudah ada
    if (file_exists($target_file)) {
        echo "<script>alert('File gambar sudah ada.');</script>";
        $uploadOk = 0;
    }

    // Cek ukuran file (maksimal 9MB)
    if ($_FILES["images"]["size"] > 9000000) {
        echo "<script>alert('Ukuran file gambar terlalu besar.');</script>";
        $uploadOk = 0;
    }

    // Hanya izinkan format tertentu
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script>alert('Hanya file JPG, JPEG, PNG yang diperbolehkan.');</script>";
        $uploadOk = 0;
    }

    // Jika semua pengecekan lolos, upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
            // Query untuk menambahkan data berita ke database
            $query = "INSERT INTO berita (judul, tanggal, isi_berita, images) VALUES ('$judul', '$tanggal', '$isi_berita', '$images')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Berita berhasil ditambahkan!'); window.location.href='tambah_berita.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan berita: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Gagal mengupload gambar.');</script>";
        }
    }
}
?>

<?php include 'header.php'; ?>
    <div class="container mt-3 mb-3">
        <h2>Tambah Berita</h2>
        <form action="tambah_berita.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Berita</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
                <label for="isi_berita" class="form-label">Isi Berita</label>
                <textarea class="form-control" id="isi_berita" name="isi_berita" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Upload Gambar</label>
                <input type="file" class="form-control" id="images" name="images" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Berita</button>
        </form>
    </div>
<?php include 'footer.php'; ?>
