<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Sekolah Pintar';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> | <?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#home">
                <span class="brand-icon">S</span> <?= APP_NAME ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#program">Program</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fasilitas">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#news">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="login.php" class="btn btn-light btn-sm px-3 rounded-pill fw-semibold">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header id="home" class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container position-relative z-2">
            <div class="row min-vh-100 align-items-center py-5">
                <div class="col-lg-6 text-white">
                    <span class="badge text-bg-light text-primary px-3 py-2 rounded-pill fw-semibold mb-3">Sekolah Unggul & Berkarakter</span>
                    <h1 class="display-4 fw-bold mb-3">Membentuk Generasi Cerdas, Berakhlak, dan Siap Masa Depan</h1>
                    <p class="lead mb-4 text-white-50">
                        Kami menghadirkan pendidikan modern yang menggabungkan ilmu pengetahuan, kreativitas, dan karakter untuk mempersiapkan siswa menuju masa depan yang lebih cerah.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#program" class="btn btn-primary btn-lg px-4 rounded-pill shadow">Lihat Program</a>
                        <a href="login.php" class="btn btn-outline-light btn-lg px-4 rounded-pill">Masuk Portal</a>
                    </div>
                    <div class="hero-stat row mt-5 g-4">
                        <div class="col-4">
                            <div class="stat-box">
                                <h3>15K+</h3>
                                <span>Siswa</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-box">
                                <h3>250+</h3>
                                <span>Guru</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-box">
                                <h3>98%</h3>
                                <span>Lulus</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-card glass-card">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <p class="text-uppercase text-primary mb-1 small fw-semibold">Pendaftaran</p>
                                <h4 class="mb-0 text-dark">PPDB 2026</h4>
                            </div>
                            <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">Buka</span>
                        </div>
                        <div class="calendar-card mb-3">
                            <div class="calendar-top">
                                <span>Agustus</span>
                                <strong>2026</strong>
                            </div>
                            <div class="calendar-day">12</div>
                        </div>
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Kurikulum Nasional + STEM</li>
                            <li><i class="bi bi-check-circle-fill"></i> Kegiatan ekstrakurikuler lengkap</li>
                            <li><i class="bi bi-check-circle-fill"></i> Lingkungan belajar aman dan modern</li>
                        </ul>
                        <a href="#contact" class="btn btn-primary w-100 rounded-pill mt-3">Daftar Sekarang</a>
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
                            <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=900&q=80" alt="Siswa di sekolah" class="img-fluid rounded-4 shadow-lg">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <span class="section-tag">Tentang Kami</span>
                        <h2 class="section-title">Sekolah yang Menumbuhkan Potensi Siswa Secara Maksimal</h2>
                        <p class="text-muted">
                            Di <?= APP_NAME ?>, kami percaya setiap siswa memiliki bakat unik. Oleh karena itu, kami menciptakan lingkungan belajar yang inspiratif, suportif, dan mendorong siswa untuk aktif, kreatif, dan berinovasi.
                        </p>
                        <div class="row mt-4 g-3">
                            <div class="col-sm-6">
                                <div class="info-card">
                                    <h6>Visi</h6>
                                    <p>Menjadi sekolah pilihan utama yang mencetak lulusan unggul, inovatif, dan berakhlak mulia.</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info-card">
                                    <h6>Misi</h6>
                                    <p>Menyediakan pembelajaran berbasis teknologi, karakter, dan pengembangan diri yang optimal.</p>
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
                    <h2 class="section-title">Pembelajaran yang Menyenangkan & Berkualitas</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="program-card">
                            <div class="icon-box bg-primary-subtle text-primary">01</div>
                            <h4>STEM & Robotics</h4>
                            <p>Belajar coding, robotika, dan sains dengan pendekatan praktik yang menyenangkan.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="program-card">
                            <div class="icon-box bg-warning-subtle text-warning">02</div>
                            <h4>Bahasa & Literasi</h4>
                            <p>Menumbuhkan kemampuan komunikasi, membaca, dan berpikir kritis sejak dini.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="program-card">
                            <div class="icon-box bg-success-subtle text-success">03</div>
                            <h4>Olahraga & Seni</h4>
                            <p>Menyalurkan bakat siswa melalui olahraga, musik, tari, dan kegiatan kreatif.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="fasilitas" class="py-5 bg-primary text-white">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="section-tag bg-white text-primary">Fasilitas</span>
                    <h2 class="section-title text-white">Lingkungan Belajar yang Modern</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="facility-box">
                            <i class="bi bi-mortarboard-fill"></i>
                            <h5>Laboratorium</h5>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="facility-box">
                            <i class="bi bi-laptop"></i>
                            <h5>Lab Komputer</h5>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="facility-box">
                            <i class="bi bi-book-half"></i>
                            <h5>Perpustakaan</h5>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="facility-box">
                            <i class="bi bi-dribbble"></i>
                            <h5>Lapangan Olahraga</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="news" class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="section-tag">Berita & Kegiatan</span>
                    <h2 class="section-title">Aktivitas Terbaru Sekolah</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <article class="news-card">
                            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80" alt="Kegiatan sekolah" class="img-fluid">
                            <div class="p-4">
                                <span class="date">12 Agustus 2026</span>
                                <h4>Workshop Robotika untuk Siswa Kelas 7</h4>
                                <p>Program inovasi berbasis STEM membantu siswa memecahkan masalah dengan cara kreatif.</p>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="news-card">
                            <img src="https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=800&q=80" alt="Siswa belajar" class="img-fluid">
                            <div class="p-4">
                                <span class="date">20 Agustus 2026</span>
                                <h4>Seminar Kewirausahaan Mahasiswa Muda</h4>
                                <p>Mengembangkan jiwa entrepreneurship agar siswa siap menjadi pemimpin masa depan.</p>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="news-card">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" alt="Tim sekolah" class="img-fluid">
                            <div class="p-4">
                                <span class="date">01 September 2026</span>
                                <h4>Festival Seni Budaya Sekolah</h4>
                                <p>Menampilkan kreativitas siswa dalam seni, musik, dan budaya lokal.</p>
                            </div>
                        </article>
                    </div>
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
                            <div><strong>Alamat:</strong> Jl. Pendidikan No. 45, Kota Bandung</div>
                            <div><strong>Email:</strong> info@sekolahpintar.sch.id</div>
                            <div><strong>Telepon:</strong> (022) 1234-5678</div>
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
            <p class="mb-0">© 2026 <?= APP_NAME ?>. All rights reserved.</p>
            <div class="d-flex gap-3">
                <a href="#">Instagram</a>
                <a href="#">Facebook</a>
                <a href="#">YouTube</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
