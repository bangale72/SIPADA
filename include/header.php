<!DOCTYPE html>
<html lang="id-ID">

<head>
    <!-- Meta Tag -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIPADA (Sistem Informasi Pilkada) adalah platform untuk memudahkan pemantauan, pengelolaan, dan publikasi Tim Pemenangan Pilkada secara transparan dan akurat. Sistem ini menyajikan informasi komprehensif terkait pemilih, kandidat, hasil pemungutan suara, dan statistik lainnya.">
    <meta name="keywords" content="Pilkada, Sistem Informasi, SIPADA, Pemilu, Pemilihan Kepala Daerah, Pilkada 2024, data pemilih, transparansi Pilkada, hasil Pilkada, pemantauan Pilkada">
    <meta name="author" content="SIPADA Team">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:title" content="SIPADA - Sistem Informasi Pilkada">
    <meta property="og:description" content="Platform informasi digital untuk memantau dan mengelola Tim Pemenangan Pilkada dengan transparan dan akurat.">
    <meta property="og:image" content="assets/images/logo-1.png">
    <meta property="og:url" content="https://aleadigital.tech">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SIPADA - Sistem Informasi Pilkada">
    <meta name="twitter:description" content="Sistem Informasi yang mempermudah pemantauan dan publikasi Tim Pemenangan Pilkada secara real-time.">
    <meta name="twitter:image" content="assets/images/logo-1.png">

    <!-- Template Information -->
    <meta name="template-name" content="SIPADA Template">
    <meta name="template-version" content="1.0.0">
    <meta name="author" content="SIPADA Development Team">
    <meta name="creation-date" content="2024-09-20">
    <meta name="template-description" content="Template untuk SIPADA - Sistem Informasi Pilkada, dirancang dengan fitur yang responsif, modern, dan ramah pengguna. Dikembangkan untuk memberikan kemudahan dalam pemantauan dan pengelolaan data pemilih pada Pilkada.">
    <meta name="template-license" content="MIT License">
    <meta name="framework" content="PHP, MySQL, Bootstrap, JavaScript">

    <!-- Link Tag -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="icon" type="image/x-icon" href="assets/favicon/favicon.ico">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Script Tag -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>SIPADA - Sistem Informasi Pilkada</title>
</head>

<body id="home">
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="color:white; font-weight:800;">
                <img src="assets/images/logo-2.png" alt="Logo SIPADA" height="40"> <span> SIPADA</span></a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php" style="color:white;">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#infoterkini" style="color:white;">Info Terkini</a></li>
                    <li class="nav-item"><a class="nav-link" href="#agenda" style="color:white;">Agenda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#infografis" style="color:white;">Infografis</a></li>
                    <li class="nav-item"><a class="nav-link" href="#statistik" style="color:white;">Statistik</a></li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                <a class="btn btn-outline-light ms-2" href="page/login.php"><i class="bi bi-box-arrow-right"></i></a>
                <a class="btn btn-outline-light ms-2" href="page/dashboard_admin.php"><i class="bi bi-gear"></i></a>
            </div>
        </div>
    </nav>