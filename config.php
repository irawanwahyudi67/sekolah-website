<?php
session_start();

function dbConnect() {
    $host = 'localhost';
    $db   = 'sekolah_pintar';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}

try {
    $pdo = dbConnect();
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

define('APP_NAME', 'Sekolah Pintar');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sekolah_pintar');

define('BASE_URL', 'http://localhost/sekolah-website');

function redirect($url) {
    header('Location: ' . $url);
    exit;
}

function e($value) {
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function isLoggedIn() {
    return !empty($_SESSION['user_id']);
}

function isAdmin() {
    return isLoggedIn() && ($_SESSION['role'] ?? '') === 'admin';
}

function getSiteData(PDO $pdo) {
    $school = $pdo->query("SELECT * FROM school_info ORDER BY id DESC LIMIT 1")->fetch();
    $hero = $pdo->query("SELECT * FROM hero ORDER BY id DESC LIMIT 1")->fetch();
    $stats = $pdo->query("SELECT * FROM stats ORDER BY id ASC")->fetchAll();
    $ppdb = $pdo->query("SELECT * FROM ppdb ORDER BY id DESC LIMIT 1")->fetch();
    $ppdbFeatures = $pdo->query("SELECT feature_text FROM ppdb_features WHERE ppdb_id = " . (int) ($ppdb['id'] ?? 0) . " ORDER BY id ASC")->fetchAll();
    $about = $pdo->query("SELECT * FROM about ORDER BY id DESC LIMIT 1")->fetch();
    $programs = $pdo->query("SELECT * FROM programs WHERE status = 'active' ORDER BY id ASC")->fetchAll();
    $facilities = $pdo->query("SELECT * FROM facilities WHERE status = 'active' ORDER BY id ASC")->fetchAll();
    $news = $pdo->query("SELECT * FROM news WHERE status = 'active' ORDER BY id DESC")->fetchAll();
    $contact = $pdo->query("SELECT * FROM contact ORDER BY id DESC LIMIT 1")->fetch();

    return [
        'school' => $school ?: ['school_name' => APP_NAME, 'school_logo' => '', 'description' => 'Website Sekolah modern'],
        'hero' => $hero ?: ['badge' => 'Sekolah Unggul & Berkarakter', 'title' => 'Membentuk Generasi Cerdas, Berakhlak, dan Siap Masa Depan', 'description' => 'Kami menghadirkan pendidikan modern yang menggabungkan ilmu pengetahuan, kreativitas, dan karakter untuk mempersiapkan siswa menuju masa depan yang lebih cerah.'],
        'stats' => $stats ?: [
            ['number' => '15K+', 'label' => 'Siswa'],
            ['number' => '250+', 'label' => 'Guru'],
            ['number' => '98%', 'label' => 'Lulus'],
        ],
        'ppdb' => $ppdb ?: ['title' => 'PPDB 2026', 'date_open' => 12, 'month' => 'Agustus', 'year' => 2026],
        'ppdb_features' => $ppdbFeatures ?: [['feature_text' => 'Kurikulum Nasional + STEM'], ['feature_text' => 'Kegiatan ekstrakurikuler lengkap'], ['feature_text' => 'Lingkungan belajar aman dan modern']],
        'about' => $about ?: ['title' => 'Sekolah yang Menumbuhkan Potensi Siswa Secara Maksimal', 'description' => 'Di Sekolah Pintar, kami percaya setiap siswa memiliki bakat unik.', 'vision' => 'Menjadi sekolah pilihan utama yang mencetak lulusan unggul, inovatif, dan berakhlak mulia.', 'mission' => 'Menyediakan pembelajaran berbasis teknologi, karakter, dan pengembangan diri yang optimal.'],
        'programs' => $programs ?: [
            ['icon' => '01', 'title' => 'STEM & Robotics', 'description' => 'Belajar coding, robotika, dan sains dengan pendekatan praktik yang menyenangkan.'],
            ['icon' => '02', 'title' => 'Bahasa & Literasi', 'description' => 'Menumbuhkan kemampuan komunikasi, membaca, dan berpikir kritis sejak dini.'],
            ['icon' => '03', 'title' => 'Olahraga & Seni', 'description' => 'Menyalurkan bakat siswa melalui olahraga, musik, tari, dan kegiatan kreatif.'],
        ],
        'facilities' => $facilities ?: [
            ['icon' => 'bi-mortarboard-fill', 'name' => 'Laboratorium'],
            ['icon' => 'bi-laptop', 'name' => 'Lab Komputer'],
            ['icon' => 'bi-book-half', 'name' => 'Perpustakaan'],
            ['icon' => 'bi-dribbble', 'name' => 'Lapangan Olahraga'],
        ],
        'news' => $news ?: [
            ['date_publish' => '12 Agustus 2026', 'title' => 'Workshop Robotika untuk Siswa Kelas 7', 'description' => 'Program inovasi berbasis STEM membantu siswa memecahkan masalah dengan cara kreatif.', 'image_url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80'],
            ['date_publish' => '20 Agustus 2026', 'title' => 'Seminar Kewirausahaan Mahasiswa Muda', 'description' => 'Mengembangkan jiwa entrepreneurship agar siswa siap menjadi pemimpin masa depan.', 'image_url' => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=800&q=80'],
            ['date_publish' => '01 September 2026', 'title' => 'Festival Seni Budaya Sekolah', 'description' => 'Menampilkan kreativitas siswa dalam seni, musik, dan budaya lokal.', 'image_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80'],
        ],
        'contact' => $contact ?: ['address' => 'Jl. Pendidikan No. 45, Kota Bandung', 'email' => 'info@sekolahpintar.sch.id', 'phone' => '(022) 1234-5678'],
    ];
}
