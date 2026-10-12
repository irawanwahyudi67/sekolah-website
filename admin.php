<?php
require_once __DIR__ . '/config.php';

if (!isAdmin()) {
    redirect('login.php');
}

$pdo = dbConnect();
$site = getSiteData($pdo);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'update_school') {
        $pdo->prepare('UPDATE school_info SET school_name = ?, description = ? ORDER BY id DESC LIMIT 1')->execute([
            $_POST['school_name'] ?? $site['school']['school_name'],
            $_POST['school_description'] ?? $site['school']['description'],
        ]);
        $message = 'Informasi sekolah berhasil diperbarui.';
    }

    if ($action === 'update_hero') {
        $pdo->prepare('UPDATE hero SET badge = ?, title = ?, description = ? ORDER BY id DESC LIMIT 1')->execute([
            $_POST['hero_badge'] ?? $site['hero']['badge'],
            $_POST['hero_title'] ?? $site['hero']['title'],
            $_POST['hero_description'] ?? $site['hero']['description'],
        ]);
        $message = 'Hero section berhasil diperbarui.';
    }

    if ($action === 'update_stats') {
        $idx = (int) ($_POST['index'] ?? 0);
        $stats = $pdo->query('SELECT * FROM stats ORDER BY id ASC')->fetchAll();
        if (isset($stats[$idx])) {
            $pdo->prepare('UPDATE stats SET number = ?, label = ? WHERE id = ?')->execute([
                $_POST['number'] ?? $stats[$idx]['number'],
                $_POST['label'] ?? $stats[$idx]['label'],
                $stats[$idx]['id'],
            ]);
        }
        $message = 'Statistik berhasil diperbarui.';
    }

    if ($action === 'update_ppdb') {
        $pdo->prepare('UPDATE ppdb SET title = ?, date_open = ?, month = ?, year = ? ORDER BY id DESC LIMIT 1')->execute([
            $_POST['ppdb_title'] ?? $site['ppdb']['title'],
            $_POST['ppdb_date'] ?? $site['ppdb']['date_open'],
            $_POST['ppdb_month'] ?? $site['ppdb']['month'],
            $_POST['ppdb_year'] ?? $site['ppdb']['year'],
        ]);
        $message = 'Info PPDB berhasil diperbarui.';
    }

    if ($action === 'update_feature') {
        $featureId = (int) ($_POST['feature_id'] ?? 0);
        $text = $_POST['feature_text'] ?? '';
        if ($featureId > 0 && $text !== '') {
            $pdo->prepare('UPDATE ppdb_features SET feature_text = ? WHERE id = ?')->execute([$text, $featureId]);
        }
        $message = 'Fitur PPDB berhasil diperbarui.';
    }

    if ($action === 'add_feature') {
        $ppdbId = $pdo->query('SELECT id FROM ppdb ORDER BY id DESC LIMIT 1')->fetch()['id'] ?? 0;
        if ($ppdbId) {
            $pdo->prepare('INSERT INTO ppdb_features (ppdb_id, feature_text) VALUES (?, ?)')->execute([$ppdbId, $_POST['feature_text'] ?? '']);
        }
        $message = 'Fitur baru ditambahkan.';
    }

    if ($action === 'delete_feature') {
        $featureId = (int) ($_POST['feature_id'] ?? 0);
        $pdo->prepare('DELETE FROM ppdb_features WHERE id = ?')->execute([$featureId]);
        $message = 'Fitur dihapus.';
    }

    if ($action === 'update_about') {
        $pdo->prepare('UPDATE about SET title = ?, description = ?, image_url = ?, vision = ?, mission = ? ORDER BY id DESC LIMIT 1')->execute([
            $_POST['about_title'] ?? $site['about']['title'],
            $_POST['about_description'] ?? $site['about']['description'],
            $_POST['about_image'] ?? $site['about']['image_url'] ?? '',
            $_POST['about_vision'] ?? $site['about']['vision'],
            $_POST['about_mission'] ?? $site['about']['mission'],
        ]);
        $message = 'Tentang sekolah berhasil diperbarui.';
    }

    if ($action === 'add_program') {
        $pdo->prepare('INSERT INTO programs (icon, title, description) VALUES (?, ?, ?)')->execute([
            $_POST['program_icon'] ?? '04',
            $_POST['program_title'] ?? '',
            $_POST['program_description'] ?? '',
        ]);
        $message = 'Program baru ditambahkan.';
    }

    if ($action === 'update_program') {
        $programId = (int) ($_POST['program_id'] ?? 0);
        $pdo->prepare('UPDATE programs SET icon = ?, title = ?, description = ? WHERE id = ?')->execute([
            $_POST['program_icon'] ?? '',
            $_POST['program_title'] ?? '',
            $_POST['program_description'] ?? '',
            $programId,
        ]);
        $message = 'Program berhasil diperbarui.';
    }

    if ($action === 'delete_program') {
        $programId = (int) ($_POST['program_id'] ?? 0);
        $pdo->prepare('DELETE FROM programs WHERE id = ?')->execute([$programId]);
        $message = 'Program berhasil dihapus.';
    }

    if ($action === 'add_facility') {
        $pdo->prepare('INSERT INTO facilities (icon, name, description) VALUES (?, ?, ?)')->execute([
            $_POST['facility_icon'] ?? 'bi-star',
            $_POST['facility_name'] ?? '',
            $_POST['facility_description'] ?? '',
        ]);
        $message = 'Fasilitas baru ditambahkan.';
    }

    if ($action === 'update_facility') {
        $facilityId = (int) ($_POST['facility_id'] ?? 0);
        $pdo->prepare('UPDATE facilities SET icon = ?, name = ?, description = ? WHERE id = ?')->execute([
            $_POST['facility_icon'] ?? '',
            $_POST['facility_name'] ?? '',
            $_POST['facility_description'] ?? '',
            $facilityId,
        ]);
        $message = 'Fasilitas berhasil diperbarui.';
    }

    if ($action === 'delete_facility') {
        $facilityId = (int) ($_POST['facility_id'] ?? 0);
        $pdo->prepare('DELETE FROM facilities WHERE id = ?')->execute([$facilityId]);
        $message = 'Fasilitas berhasil dihapus.';
    }

    if ($action === 'add_news') {
        $pdo->prepare('INSERT INTO news (date_publish, title, description, image_url) VALUES (?, ?, ?, ?)')->execute([
            $_POST['news_date'] ?? '',
            $_POST['news_title'] ?? '',
            $_POST['news_description'] ?? '',
            $_POST['news_image'] ?? '',
        ]);
        $message = 'Berita baru ditambahkan.';
    }

    if ($action === 'update_news') {
        $newsId = (int) ($_POST['news_id'] ?? 0);
        $pdo->prepare('UPDATE news SET date_publish = ?, title = ?, description = ?, image_url = ? WHERE id = ?')->execute([
            $_POST['news_date'] ?? '',
            $_POST['news_title'] ?? '',
            $_POST['news_description'] ?? '',
            $_POST['news_image'] ?? '',
            $newsId,
        ]);
        $message = 'Berita berhasil diperbarui.';
    }

    if ($action === 'delete_news') {
        $newsId = (int) ($_POST['news_id'] ?? 0);
        $pdo->prepare('DELETE FROM news WHERE id = ?')->execute([$newsId]);
        $message = 'Berita berhasil dihapus.';
    }

    if ($action === 'update_contact') {
        $pdo->prepare('UPDATE contact SET address = ?, email = ?, phone = ? ORDER BY id DESC LIMIT 1')->execute([
            $_POST['contact_address'] ?? $site['contact']['address'],
            $_POST['contact_email'] ?? $site['contact']['email'],
            $_POST['contact_phone'] ?? $site['contact']['phone'],
        ]);
        $message = 'Kontak berhasil diperbarui.';
    }

    $site = getSiteData($pdo);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body { background: #f5f7ff; }
        .admin-shell { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 1.5rem 1rem; position: sticky; top: 0; min-height: 100vh; }
        .sidebar .brand { font-size: 1.3rem; font-weight: 800; }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); font-weight: 600; padding: 0.8rem 1rem; border-radius: 10px; margin-bottom: 0.2rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,0.12); }
        .content { flex: 1; padding: 2rem; }
        .admin-card { background: #fff; border-radius: 22px; padding: 1.5rem; box-shadow: 0 12px 40px rgba(18, 35, 61, 0.08); border: 1px solid #edf2fb; margin-bottom: 1.5rem; }
        .admin-card h5 { color: #2d3e5d; font-weight: 800; margin-bottom: 1rem; }
        .badge-chip { display: inline-block; padding: 0.35rem 0.7rem; border-radius: 999px; font-size: 0.7rem; font-weight: 700; } 
        .table-list { background: #f9fbff; border-radius: 18px; border: 1px solid #edf2fb; padding: 1rem; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; }
        .btn-primary:hover { background: linear-gradient(135deg, #596edb 0%, #693f9d 100%); }
        .btn-danger { background: #e74c3c; border: none; }
        .input-control { border-radius: 12px; border: 1px solid #dfe7f5; padding: 0.8rem 1rem; }
        @media (max-width: 991px) {
            .admin-shell { display: block; }
            .sidebar { width: 100%; min-height: unset; position: relative; }
            .content { padding: 1rem; }
        }
    </style>
</head>
<body>
    <div class="admin-shell">
        <aside class="sidebar">
            <div class="brand d-flex align-items-center gap-2 mb-4">
                <span class="brand-icon">S</span>
                <span>Admin Panel</span>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link active" href="#school">Sekolah</a>
                <a class="nav-link" href="#hero">Hero</a>
                <a class="nav-link" href="#ppdb">PPDB</a>
                <a class="nav-link" href="#about">Tentang</a>
                <a class="nav-link" href="#programs">Program</a>
                <a class="nav-link" href="#facilities">Fasilitas</a>
                <a class="nav-link" href="#news">Berita</a>
                <a class="nav-link" href="#contact">Kontak</a>
                <a class="nav-link" href="logout.php">Keluar</a>
            </nav>
        </aside>

        <main class="content">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <h1 class="h3 fw-bold mb-0">Dashboard Admin</h1>
                    <small class="text-muted">Kelola isi website sekolah</small>
                </div>
                <a href="index.php" target="_blank" class="btn btn-primary rounded-pill">Lihat Website</a>
            </div>

            <?php if ($message): ?>
                <div class="alert alert-success rounded-3"><?= e($message) ?></div>
            <?php endif; ?>

            <section id="school" class="admin-card">
                <h5>Informasi Sekolah</h5>
                <form method="POST">
                    <input type="hidden" name="action" value="update_school">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Sekolah</label>
                        <input type="text" class="input-control w-100" name="school_name" value="<?= e($site['school']['school_name']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="input-control w-100" rows="3" name="school_description"><?= e($site['school']['description']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                </form>
            </section>

            <section id="hero" class="admin-card">
                <h5>Hero Section</h5>
                <form method="POST">
                    <input type="hidden" name="action" value="update_hero">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Badge</label>
                        <input type="text" class="input-control w-100" name="hero_badge" value="<?= e($site['hero']['badge']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul</label>
                        <input type="text" class="input-control w-100" name="hero_title" value="<?= e($site['hero']['title']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="input-control w-100" rows="3" name="hero_description"><?= e($site['hero']['description']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                </form>
            </section>

            <section id="ppdb" class="admin-card">
                <h5>PPDB</h5>
                <form method="POST">
                    <input type="hidden" name="action" value="update_ppdb">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Judul</label>
                            <input type="text" class="input-control w-100" name="ppdb_title" value="<?= e($site['ppdb']['title']) ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="number" class="input-control w-100" name="ppdb_date" value="<?= e($site['ppdb']['date_open']) ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bulan</label>
                            <input type="text" class="input-control w-100" name="ppdb_month" value="<?= e($site['ppdb']['month']) ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Tahun</label>
                            <input type="number" class="input-control w-100" name="ppdb_year" value="<?= e($site['ppdb']['year']) ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill mt-3">Simpan</button>
                </form>

                <div class="mt-4 table-list">
                    <h6 class="fw-bold mb-3">Daftar Fitur PPDB</h6>
                    <?php foreach ($site['ppdb_features'] as $feature): ?>
                        <form method="POST" class="row g-2 align-items-center mb-2">
                            <input type="hidden" name="action" value="update_feature">
                            <input type="hidden" name="feature_id" value="<?= e($feature['id'] ?? 0) ?>">
                            <div class="col-md-9">
                                <input type="text" class="input-control w-100" name="feature_text" value="<?= e($feature['feature_text']) ?>">
                            </div>
                            <div class="col-md-3 d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                <button type="submit" class="btn btn-danger btn-sm" formaction="admin.php" formmethod="post" name="action" value="delete_feature">Hapus</button>
                            </div>
                        </form>
                    <?php endforeach; ?>
                    <form method="POST" class="row g-2 mt-2">
                        <input type="hidden" name="action" value="add_feature">
                        <div class="col-md-9">
                            <input type="text" class="input-control w-100" name="feature_text" placeholder="Tambah fitur baru...">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-sm w-100">Tambah</button>
                        </div>
                    </form>
                </div>
            </section>

            <section id="about" class="admin-card">
                <h5>Tentang Sekolah</h5>
                <form method="POST">
                    <input type="hidden" name="action" value="update_about">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul</label>
                        <input type="text" class="input-control w-100" name="about_title" value="<?= e($site['about']['title']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="input-control w-100" rows="3" name="about_description"><?= e($site['about']['description']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar</label>
                        <input type="url" class="input-control w-100" name="about_image" value="<?= e($site['about']['image_url'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Visi</label>
                        <textarea class="input-control w-100" rows="2" name="about_vision"><?= e($site['about']['vision']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Misi</label>
                        <textarea class="input-control w-100" rows="2" name="about_mission"><?= e($site['about']['mission']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                </form>
            </section>

            <section id="programs" class="admin-card">
                <h5>Program</h5>
                <div class="table-list mb-3">
                    <h6 class="fw-bold mb-3">Tambah Program Baru</h6>
                    <form method="POST" class="row g-2">
                        <input type="hidden" name="action" value="add_program">
                        <div class="col-md-2"><input type="text" class="input-control w-100" name="program_icon" placeholder="01" required></div>
                        <div class="col-md-4"><input type="text" class="input-control w-100" name="program_title" placeholder="Judul program" required></div>
                        <div class="col-md-4"><input type="text" class="input-control w-100" name="program_description" placeholder="Deskripsi" required></div>
                        <div class="col-md-2"><button type="submit" class="btn btn-primary btn-sm w-100">Tambah</button></div>
                    </form>
                </div>

                <?php foreach ($site['programs'] as $program): ?>
                    <form method="POST" class="table-list mb-3">
                        <input type="hidden" name="action" value="update_program">
                        <input type="hidden" name="program_id" value="<?= e($program['id']) ?>">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-2"><input type="text" class="input-control w-100" name="program_icon" value="<?= e($program['icon']) ?>"></div>
                            <div class="col-md-3"><input type="text" class="input-control w-100" name="program_title" value="<?= e($program['title']) ?>"></div>
                            <div class="col-md-5"><input type="text" class="input-control w-100" name="program_description" value="<?= e($program['description']) ?>"></div>
                            <div class="col-md-2 d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-sm flex-grow-1">Update</button>
                                <button type="submit" class="btn btn-danger btn-sm" formaction="admin.php" formmethod="post" name="action" value="delete_program">Hapus</button>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </section>

            <section id="facilities" class="admin-card">
                <h5>Fasilitas</h5>
                <div class="table-list mb-3">
                    <h6 class="fw-bold mb-3">Tambah Fasilitas</h6>
                    <form method="POST" class="row g-2">
                        <input type="hidden" name="action" value="add_facility">
                        <div class="col-md-3"><input type="text" class="input-control w-100" name="facility_icon" placeholder="bi-star" required></div>
                        <div class="col-md-5"><input type="text" class="input-control w-100" name="facility_name" placeholder="Nama fasilitas" required></div>
                        <div class="col-md-2"><input type="text" class="input-control w-100" name="facility_description" placeholder="Deskripsi" required></div>
                        <div class="col-md-2"><button type="submit" class="btn btn-primary btn-sm w-100">Tambah</button></div>
                    </form>
                </div>
                <?php foreach ($site['facilities'] as $facility): ?>
                    <form method="POST" class="table-list mb-3">
                        <input type="hidden" name="action" value="update_facility">
                        <input type="hidden" name="facility_id" value="<?= e($facility['id']) ?>">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-3"><input type="text" class="input-control w-100" name="facility_icon" value="<?= e($facility['icon']) ?>"></div>
                            <div class="col-md-5"><input type="text" class="input-control w-100" name="facility_name" value="<?= e($facility['name']) ?>"></div>
                            <div class="col-md-2"><input type="text" class="input-control w-100" name="facility_description" value="<?= e($facility['description'] ?? '') ?>"></div>
                            <div class="col-md-2 d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-sm flex-grow-1">Update</button>
                                <button type="submit" class="btn btn-danger btn-sm" formaction="admin.php" formmethod="post" name="action" value="delete_facility">Hapus</button>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </section>

            <section id="news" class="admin-card">
                <h5>Berita & Kegiatan</h5>
                <div class="table-list mb-3">
                    <h6 class="fw-bold mb-3">Tambah Berita</h6>
                    <form method="POST" class="row g-2">
                        <input type="hidden" name="action" value="add_news">
                        <div class="col-md-3"><input type="text" class="input-control w-100" name="news_date" placeholder="01 September 2026" required></div>
                        <div class="col-md-3"><input type="text" class="input-control w-100" name="news_title" placeholder="Judul berita" required></div>
                        <div class="col-md-3"><input type="text" class="input-control w-100" name="news_description" placeholder="Deskripsi" required></div>
                        <div class="col-md-3"><input type="url" class="input-control w-100" name="news_image" placeholder="URL Gambar" required></div>
                        <div class="col-md-12"><button type="submit" class="btn btn-primary btn-sm">Tambah</button></div>
                    </form>
                </div>
                <?php foreach ($site['news'] as $news): ?>
                    <form method="POST" class="table-list mb-3">
                        <input type="hidden" name="action" value="update_news">
                        <input type="hidden" name="news_id" value="<?= e($news['id']) ?>">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-2"><input type="text" class="input-control w-100" name="news_date" value="<?= e($news['date_publish']) ?>"></div>
                            <div class="col-md-3"><input type="text" class="input-control w-100" name="news_title" value="<?= e($news['title']) ?>"></div>
                            <div class="col-md-3"><input type="text" class="input-control w-100" name="news_description" value="<?= e($news['description']) ?>"></div>
                            <div class="col-md-2"><input type="url" class="input-control w-100" name="news_image" value="<?= e($news['image_url']) ?>"></div>
                            <div class="col-md-2 d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-sm flex-grow-1">Update</button>
                                <button type="submit" class="btn btn-danger btn-sm" formaction="admin.php" formmethod="post" name="action" value="delete_news">Hapus</button>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </section>

            <section id="contact" class="admin-card">
                <h5>Kontak</h5>
                <form method="POST">
                    <input type="hidden" name="action" value="update_contact">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <input type="text" class="input-control w-100" name="contact_address" value="<?= e($site['contact']['address']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="input-control w-100" name="contact_email" value="<?= e($site['contact']['email']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Telepon</label>
                        <input type="tel" class="input-control w-100" name="contact_phone" value="<?= e($site['contact']['phone']) ?>">
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                </form>
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
