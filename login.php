<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['user'] = $username;
        $_SESSION['login_time'] = date('Y-m-d H:i:s');
        redirect('dashboard.php');
    } else {
        $error = 'Username atau password salah. Silakan coba lagi.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-body">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="row auth-shell g-0 shadow-lg rounded-4 overflow-hidden">
            <div class="col-lg-6 d-none d-lg-block auth-visual">
                <div class="auth-overlay"></div>
                <div class="auth-visual-content text-white">
                    <span class="badge bg-light text-primary rounded-pill px-3 py-2 mb-3">Portal Sekolah</span>
                    <h2>Selamat Datang di <?= APP_NAME ?></h2>
                    <p>Masuk untuk mengakses berita, jadwal, dan informasi akademik siswa dan guru.</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 bg-white">
                <div class="auth-form-wrap">
                    <div class="text-center mb-4">
                        <div class="brand-mark mb-3">S</div>
                        <h3 class="fw-bold mb-1">Login Akun</h3>
                        <p class="text-muted mb-0">Silakan masuk untuk melanjutkan</p>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger rounded-3"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="login.php" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4 small text-muted">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                            <a href="#" class="text-decoration-none">Lupa password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-semibold">Masuk</button>
                    </form>

                    <div class="mt-4 text-center small text-muted">
                        Demo login:<br>
                        admin / admin123<br>
                        siswa / siswa123
                    </div>

                    <div class="mt-4 text-center">
                        <a href="index.php" class="btn btn-link text-decoration-none">Kembali ke beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
