<?php
require_once __DIR__ . '/config.php';

// Load page data from JSON
$dataFile = __DIR__ . '/data/content.json';
if (file_exists($dataFile)) {
    $pageData = json_decode(file_get_contents($dataFile), true);
} else {
    // Fallback to default data if file doesn't exist
    header('Location: admin.php');
    exit;
}

$pageTitle = 'Beranda';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website sekolah modern dengan program unggulan, fasilitas lengkap, dan portal login untuk siswa dan guru.">
    <title><?= htmlspecialchars($pageData['school_name']) ?> | <?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#home">
                <span class="brand-icon">S</span>
                <span><?= htmlspecialchars($pageData['school_name']) ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link active" href="#home">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#program">Program</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fasilitas">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#news">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="login.php" class="btn btn-light btn-sm px-3 rounded-pill fw-semibold shadow-sm">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header id="home" class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container position-relative z-2">
            <div class="row min-vh-100 align-items-center py-5 g-5">
                <div class="col-lg-6 text-white">
                    <span class="badge text-bg-light text-primary px-3 py-2 rounded-pill fw-semibold mb-3 shadow-sm"><?= htmlspecialchars($pageData['hero']['badge']) ?></span>
                    <h1 class="display-4 fw-bold mb-3"><?= htmlspecialchars($pageData['hero']['title']) ?></h1>
                    <p class="lead mb-4 text-white-50">
                        <?= htmlspecialchars($pageData['hero']['description']) ?>
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#program" class="btn btn-primary btn-lg px-4 rounded-pill shadow">Lihat Program</a>
                        <a href="login.php" class="btn btn-outline-light btn-lg px-4 rounded-pill">Masuk Portal</a>
                    </div>

                    <div class="hero-stat row mt-5 g-4">
                        <?php foreach ($pageData['hero']['stats'] as $stat): ?>
                            <div class="col-4">
                                <div class="stat-box">
                                    <h3><?= htmlspecialchars($stat['number']) ?></h3>
                                    <span><?= htmlspecialchars($stat['label']) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-card glass-card">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <p class="text-uppercase text-primary mb-1 small fw-semibold">Pendaftaran</p>
                                <h4 class="mb-0 text-dark"><?= htmlspecialchars($pageData['ppdb']['title']) ?></h4>
                            </div>
                            <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">Buka</span>
                        </div>

                        <div class="calendar-card mb-3">
                            <div class="calendar-top">
                                <span><?= htmlspecialchars($pageData['ppdb']['month']) ?></span>
                                <strong><?= htmlspecialchars($pageData['ppdb']['year']) ?></strong>
                            </div>
                            <div class="calendar-day"><?= htmlspecialchars($pageData['ppdb']['date']) ?></div>
                        </div>

                        <ul class="feature-list">
                            <?php foreach ($pageData['ppdb']['features'] as $feature): ?>
                                <li><i class="bi bi-check-circle-fill"></i> <?= htmlspecialchars($feature) ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <a href="#contact" class="btn btn-primary w-100 rounded-pill mt-4">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section id="about" class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="about-image-wrap">
                            <img src="<?= htmlspecialchars($pageData['about']['image']) ?>" alt="Siswa di sekolah" class="img-fluid rounded-4 shadow-lg">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <span class="section-tag">Tentang Kami</span>
                        <h2 class="section-title"><?= htmlspecialchars($pageData['about']['title']) ?></h2>
                        <p class="text-muted fs-6">
                            <?= htmlspecialchars($pageData['about']['description']) ?>
                        </p>
                        <div class="row mt-4 g-3">
                            <div class="col-sm-6">
                                <div class="info-card">
                                    <h6>Visi</h6>
                                    <p><?= htmlspecialchars($pageData['about']['vision']) ?></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info-card">
                                    <h6>Misi</h6>
                                    <p><?= htmlspecialchars($pageData['about']['mission']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="program" class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="section-tag">Program Kami</span>
                    <h2 class="section-title">Pembelajaran yang Menyenangkan &amp; Berkualitas</h2>
                </div>
                <div class="row g-4">
                    <?php foreach ($pageData['programs'] as $program): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="program-card">
                                <div class="icon-box bg-primary-subtle text-primary"><?= htmlspecialchars($program['icon']) ?></div>
                                <h4><?= htmlspecialchars($program['title']) ?></h4>
                                <p><?= htmlspecialchars($program['description']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="fasilitas" class="py-5 text-white">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="section-tag bg-white text-primary">Fasilitas</span>
                    <h2 class="section-title text-white">Lingkungan Belajar yang Modern</h2>
                </div>
                <div class="row g-4">
                    <?php foreach ($pageData['facilities'] as $facility): ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="facility-box">
                                <i class="bi <?= htmlspecialchars($facility['icon']) ?>"></i>
                                <h5><?= htmlspecialchars($facility['name']) ?></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="news" class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="section-tag">Berita &amp; Kegiatan</span>
                    <h2 class="section-title">Aktivitas Terbaru Sekolah</h2>
                </div>
                <div class="row g-4">
                    <?php foreach ($pageData['news'] as $n): ?>
                        <div class="col-md-4">
                            <article class="news-card">
                                <img src="<?= htmlspecialchars($n['image']) ?>" alt="Kegiatan sekolah" class="img-fluid">
                                <div class="p-4">
                                    <span class="date"><?= htmlspecialchars($n['date']) ?></span>
                                    <h4><?= htmlspecialchars($n['title']) ?></h4>
                                    <p><?= htmlspecialchars($n['description']) ?></p>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="contact" class="py-5">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <span class="section-tag">Hubungi Kami</span>
                        <h2 class="section-title">Bergabunglah dengan Era Pendidikan yang Lebih Baik</h2>
                        <p class="text-muted">Kami terbuka untuk kerja sama, pendaftaran siswa baru, dan konsultasi pendidikan.</p>

                        <div class="contact-list mt-4">
                            <div><strong>Alamat:</strong> <span><?= htmlspecialchars($pageData['contact']['address']) ?></span></div>
                            <div><strong>Email:</strong> <span><?= htmlspecialchars($pageData['contact']['email']) ?></span></div>
                            <div><strong>Telepon:</strong> <span><?= htmlspecialchars($pageData['contact']['phone']) ?></span></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="contact-card">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Masukkan email Anda">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pesan</label>
                                    <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill w-100">Kirim Pesan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <p class="mb-0">© 2026 <?= htmlspecialchars($pageData['school_name']) ?>. All rights reserved.</p>
            <div class="d-flex gap-3">
                <a href="#">Instagram</a>
                <a href="#">Facebook</a>
                <a href="#">YouTube</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
