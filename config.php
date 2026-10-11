<?php
session_start();

define('APP_NAME', 'Sekolah Pintar');

$users = [
    'admin' => 'admin123',
    'siswa' => 'siswa123',
];

function redirect($url) {
    header('Location: ' . $url);
    exit;
}
