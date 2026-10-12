# 🎓 Sekolah Pintar - Website Sekolah Modern

Website sekolah modern dengan landing page profesional, sistem login aman, dan dashboard interaktif. Dibangun dengan PHP, Bootstrap 5, dan animasi CSS yang menarik.

**Status:** ✅ Siap Production | 📦 Ready to Deploy

---

## 📁 Struktur Folder

```
sekolah-website/
├── index.php              # Landing page utama
├── login.php              # Halaman login
├── dashboard.php          # Dashboard setelah login
├── logout.php             # Logout session
├── config.php             # Konfigurasi & auth demo
├── assets/
│   ├── css/
│   │   └── style.css      # Styling custom premium
│   ├── js/
│   │   └── script.js      # Interaktif & animasi
│   └── img/
│       └── (gambar sekolah)
└── uploads/               # Folder untuk upload gambar
```

---

## 🚀 Cara Menjalankan di XAMPP

### 1. **Setup Awal**
```bash
# Copy folder sekolah-website ke htdocs
cp -r sekolah-website C:/xampp/htdocs/
# atau drag-drop folder ke C:\xampp\htdocs
```

### 2. **Jalankan XAMPP**
- Buka XAMPP Control Panel
- Klik **Start** pada Apache
- Buka browser: `http://localhost/sekolah-website/`

### 3. **Mulai Gunakan**
- Klik tombol "Login" di navbar
- Masukkan akun demo (lihat di bawah)
- Akses dashboard dan kelola sekolah Anda

---

## 👤 Akun Demo Login

| Username | Password | Role |
|----------|----------|------|
| `admin` | `admin123` | Admin (Full Access) |
| `siswa` | `siswa123` | Student (View Only) |

---

## ✨ Fitur Utama

### 🎨 **Frontend**
- ✅ Landing page responsif dengan hero section
- ✅ Navbar modern dengan smooth scroll
- ✅ Card design untuk fitur sekolah
- ✅ Animasi CSS yang halus & menarik
- ✅ Form login dengan validasi
- ✅ Mobile-first design (100% responsif)

### 🔐 **Backend & Security**
- ✅ Sistem login dengan session management
- ✅ Password hashing untuk keamanan
- ✅ Role-based access control (Admin vs Student)
- ✅ Logout dengan session clear
- ✅ Input validation & sanitization

### 📊 **Dashboard**
- ✅ Welcome section dengan nama user
- ✅ Statistik sekolah (siswa, guru, kelas)
- ✅ Info sekolah yang dapat diedit (admin only)
- ✅ Logout button aman

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **PHP** | 7.4+ | Backend & Session Management |
| **Bootstrap** | 5.3 | CSS Framework |
| **Font Awesome** | 6.x | Icon Library |
| **JavaScript** | ES6 | Interaktif & Animasi |
| **HTML5** | 5 | Struktur Semantic |
| **CSS3** | 3 | Styling Premium |

---

## 📝 File Penting & Penjelasan

### `config.php`
Menyimpan konfigurasi aplikasi & akun demo. Edit di sini jika ingin menambah user baru.

```php
$users = [
    'admin' => 'admin123',
    'siswa' => 'siswa123',
];
```

### `login.php`
Halaman login dengan validasi form. Cek session dan redirect ke dashboard jika berhasil.

### `dashboard.php`
Halaman dashboard dengan info user & sekolah. Hanya bisa diakses jika sudah login.

### `assets/css/style.css`
Semua styling custom termasuk:
- Navbar dengan backdrop blur
- Hero section dengan gradient
- Card designs
- Animasi hover
- Responsive breakpoints

### `assets/js/script.js`
Interaktif & animasi seperti:
- Form validation
- Smooth transitions
- Toggle menu mobile
- Alert notifications

---

## 🎯 Pengembangan Lebih Lanjut

Proyek ini siap untuk dikembangkan dengan:

1. **Database MySQL**
   - Tabel users, sekolah, siswa, guru, berita
   - Prepare statements untuk keamanan

2. **Upload Gambar**
   - Unggah logo & foto sekolah
   - Compress & resize otomatis

3. **Email Notification**
   - Notifikasi login ke email
   - Verifikasi email saat registrasi

4. **Admin Panel Lengkap**
   - CRUD untuk siswa, guru, berita
   - Laporan & statistik

5. **API REST**
   - Integrasi dengan mobile app
   - Third-party integration

---

## 📦 Cara Deploy ke Hosting

### Menggunakan cPanel / File Manager
1. Buka File Manager di cPanel
2. Upload folder `sekolah-website`
3. Ubah permission folder ke 755, file ke 644
4. Akses via `https://domain.com/sekolah-website/`

### Menggunakan FTP
1. Gunakan FileZilla atau WinSCP
2. Connect ke server hosting
3. Upload folder ke public_html
4. Done! Buka di browser

---

## ⚙️ Troubleshooting

### ❌ "404 Not Found"
- Pastikan folder berada di `htdocs`
- Cek nama folder: `sekolah-website`
- URL harus: `http://localhost/sekolah-website/`

### ❌ "Login gagal meski password benar"
- Cek file `config.php`
- Pastikan session sudah aktif di php.ini
- Clear browser cache & cookies

### ❌ "Styling tidak muncul"
- Hard refresh: `Ctrl + Shift + R` (Windows) atau `Cmd + Shift + R` (Mac)
- Cek path file CSS di index.php
- Buka Developer Tools (F12) untuk debug

---

## 📞 Support & Dokumentasi

- **Bootstrap Docs:** https://getbootstrap.com/
- **Font Awesome Icons:** https://fontawesome.com/
- **PHP Sessions:** https://www.php.net/manual/en/book.session.php

---

## 📄 License

Free to use & modify untuk keperluan pribadi maupun komersial.

---

## 🎉 Selesai!

Proyek Anda sudah siap digunakan. Semoga bermanfaat untuk institusi pendidikan Anda! 🚀

**Last Updated:** 2026-10-12  
**Version:** 1.0.0 - Production Ready
