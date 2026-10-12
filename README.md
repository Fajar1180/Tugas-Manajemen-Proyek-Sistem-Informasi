# SIPERPUS - Sistem Informasi Perpustakaan Berbasis Web

![Laravel](https://img.shields.io/badge/Laravel-11-red) ![PHP](https://img.shields.io/badge/PHP-8.3-blue) ![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple) ![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)

**SIPERPUS** adalah aplikasi sistem informasi perpustakaan berbasis web yang dibangun dengan Laravel 11. Sistem ini memudahkan pengelolaan perpustakaan mulai dari manajemen buku, anggota, peminjaman, pengembalian, denda, hingga sumber daya digital (E-Resources).

## 👥 Tim Pengembang

| Nama | Peran |
|------|-------|
| Muhammad Akmal Palqah | Project Manager |
| Rahayu Padilah | System Analyst |
| Ilham Al Munawar | Programmer Front-end |
| Muhammad Fajar Nurjaman | Programmer Back-end |
| Riphan Romadlon | QA & Dokumentasi |

**Universitas Kebangsaan Republik Indonesia**  
Tugas Manajemen Proyek Sistem Informasi - Kelompok 6

## ✨ Fitur Utama

### �� Autentikasi & Otorisasi
- Login multi-role (Admin & Member)
- Middleware proteksi route admin
- Redirect otomatis berdasarkan role

### 📚 OPAC (Online Public Access Catalog)
- Katalog buku yang dapat diakses publik
- Pencarian buku berdasarkan judul, pengarang, ISBN
- Filter berdasarkan kategori
- Informasi ketersediaan stok real-time

### 🛠️ Admin Panel
- **Dashboard**: Statistik ringkasan (total buku, anggota, peminjaman aktif, terlambat)
- **Manajemen Buku**: CRUD buku dengan upload cover
- **Manajemen Kategori**: Pengelompokan buku
- **Manajemen Anggota**: Data anggota dengan riwayat peminjaman
- **Peminjaman**: Buat transaksi peminjaman, pilih multiple buku
- **Pengembalian**: Proses pengembalian dengan kalkulasi denda otomatis
- **Pembayaran Denda**: Catat pembayaran denda (cash/transfer)
- **E-Resources**: Upload file digital atau tambah link eksternal

### 👤 Member Portal
- Dashboard dengan statistik peminjaman pribadi
- Riwayat peminjaman lengkap
- Status peminjaman aktif & terlambat
- Akses E-Resources

## 🚀 Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Node.js >= 18

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/Fajar1180/Tugas-Manajemen-Proyek-Sistem-Informasi.git
cd Tugas-Manajemen-Proyek-Sistem-Informasi

# 2. Install PHP dependencies
composer install

# 3. Copy .env file
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di .env
# DB_CONNECTION=mysql
# DB_DATABASE=siperpus
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Buat database
mysql -u root -e "CREATE DATABASE siperpus;"

# 7. Jalankan migrasi dan seeder
php artisan migrate --seed

# 8. Link storage
php artisan storage:link

# 9. Install dan build aset
npm install && npm run build

# 10. Jalankan server
php artisan serve
```

## 🔑 Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@siperpus.test | admin123 |
| Member | member@siperpus.test | member123 |

## 📁 Struktur Direktori

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Controller admin
│   │   │   ├── Member/         # Controller member
│   │   │   └── OpacController  # Katalog publik
│   │   └── Middleware/
│   │       └── AdminMiddleware
│   └── Models/                 # Eloquent models
├── config/
│   └── library.php             # Konfigurasi perpustakaan
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/                # Database seeders
├── docs/                       # Dokumentasi proyek
│   ├── LAMPIRAN-A-Wawancara.md
│   ├── LAMPIRAN-B-Observasi.md
│   ├── LAMPIRAN-C-SRS.md
│   ├── LAMPIRAN-D-SDD.md
│   ├── LAMPIRAN-E-Development-Log.md
│   ├── LAMPIRAN-F-Test-Report.md
│   ├── LAMPIRAN-G-UAT.md
│   └── LAMPIRAN-H-BAST.md
└── resources/
    └── views/
        ├── layouts/            # Layout templates
        ├── opac/               # Tampilan publik OPAC
        ├── admin/              # Tampilan admin
        └── member/             # Tampilan member
```

## ⚙️ Konfigurasi Perpustakaan

File `config/library.php`:
```php
return [
    'loan_days' => 7,        // Durasi peminjaman (hari)
    'fine_per_day' => 1000,  // Denda per hari (Rupiah)
];
```

## 📊 Database Schema

- **users**: Akun pengguna (admin & member)
- **members**: Data keanggotaan perpustakaan
- **categories**: Kategori buku
- **books**: Koleksi buku
- **loans**: Transaksi peminjaman
- **loan_items**: Item dalam peminjaman
- **returns**: Data pengembalian
- **fine_payments**: Pembayaran denda
- **eresources**: Sumber daya digital

## 📄 Dokumentasi

Dokumentasi lengkap tersedia di direktori `/docs`:
- Hasil wawancara dan observasi
- Software Requirements Specification (SRS)
- Software Design Document (SDD)
- Log pengembangan
- Laporan pengujian
- User Acceptance Testing (UAT)
- Berita Acara Serah Terima (BAST)

## 📜 Lisensi

Proyek ini dibuat untuk keperluan tugas akademik.  
© 2025 Kelompok 6 - Manajemen Proyek Sistem Informasi  
Universitas Kebangsaan Republik Indonesia
