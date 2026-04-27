# LAMPIRAN D - SOFTWARE DESIGN DOCUMENT (SDD)
# SIPERPUS - Sistem Informasi Perpustakaan Berbasis Web

## 1. Arsitektur Sistem

### 1.1 Technology Stack
- **Backend**: Laravel 11 (PHP 8.3)
- **Frontend**: Blade Templates + Bootstrap 5
- **Database**: MySQL 8.0
- **Authentication**: Laravel Breeze
- **Build Tool**: Vite

### 1.2 Arsitektur MVC
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Controller admin
│   │   ├── Member/         # Controller member
│   │   ├── Auth/           # Controller autentikasi
│   │   └── OpacController  # Controller publik
│   └── Middleware/
│       └── AdminMiddleware # Proteksi route admin
├── Models/                 # Eloquent models
└── ...
```

## 2. Database Design (ERD)

### Tabel Utama:
- **users**: id, name, email, password, role, timestamps
- **members**: id, user_id, nim_nidn, prodi, no_hp, alamat, timestamps
- **categories**: id, name, description, timestamps
- **books**: id, isbn, title, author, publisher, year, category_id, shelf_location, stock, description, cover_image, timestamps
- **loans**: id, member_id, loan_date, due_date, status, note, timestamps
- **loan_items**: id, loan_id, book_id, qty, timestamps
- **returns**: id, loan_id, return_date, late_days, fine_amount, note, timestamps
- **fine_payments**: id, return_id, pay_date, amount, method, note, timestamps
- **eresources**: id, title, type, file_path, url, description, uploaded_by, timestamps

### Relasi:
- users 1:1 members
- members 1:N loans
- loans 1:N loan_items
- books 1:N loan_items
- categories 1:N books
- loans 1:1 returns
- returns 1:N fine_payments

## 3. Konfigurasi Bisnis

```php
// config/library.php
return [
    'loan_days' => 7,       // Durasi peminjaman
    'fine_per_day' => 1000, // Denda per hari (Rupiah)
];
```

## 4. Routing

| Prefix | Middleware | Fungsi |
|--------|-----------|--------|
| / | - | Publik (OPAC) |
| /admin | auth, admin | Panel Admin |
| /member | auth | Portal Member |

---
*Dibuat oleh: Muhammad Fajar Nurjaman (Programmer Back-end)*
*Kelompok 6 - Tugas Manajemen Proyek SI*
