<?php
session_start();

// Koneksi ke database
include '../config/koneksi.php'; // Pastikan koneksi database sudah benar

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query untuk mengambil data pengguna berdasarkan username
    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password (gunakan password_hash saat menyimpan di database)
        if (password_verify($password, $user['password'])) {
            // Jika password benar, set session
            $_SESSION['user'] = $user['username'];
            header("Location: dashboard_admin.php?status=success");
            exit();
        } else {
            // Jika password salah
            header("Location: login.php?status=error");
            exit();
        }
    } else {
        // Jika username tidak ditemukan
        header("Location: login.php?status=error");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link Tag -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="icon" type="image/x-icon" href="../assets/favicon/favicon.ico">
    <link rel="manifest" href="../assets/favicon/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>Login - SIPADA</title>
    <style>
        body {
            background-image: url('images/bg.jpg');
            background-size: cover;
            font-family: "Geologica", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            font-variation-settings:
                "slnt" 0,
                "CRSV" 0,
                "SHRP" 0;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background: rgba(255,255,255,0.5);
        }
        .login-card h2 {
            margin-bottom: 1.5rem;
        }
        .login-title {
            font-weight: 800;
            color: black;
        }
        .login-card .btn {
            margin-top: 1rem;
            color: #ffff;
        }
        .btn {
            background-color: #771414;
        }
        .btn:hover {
            background-color: #ffff;
            color: black;
        }
        .alert {
            display: none;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <h2 class="login-title text-center">LOGIN | ADMIN</h2>
        <div id="alert-container">
            
            <?php
            if (isset($_GET['status'])) {
                $status = $_GET['status'];
                if ($status == 'error') {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Username atau password salah. Silakan coba lagi.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                } elseif ($status == 'success') {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Login berhasil! Anda akan diarahkan ke dashboard.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }
            ?>
        </div>
        <form id="login-form" action="login.php" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" id="username" name="username" autocomplete="true" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-light w-100">Login</button>
            <a href="../index.php" class="btn btn-warning w-100">Beranda</a>
        </form>
        <p class="text-center mt-3" style="font-size:14px; font-style: italic;">Jika belum memilikiakun? <a href="register.php" class="text-white">Register</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
