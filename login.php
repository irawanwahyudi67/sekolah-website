<?php
require_once __DIR__ . '/database.php';

$pdo = dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi.';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if (($user['role'] ?? 'user') === 'admin') {
                redirect('admin.php');
            }
            redirect('dashboard.php');
        } else {
            $error = 'Username atau password salah.';
        }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-body">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center p-4">
        <div class="row auth-shell g-0 shadow-lg overflow-hidden">
            <div class="col-lg-6 d-none d-lg-block auth-visual">
                <div class="auth-overlay"></div>
                <div class="auth-visual-content text-white">
                    <span class="badge bg-light text-primary rounded-pill px-3 py-2 mb-3 fw-semibold">Portal Sekolah</span>
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

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger rounded-3"><?= e($error) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="login.php" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Masukkan username" required autocomplete="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password" required autocomplete="current-password">
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
                        <div class="fw-semibold mb-1">Demo login:</div>
                        <div>admin / admin123</div>
                        <div>siswa / siswa123</div>
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
