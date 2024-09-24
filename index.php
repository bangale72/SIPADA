<?php 
include 'config/koneksi.php';
include 'include/header.php'; 

?>
<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/images/carousel-1.jpg" class="d-block w-100" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img src="assets/images/carousel-2.jpg" class="d-block w-100" alt="Slide 2">
        </div>
        <div class="carousel-item">
            <img src="assets/images/carousel-3.jpg" class="d-block w-100" alt="Slide 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Countdown -->
<section class="section-countdon py-5 text-center">
    <div class="container">
        <p class="countdown" id="countdown">
        <h4 class="cnd">MENUJU Pemungutan Suara PILKADA Serentak 2024</h4>
    </div>
</section>

<!-- Info Terkini -->
<section id="infoterkini" class="mt-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Info Terkini</h2>
        <div class="row">
            <!-- Info Terkini Card 1 -->
            <div class="col-md-3">
                <div class="card">
                    <a href="https://perpustakaan.kpu.go.id/" target="_blank" rel="nofollow">
                        <img src="assets\images\info-1.jpg" class="card-img rounded" alt="Info 1">
                    </a>
                </div>
            </div>
            <!-- Info Terkini Card 2 -->
            <div class="col-md-3">
                <div class="card">
                    <a href="https://www.kpu.go.id/page/read/856/pengaduan-masyarakat" target="_blank" rel="nofollow">
                        <img src="assets\images\info-2.jpg" class="card-img rounded" alt="Info 2">
                    </a>
                </div>
            </div>
            <!-- Info Terkini Card 3 -->
            <div class="col-md-3">
                <div class="card">
                    <a href="https://sirup.lkpp.go.id/sirup/ro/penyedia/kldi/L31" target="_blank" rel="nofollow">
                        <img src="assets\images\info-3.jpg" class="card-img rounded" alt="Info 3">
                    </a>
                </div>
            </div>
            <!-- Info Terkini Card 4 -->
            <div class="col-md-3">
                <div class="card">
                    <a href="/">
                        <img src="assets\images\info-4.jpeg" class="card-img rounded" alt="Info 4">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pengumuman dan Agenda -->
<section id="agenda" class="mt-5">
    <div class="container text-center">
        <div class="row">
            <!-- Pengumuman Berita -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Berita Terbaru</h5><hr>
                        <?php
                        include 'config/koneksi.php';

                        $query = "SELECT * FROM berita ORDER BY tanggal DESC LIMIT 3";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {

                            // Gabungkan path folder uploads dengan nama file images yang ada di database
                            $imagePath = str_replace('\\', '/', "page/uploads/" . $row['images']);
                        
                            // Tampilkan images berita
                            echo "<img src='" . $imagePath . "' alt='images Berita' class='img-fluid rounded' style='max-width: 100%; height: auto;'>";
                        
                            // Tampilkan judul berita
                            echo "<h4>" . $row['judul'] . "</h4>";
                        
                            // Tampilkan sebagian isi berita
                            echo "<p style='text-align:justify;'>" . substr($row['isi_berita'], 0, 160) . "... <a href='detail_berita.php?judul=" . $row['judul'] . "'>Baca selengkapnya</a></p>"; 
                        
                            // Tampilkan tanggal berita
                            echo "<p style='text-align:left;'><strong>Tanggal:</strong> " . $row['tanggal'] . "</p><hr>";
                        }
                                                
                        ?>
                    </div>
                </div>
            </div>
            
            <!-- Agenda Kalender -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Agenda</h5><hr>
                        <!-- Tampilkan kalender -->
                        <iframe src="assets\calendar\calendar\index.html" style="border: 0" width="100%" height="550" frameborder="0" scrolling="no"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Infografis -->
<section id="infografis" class="mt-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Infografis</h2>
        <div class="row">
            <!-- Infografis Card 1 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="assets/images/infografis1.jpg" class="card-img-top" alt="Infografis 1">
                </div>
            </div>
            <!-- Infografis Card 2 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="assets/images/infografis2.jpg" class="card-img-top" alt="Infografis 2">
                </div>
            </div>
            <!-- Infografis Card 3 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="assets/images/infografis3.jpg" class="card-img-top" alt="Infografis 3">
                </div>
            </div>
            <!-- Infografis Card 4 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="assets/images/infografis4.jpg" class="card-img-top" alt="Infografis 4">
                </div>
            </div>
        </div>
    </div>
</section>

<section id="statistik" class="mt-5">
    <div class="container">
        <div class="row">
            <?php 
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
            <div class="container mt-3">
                <h2 class="text-center" style="font-style:italic;" >Statistik Pemilih per TPS</h2>
                <canvas id="pemilihChart" width="400" height="151"></canvas>
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
        </div>
    </div>
</section>

<?php include 'include/footer.php'; ?>