<?php
require_once __DIR__ . '/config.php';

$pdo = dbConnect();

$defaultData = [
    'school_name' => 'Sekolah Pintar',
    'description' => 'Website Sekolah modern dengan fitur premium.',
    'hero_badge' => 'Sekolah Unggul & Berkarakter',
    'hero_title' => 'Membentuk Generasi Cerdas, Berakhlak, dan Siap Masa Depan',
    'hero_description' => 'Kami menghadirkan pendidikan modern yang menggabungkan ilmu pengetahuan, kreativitas, dan karakter untuk mempersiapkan siswa menuju masa depan yang lebih cerah.',
    'stats' => [
        ['number' => '15K+', 'label' => 'Siswa'],
        ['number' => '250+', 'label' => 'Guru'],
        ['number' => '98%', 'label' => 'Lulus'],
    ],
    'ppdb_title' => 'PPDB 2026',
    'ppdb_date' => '12',
    'ppdb_month' => 'Agustus',
    'ppdb_year' => '2026',
    'ppdb_features' => [
        'Kurikulum Nasional + STEM',
        'Kegiatan ekstrakurikuler lengkap',
        'Lingkungan belajar aman dan modern',
    ],
    'about_title' => 'Sekolah yang Menumbuhkan Potensi Siswa Secara Maksimal',
    'about_description' => 'Di Sekolah Pintar, kami percaya setiap siswa memiliki bakat unik. Oleh karena itu, kami menciptakan lingkungan belajar yang inspiratif, suportif, dan mendorong siswa untuk berkembang dengan percaya diri.',
    'about_image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=900&q=80',
    'about_vision' => 'Menjadi sekolah pilihan utama yang mencetak lulusan unggul, inovatif, dan berakhlak mulia.',
    'about_mission' => 'Menyediakan pembelajaran berbasis teknologi, karakter, dan pengembangan diri yang optimal.',
    'contact_address' => 'Jl. Pendidikan No. 45, Kota Bandung',
    'contact_email' => 'info@sekolahpintar.sch.id',
    'contact_phone' => '(022) 1234-5678',
];

function ensureSchema(PDO $pdo): void {
    $schema = [
        "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) NULL,
            role VARCHAR(20) DEFAULT 'user',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS school_info (
            id INT AUTO_INCREMENT PRIMARY KEY,
            school_name VARCHAR(255),
            school_logo VARCHAR(255),
            description TEXT,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS hero (
            id INT AUTO_INCREMENT PRIMARY KEY,
            badge VARCHAR(255),
            title VARCHAR(255),
            description TEXT,
            image_url VARCHAR(255),
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS stats (
            id INT AUTO_INCREMENT PRIMARY KEY,
            number VARCHAR(50),
            label VARCHAR(100),
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS ppdb (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255),
            date_open INT,
            month VARCHAR(20),
            year INT,
            status VARCHAR(20) DEFAULT 'active',
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS ppdb_features (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ppdb_id INT,
            feature_text TEXT,
            FOREIGN KEY (ppdb_id) REFERENCES ppdb(id) ON DELETE CASCADE
        )",
        "CREATE TABLE IF NOT EXISTS about (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255),
            description TEXT,
            image_url VARCHAR(255),
            vision TEXT,
            mission TEXT,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS programs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            icon VARCHAR(10),
            title VARCHAR(255),
            description TEXT,
            status VARCHAR(20) DEFAULT 'active',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS facilities (
            id INT AUTO_INCREMENT PRIMARY KEY,
            icon VARCHAR(50),
            name VARCHAR(255),
            description TEXT,
            status VARCHAR(20) DEFAULT 'active',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS news (
            id INT AUTO_INCREMENT PRIMARY KEY,
            date_publish VARCHAR(50),
            title VARCHAR(255),
            description TEXT,
            image_url VARCHAR(255),
            status VARCHAR(20) DEFAULT 'active',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS contact (
            id INT AUTO_INCREMENT PRIMARY KEY,
            address TEXT,
            email VARCHAR(100),
            phone VARCHAR(20),
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )"
    ];

    foreach ($schema as $sql) {
        $pdo->exec($sql);
    }
}

ensureSchema($pdo);

function ensureDefaultData(PDO $pdo): void {
    $schoolCount = $pdo->query('SELECT COUNT(*) as total FROM school_info')->fetch()['total'];
    if ($schoolCount > 0) {
        return;
    }

    $pdo->prepare('INSERT INTO school_info (school_name, description) VALUES (?, ?)')->execute(['Sekolah Pintar', 'Website Sekolah modern dengan fitur premium.']);
    $pdo->prepare('INSERT INTO hero (badge, title, description) VALUES (?, ?, ?)')->execute(['Sekolah Unggul & Berkarakter', 'Membentuk Generasi Cerdas, Berakhlak, dan Siap Masa Depan', 'Kami menghadirkan pendidikan modern yang menggabungkan ilmu pengetahuan, kreativitas, dan karakter untuk mempersiapkan siswa menuju masa depan yang lebih cerah.']);
    $pdo->prepare('INSERT INTO stats (number, label) VALUES (?, ?)')->execute(['15K+', 'Siswa']);
    $pdo->prepare('INSERT INTO stats (number, label) VALUES (?, ?)')->execute(['250+', 'Guru']);
    $pdo->prepare('INSERT INTO stats (number, label) VALUES (?, ?)')->execute(['98%', 'Lulus']);
    $pdo->prepare('INSERT INTO ppdb (title, date_open, month, year, status) VALUES (?, ?, ?, ?, ?)')->execute(['PPDB 2026', 12, 'Agustus', 2026, 'active']);
    $ppdbId = (int) $pdo->lastInsertId();
    $pdo->prepare('INSERT INTO ppdb_features (ppdb_id, feature_text) VALUES (?, ?)')->execute([$ppdbId, 'Kurikulum Nasional + STEM']);
    $pdo->prepare('INSERT INTO ppdb_features (ppdb_id, feature_text) VALUES (?, ?)')->execute([$ppdbId, 'Kegiatan ekstrakurikuler lengkap']);
    $pdo->prepare('INSERT INTO ppdb_features (ppdb_id, feature_text) VALUES (?, ?)')->execute([$ppdbId, 'Lingkungan belajar aman dan modern']);
    $pdo->prepare('INSERT INTO about (title, description, vision, mission, image_url) VALUES (?, ?, ?, ?, ?)')->execute(['Sekolah yang Menumbuhkan Potensi Siswa Secara Maksimal', 'Di Sekolah Pintar, kami percaya setiap siswa memiliki bakat unik. Oleh karena itu, kami menciptakan lingkungan belajar yang inspiratif, suportif, dan mendorong siswa untuk berkembang dengan percaya diri.', 'Menjadi sekolah pilihan utama yang mencetak lulusan unggul, inovatif, dan berakhlak mulia.', 'Menyediakan pembelajaran berbasis teknologi, karakter, dan pengembangan diri yang optimal.', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=900&q=80']);
    $pdo->prepare('INSERT INTO programs (icon, title, description) VALUES (?, ?, ?)')->execute(['01', 'STEM & Robotics', 'Belajar coding, robotika, dan sains dengan pendekatan praktik yang menyenangkan.']);
    $pdo->prepare('INSERT INTO programs (icon, title, description) VALUES (?, ?, ?)')->execute(['02', 'Bahasa & Literasi', 'Menumbuhkan kemampuan komunikasi, membaca, dan berpikir kritis sejak dini.']);
    $pdo->prepare('INSERT INTO programs (icon, title, description) VALUES (?, ?, ?)')->execute(['03', 'Olahraga & Seni', 'Menyalurkan bakat siswa melalui olahraga, musik, tari, dan kegiatan kreatif.']);
    $pdo->prepare('INSERT INTO facilities (icon, name, description) VALUES (?, ?, ?)')->execute(['bi-mortarboard-fill', 'Laboratorium', 'Laboratorium sains dan inovasi']);
    $pdo->prepare('INSERT INTO facilities (icon, name, description) VALUES (?, ?, ?)')->execute(['bi-laptop', 'Lab Komputer', 'Komputer modern dan pembelajaran digital']);
    $pdo->prepare('INSERT INTO facilities (icon, name, description) VALUES (?, ?, ?)')->execute(['bi-book-half', 'Perpustakaan', 'Tempat membaca dan belajar']);
    $pdo->prepare('INSERT INTO facilities (icon, name, description) VALUES (?, ?, ?)')->execute(['bi-dribbble', 'Lapangan Olahraga', 'Olahraga dan kegiatan fisik']);
    $pdo->prepare('INSERT INTO news (date_publish, title, description, image_url) VALUES (?, ?, ?, ?)')->execute(['12 Agustus 2026', 'Workshop Robotika untuk Siswa Kelas 7', 'Program inovasi berbasis STEM membantu siswa memecahkan masalah dengan cara kreatif.', 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80']);
    $pdo->prepare('INSERT INTO news (date_publish, title, description, image_url) VALUES (?, ?, ?, ?)')->execute(['20 Agustus 2026', 'Seminar Kewirausahaan Mahasiswa Muda', 'Mengembangkan jiwa entrepreneurship agar siswa siap menjadi pemimpin masa depan.', 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=800&q=80']);
    $pdo->prepare('INSERT INTO news (date_publish, title, description, image_url) VALUES (?, ?, ?, ?)')->execute(['01 September 2026', 'Festival Seni Budaya Sekolah', 'Menampilkan kreativitas siswa dalam seni, musik, dan budaya lokal.', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80']);
    $pdo->prepare('INSERT INTO contact (address, email, phone) VALUES (?, ?, ?)')->execute(['Jl. Pendidikan No. 45, Kota Bandung', 'info@sekolahpintar.sch.id', '(022) 1234-5678']);
    $pdo->prepare('INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)')->execute(['admin', password_hash('admin123', PASSWORD_BCRYPT), 'admin@sekolah.com', 'admin']);
    $pdo->prepare('INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)')->execute(['siswa', password_hash('siswa123', PASSWORD_BCRYPT), 'siswa@sekolah.com', 'user']);
}

ensureDefaultData($pdo);
