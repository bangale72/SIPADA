<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Koneksi ke database
include '../config/koneksi.php';

// Include PhpSpreadsheet
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Inisialisasi variabel filter
$search_keyword = '';

// Memeriksa apakah ada parameter pencarian yang dimasukkan
$conditions = [];
if (!empty($_GET['search_keyword'])) {
    $search_keyword = $_GET['search_keyword'];
    $escaped_keyword = mysqli_real_escape_string($conn, $search_keyword);

    // Mencari di semua kolom: nomor_tps, nama_pemilih, nik, status_pemilih
    $conditions[] = "(nomor_tps LIKE '%$escaped_keyword%' OR 
                     nama_pemilih LIKE '%$escaped_keyword%' OR 
                     nik LIKE '%$escaped_keyword%' OR 
                     status_pemilih LIKE '%$escaped_keyword%')";
}

// Membuat query pencarian berdasarkan filter yang ada
$query = "SELECT * FROM daftar_pemilih_tetap";
if (count($conditions) > 0) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$result = mysqli_query($conn, $query);

// Fungsi Export ke Excel
if (isset($_GET['export']) && $_GET['export'] == 'excel') {
    // Membuat spreadsheet baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header Kolom
    $sheet->setCellValue('A1', 'TPS');
    $sheet->setCellValue('B1', 'Nama Pemilih');
    $sheet->setCellValue('C1', 'NIK');
    $sheet->setCellValue('D1', 'Alamat');
    $sheet->setCellValue('E1', 'Status Pemilih');

    // Menambahkan data dari database ke dalam file excel
    if (mysqli_num_rows($result) > 0) {
        $row_number = 2; // Mulai dari baris kedua karena baris pertama untuk header
        while ($row = mysqli_fetch_assoc($result)) {
            $sheet->setCellValue('A' . $row_number, $row['nomor_tps']);
            $sheet->setCellValue('B' . $row_number, $row['nama_pemilih']);
            $sheet->setCellValue('C' . $row_number, $row['nik']);
            $sheet->setCellValue('D' . $row_number, $row['alamat']);
            $sheet->setCellValue('E' . $row_number, $row['status_pemilih']);
            $row_number++;
        }
    }

    // Menyimpan file excel ke output
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="data_pemilih.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);

    // Bersihkan buffer output dan kirimkan file Excel ke browser
    ob_end_clean();
    $writer->save('php://output');
}
?>

<?php include 'header.php'; ?>
<div class="container mt-3">
    <h2>Data DPT per TPS</h2>

    <!-- Tombol Tambah DPT -->
    <a href="tambah_dpt.php" class="btn btn-success btn-sm mb-3"><i class="bi bi-plus my-icon"></i> Tambah DPT</a>

    <!-- Tombol Export Excel -->
    <a href="data_dpt.php?export=excel" class="btn btn-info btn-sm mb-3"><i class="bi bi-filetype-xlsx"></i> Download Excel</a>

    <!-- Tampilkan pesan sukses jika ada -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
    <div class="alert alert-success">Data berhasil dihapus!</div>
    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'edited'): ?>
    <div class="alert alert-success">Data berhasil diedit!</div>
    <?php endif; ?>

    <!-- Form Pencarian -->
    <form method="GET" action="">
        <div class="row mb-3">
            <div class="col-md-8">
                <input type="text" name="search_keyword" class="form-control" placeholder="Cari berdasarkan Nomor TPS, Nama, NIK atau Status Pemilih" value="<?= htmlspecialchars($search_keyword); ?>">
            </div>
            <div class="col-md-4 text-right">
                <button type="submit" class="btn btn-primary mr-2" style="background-color: #771414; border-color: #771414; color: white;"><i class="bi bi-search"></i> Search</button>
                <a href="data_dpt.php" class="btn btn-secondary" style="background-color: #cccccc; border-color: #cccccc; color: black;"><i class="bi bi-arrow-counterclockwise"></i> Reset</a>
            </div>
        </div>
    </form>

    <!-- Tabel Data DPT -->
    <table class="table table-striped">
        <thead class="text-center">
            <tr>
                <th>TPS</th>
                <th>Nama Pemilih</th>
                <th>NIK</th>
                <th>Alamat</th>
                <th>Status Pemilih</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['nomor_tps']; ?></td>
                    <td><?= $row['nama_pemilih']; ?></td>
                    <td><?= $row['nik']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                    <td><?= $row['status_pemilih']; ?></td>
                    <td>
                        <!-- Tombol Edit -->
                        <a href="edit_dpt.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pen"></i></a>
                        <!-- Tombol Hapus -->
                        <a href="hapus_dpt.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data yang ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>
