<!-- statistik_pemilih.php -->
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

include '../config/koneksi.php';

// Contoh query untuk mengambil data statistik
$query = "SELECT nomor_tps, COUNT(*) as total_pemilih FROM daftar_pemilih_tetap GROUP BY nomor_tps";
$result = mysqli_query($conn, $query);

$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['nomor_tps'];
    $data[] = $row['total_pemilih'];
}
?>

<?php include 'header.php'; ?>
<div class="container mt-3">
    <h2 class="text-center" style="font-style:italic;" >Statistik Pemilih per TPS</h2>
    <canvas id="pemilihChart" width="400" height="200"></canvas>
</div>

<script>
    const labels = <?= json_encode($labels); ?>;
    const data = {
        labels: labels,
        datasets: [{
            label: 'Jumlah Pemilih Per TPS',
            data: <?= json_encode($data); ?>,
            backgroundColor: [
                'rgb(255, 99, 132)',   // Warna merah muda
                'rgb(75, 192, 192)',   // Warna hijau laut
                'rgb(255, 205, 86)',   // Warna kuning cerah
                'rgb(201, 203, 207)',  // Warna abu-abu muda
                'rgb(54, 162, 235)',   // Warna biru
                'rgb(153, 102, 255)',  // Warna ungu
                'rgb(255, 159, 64)',   // Warna oranye
                'rgb(0, 255, 127)',    // Warna hijau cerah
                'rgb(255, 69, 0)',     // Warna merah oranye
                'rgb(64, 224, 208)',   // Warna turquoise
                'rgb(128, 0, 128)',    // Warna ungu tua
                'rgb(220, 20, 60)',    // Warna merah tua
                'rgb(70, 130, 180)',   // Warna biru baja
                'rgb(0, 128, 128)',    // Warna teal
                'rgb(154, 205, 50)'    // Warna hijau kuning
            ]
        }]
        };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const pemilihChart = new Chart(
        document.getElementById('pemilihChart'),
        config
    );
</script>
<?php include 'footer.php'; ?>