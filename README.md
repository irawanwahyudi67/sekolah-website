# Sekolah Pintar Premium Website

Project ini adalah situs web sekolah premium dengan login admin, dashboard, dan data yang disimpan di MySQL.

## Fitur
- Landing page sekolah premium modern
- Login admin dan user
- Dashboard pengguna
- Admin panel untuk edit semua konten
- Data disimpan di database MySQL
- Responsive untuk desktop dan mobile

## Persyaratan
- PHP 8+
- MySQL / MariaDB
- Apache / Nginx
- XAMPP / Laragon / WAMP

## Cara Menjalankan
1. Buat database MySQL dengan nama `sekolah_pintar`
2. Pastikan MySQL berjalan di localhost dengan user `root` dan password kosong
3. Copy semua file ke folder web server Anda (contoh: `htdocs/sekolah-website`)
4. Jalankan browser:
   `http://localhost/sekolah-website/index.php`
5. Login:
   - Admin: `admin` / `admin123`
   - User: `siswa` / `siswa123`

## Admin Panel
- Akses: `http://localhost/sekolah-website/admin.php`
- Login admin hanya bisa menggunakan akun admin.

## Struktur Proyek
```bash
sekolah-website/
├── admin.php
├── config.php
├── database.php
├── dashboard.php
├── index.php
├── login.php
├── logout.php
├── assets/
│   ├── css/style.css
│   └── js/script.js
├── README.md
└── .gitignore
```

## Zip Download
Github branch ZIP:
https://github.com/irawanwahyudi67/sekolah-website/archive/refs/heads/improve-design.zip
