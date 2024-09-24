<?php
session_start();

// Koneksi ke database
include '../config/koneksi.php'; // Pastikan file koneksi ke database sudah benar

// Proses registrasi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Validasi sederhana
    if (empty($username) || empty($password) || empty($confirm_password) || empty($email)) {
        header("Location: register.php?status=empty");
        exit();
    }

    // Cek apakah password dan konfirmasi password cocok
    if ($password !== $confirm_password) {
        header("Location: register.php?status=password_mismatch");
        exit();
    }

    // Cek apakah username sudah ada di database
    $check_username = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $check_username);

    if (mysqli_num_rows($result) > 0) {
        // Username sudah ada
        header("Location: register.php?status=username_taken");
        exit();
    }

    // Jika username belum ada, hash password dan simpan data ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
    
    if (mysqli_query($conn, $query)) {
        // Registrasi berhasil
        header("Location: login.php?status=registered");
        exit();
    } else {
        // Jika terjadi kesalahan saat menyimpan ke database
        header("Location: register.php?status=error");
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
            <h2 class="login-title text-center">REGISTER | ADMIN</h2>
            <div id="alert-container">
            <!-- Menampilkan pesan error atau status -->
            <?php if (isset($_GET['status'])): ?>
                <?php if ($_GET['status'] == 'empty'): ?>
                    <div class="alert alert-danger">Semua kolom harus diisi!</div>
                <?php elseif ($_GET['status'] == 'password_mismatch'): ?>
                    <div class="alert alert-danger">Password dan konfirmasi password tidak cocok!</div>
                <?php elseif ($_GET['status'] == 'username_taken'): ?>
                    <div class="alert alert-danger">Username sudah digunakan!</div>
                <?php elseif ($_GET['status'] == 'error'): ?>
                    <div class="alert alert-danger">Terjadi kesalahan saat menyimpan data, coba lagi.</div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Form registrasi -->
            <form id="login-form" action="" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
                <a href="login.php" class="btn btn-secondary w-100">Login</a>
            </form>
            <p class="text-center mt-3" style="font-size:14px; font-style: italic;">Sudah memiliki akun? <a href="login.php" class="text-white">Login</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>