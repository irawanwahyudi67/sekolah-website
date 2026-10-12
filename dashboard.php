<?php
require_once __DIR__ . '/config.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$pdo = dbConnect();
$user = $pdo->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
$user->execute([$_SESSION['user_id']]);
$userData = $user->fetch();

$site = getSiteData($pdo);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="dashboard-body">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <span class="brand-icon">S</span>
                <span><?= e($site['school']['school_name'] ?? APP_NAME) ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardNav" aria-controls="dashboardNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="dashboardNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Jadwal</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Nilai</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Berita</a></li>
                    <li class="nav-item ms-lg-3">
                        <span class="nav-user text-white-50">Halo, <?= e(strtoupper($userData['username'] ?? 'User')) ?></span>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-light btn-sm rounded-pill px-3">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="welcome-card p-4 rounded-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <p class="mb-1 text-primary fw-semibold">Selamat datang kembali</p>
                            <h2 class="mb-0 fw-bold">Dashboard <?= e($userData['role'] === 'admin' ? 'Admin' : 'Siswa') ?></h2>
                        </div>
                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">Login: <?= e(date('Y-m-d H:i:s')) ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mini-card rounded-4 shadow-sm p-4">
                    <p class="text-muted mb-1">Status</p>
                    <h3 class="mb-0 text-success">Aktif</h3>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <?php foreach ($site['stats'] as $stat): ?>
                <div class="col-md-6 col-xl-3">
                    <div class="stat-card rounded-4 shadow-sm p-4">
                        <span class="stat-label"><?= e($stat['label']) ?></span>
                        <h3><?= e($stat['number']) ?></h3>
                        <small class="text-success">Update terbaru</small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="content-card rounded-4 shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Jadwal Hari Ini</h4>
                        <span class="badge bg-light text-dark rounded-pill">Senin</span>
                    </div>
                    <div class="schedule-list">
                        <div class="schedule-item">
                            <div class="time">07:30</div>
                            <div class="info">
                                <h6>Upacara Bendera</h6>
                                <small>Lapangan utama</small>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="time">08:15</div>
                            <div class="info">
                                <h6>Matematika</h6>
                                <small>Ruang 101</small>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="time">10:00</div>
                            <div class="info">
                                <h6>Bahasa Inggris</h6>
                                <small>Ruang 205</small>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="time">13:00</div>
                            <div class="info">
                                <h6>Praktek Komputer</h6>
                                <small>Laboratorium IT</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="content-card rounded-4 shadow-sm p-4">
                    <h4 class="mb-3">Pengumuman</h4>
                    <?php foreach (array_slice($site['news'], 0, 3) as $news): ?>
                        <div class="announcement-item">
                            <span class="tag bg-primary-subtle text-primary">Baru</span>
                            <h6><?= e($news['title']) ?></h6>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
