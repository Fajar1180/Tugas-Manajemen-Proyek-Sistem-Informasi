# LAMPIRAN C - SOFTWARE REQUIREMENTS SPECIFICATION (SRS)
# SIPERPUS - Sistem Informasi Perpustakaan Berbasis Web

## 1. Pendahuluan

### 1.1 Tujuan
Dokumen ini mendeskripsikan kebutuhan fungsional dan non-fungsional untuk sistem SIPERPUS.

### 1.2 Ruang Lingkup
SIPERPUS adalah aplikasi web untuk mengelola perpustakaan Universitas Kebangsaan Republik Indonesia, mencakup manajemen buku, anggota, peminjaman, pengembalian, denda, dan sumber daya digital.

## 2. Kebutuhan Fungsional

### 2.1 Modul Autentikasi
| ID | Deskripsi |
|----|-----------|
| F-01 | Sistem menyediakan halaman login untuk admin dan anggota |
| F-02 | Sistem membedakan hak akses berdasarkan role (admin/member) |
| F-03 | Sistem menyediakan fitur logout |

### 2.2 Modul OPAC (Online Public Access Catalog)
| ID | Deskripsi |
|----|-----------|
| F-04 | Pengunjung dapat mencari buku berdasarkan judul, pengarang, ISBN |
| F-05 | Pengunjung dapat memfilter buku berdasarkan kategori |
| F-06 | Pengunjung dapat melihat detail buku termasuk ketersediaan |

### 2.3 Modul Manajemen Buku (Admin)
| ID | Deskripsi |
|----|-----------|
| F-07 | Admin dapat menambah, mengubah, menghapus data buku |
| F-08 | Admin dapat mengelola kategori buku |
| F-09 | Admin dapat mengupload cover buku |
| F-10 | Sistem menampilkan statistik stok buku |

### 2.4 Modul Manajemen Anggota (Admin)
| ID | Deskripsi |
|----|-----------|
| F-11 | Admin dapat menambah, mengubah, menghapus data anggota |
| F-12 | Admin dapat melihat riwayat peminjaman anggota |

### 2.5 Modul Peminjaman (Admin)
| ID | Deskripsi |
|----|-----------|
| F-13 | Admin dapat membuat transaksi peminjaman |
| F-14 | Sistem otomatis menghitung tanggal jatuh tempo |
| F-15 | Sistem menampilkan status peminjaman (dipinjam/dikembalikan) |
| F-16 | Sistem menandai peminjaman yang terlambat |

### 2.6 Modul Pengembalian (Admin)
| ID | Deskripsi |
|----|-----------|
| F-17 | Admin dapat memproses pengembalian buku |
| F-18 | Sistem otomatis menghitung denda keterlambatan |
| F-19 | Admin dapat mencatat pembayaran denda |

### 2.7 Modul E-Resources
| ID | Deskripsi |
|----|-----------|
| F-20 | Admin dapat upload file digital atau menambahkan link |
| F-21 | Anggota dapat mengakses E-Resources |

### 2.8 Modul Dashboard Member
| ID | Deskripsi |
|----|-----------|
| F-22 | Anggota dapat melihat riwayat peminjaman |
| F-23 | Anggota dapat melihat status peminjaman aktif |

## 3. Kebutuhan Non-Fungsional

| ID | Kategori | Deskripsi |
|----|----------|-----------|
| NF-01 | Performa | Halaman memuat dalam < 3 detik |
| NF-02 | Keamanan | Autentikasi wajib untuk fitur sensitif |
| NF-03 | Kegunaan | Antarmuka responsif untuk mobile |
| NF-04 | Keandalan | Uptime minimal 99% |
| NF-05 | Skalabilitas | Dapat menangani 1000 pengguna concurrent |

---
*Dibuat oleh: Rahayu Padilah (System Analyst)*
*Kelompok 6 - Tugas Manajemen Proyek SI*
