<?php
/**
 * Sekolah Pintar - Configuration File
 * Konfigurasi utama aplikasi & akun demo
 */

// Start session untuk login management
session_start();

// ========== KONFIGURASI APLIKASI ==========
define('APP_NAME', 'Sekolah Pintar');
define('APP_VERSION', '1.0.0');
define('APP_DESCRIPTION', 'Website Sekolah Modern dengan Landing Page, Login, dan Dashboard');

// ========== KONFIGURASI KEAMANAN ==========
define('SESSION_TIMEOUT', 3600); // 1 jam
define('ALLOW_EMPTY_SESSION', false); // Keamanan: jangan allow session kosong

// ========== DATA AKUN DEMO ==========
// Username => Password (plaintext untuk demo, gunakan password_hash() di production)
$users = [
    'admin' => password_hash('admin123', PASSWORD_DEFAULT), // Admin account
    'siswa' => password_hash('siswa123', PASSWORD_DEFAULT), // Student account
];

// Role untuk setiap user (untuk role-based access control nanti)
$user_roles = [
    'admin' => 'Administrator',
    'siswa' => 'Siswa',
];

// ========== DATA SEKOLAH (HARDCODED - BISA DIGANTI KE DATABASE) ==========
$school_data = [
    'name' => 'SMTA Negeri 1 Pintar',
    'address' => 'Jl. Pendidikan No. 123, Kota Pintar, Provinsi Jawa Tengah',
    'phone' => '(0271) 123-4567',
    'email' => 'info@sekolahpintar.sch.id',
    'website' => 'https://sekolahpintar.sch.id',
    'established' => '1995',
    'students' => 1250,
    'teachers' => 85,
    'classes' => 45,
    'headmaster' => 'Drs. Budi Santoso, M.Pd.',
    'vision' => 'Menghasilkan lulusan yang berkarakter, cerdas, dan berakhlak mulia',
    'mission' => 'Menyediakan pendidikan berkualitas dengan metode pembelajaran inovatif dan berwawasan global'
];

// ========== FUNGSI HELPER ==========

/**
 * Redirect ke halaman lain
 * @param string $url - URL tujuan
 */
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

/**
 * Cek apakah user sudah login
 * @return bool
 */
function is_logged_in() {
    return isset($_SESSION['username']);
}

/**
 * Cek apakah user adalah admin
 * @return bool
 */
function is_admin() {
    return isset($_SESSION['username']) && $_SESSION['username'] === 'admin';
}

/**
 * Dapatkan nama user yang login
 * @return string
 */
function get_current_user() {
    return $_SESSION['username'] ?? 'Guest';
}

/**
 * Dapatkan role user
 * @return string
 */
function get_user_role() {
    global $user_roles;
    $username = get_current_user();
    return $user_roles[$username] ?? 'User';
}

/**
 * Sanitasi input untuk keamanan
 * @param string $input
 * @return string
 */
function sanitize_input($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Verify password dengan hashing
 * @param string $password - Password plain
 * @param string $hash - Hash dari database
 * @return bool
 */
function verify_password($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Generate token untuk CSRF protection (future use)
 * @return string
 */
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token (future use)
 * @param string $token
 * @return bool
 */
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

?>