<?php
// database.php - Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sekolah_pintar');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database Connection Error: " . $e->getMessage());
}

// Create tables if not exists
$pdo->exec("CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    role VARCHAR(20) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS school_info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    school_name VARCHAR(255),
    school_logo VARCHAR(255),
    description TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS hero (
    id INT PRIMARY KEY AUTO_INCREMENT,
    badge VARCHAR(255),
    title VARCHAR(255),
    description TEXT,
    image_url VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS stats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    number VARCHAR(50),
    label VARCHAR(100),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS ppdb (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    date_open INT,
    month VARCHAR(20),
    year INT,
    status VARCHAR(20),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS ppdb_features (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ppdb_id INT,
    feature_text TEXT,
    FOREIGN KEY (ppdb_id) REFERENCES ppdb(id) ON DELETE CASCADE
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS about (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description TEXT,
    image_url VARCHAR(255),
    vision TEXT,
    mission TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS programs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    icon VARCHAR(10),
    title VARCHAR(255),
    description TEXT,
    status VARCHAR(20) DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS facilities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    icon VARCHAR(50),
    name VARCHAR(255),
    description TEXT,
    status VARCHAR(20) DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS news (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date_publish VARCHAR(50),
    title VARCHAR(255),
    description TEXT,
    image_url VARCHAR(255),
    status VARCHAR(20) DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS contact (
    id INT PRIMARY KEY AUTO_INCREMENT,
    address TEXT,
    email VARCHAR(100),
    phone VARCHAR(20),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

// Insert default data if empty
$checkSchool = $pdo->query("SELECT COUNT(*) FROM school_info")->fetch();
if ($checkSchool[0] == 0) {
    $pdo->exec("INSERT INTO school_info (school_name, description) VALUES ('Sekolah Pintar', 'Website Sekolah Modern dengan Fitur Premium')");
    $pdo->exec("INSERT INTO hero (badge, title, description) VALUES ('Sekolah Unggul & Berkarakter', 'Membentuk Generasi Cerdas, Berakhlak, dan Siap Masa Depan', 'Kami menghadirkan pendidikan modern yang menggabungkan ilmu pengetahuan, kreativitas, dan karakter untuk mempersiapkan siswa menuju masa depan yang lebih cerah.')");
    $pdo->exec("INSERT INTO stats (number, label) VALUES ('15K+', 'Siswa'), ('250+', 'Guru'), ('98%', 'Lulus')");
    $pdo->exec("INSERT INTO ppdb (title, date_open, month, year, status) VALUES ('PPDB 2026', 12, 'Agustus', 2026, 'active')");
    $pdo->exec("INSERT INTO about (title, description, vision, mission) VALUES ('Sekolah yang Menumbuhkan Potensi Siswa Secara Maksimal', 'Di Sekolah Pintar, kami percaya setiap siswa memiliki bakat unik.', 'Menjadi sekolah pilihan utama yang mencetak lulusan unggul, inovatif, dan berakhlak mulia.', 'Menyediakan pembelajaran berbasis teknologi, karakter, dan pengembangan diri yang optimal.')");
    $pdo->exec("INSERT INTO contact (address, email, phone) VALUES ('Jl. Pendidikan No. 45, Kota Bandung', 'info@sekolahpintar.sch.id', '(022) 1234-5678')");
    $pdo->exec("INSERT INTO users (username, password, email, role) VALUES ('admin', '" . password_hash('admin123', PASSWORD_BCRYPT) . "', 'admin@sekolah.com', 'admin'), ('siswa', '" . password_hash('siswa123', PASSWORD_BCRYPT) . "', 'siswa@sekolah.com', 'user')");
}
?>
