# LAMPIRAN G - USER ACCEPTANCE TESTING (UAT)

## Informasi UAT
- **Tanggal**: 26-27 Maret 2025
- **Lokasi**: Perpustakaan Universitas Kebangsaan Republik Indonesia
- **Fasilitator**: Muhammad Akmal Palqah
- **Peserta**: Staff Perpustakaan (3 orang), Mahasiswa (5 orang)

## Skenario UAT

### Skenario 1: Alur Admin - Manajemen Buku
**Penguji**: Staff Perpustakaan

| Langkah | Aksi | Expected | Aktual | Status |
|---------|------|----------|--------|--------|
| 1 | Login sebagai admin | Masuk ke dashboard | Dashboard tampil | ✅ |
| 2 | Buka menu Buku | Daftar buku tampil | Tabel buku muncul | ✅ |
| 3 | Tambah buku baru | Form tampil | Form lengkap | ✅ |
| 4 | Simpan buku | Data tersimpan | Redirect ke list | ✅ |
| 5 | Edit buku | Data berubah | Update berhasil | ✅ |

### Skenario 2: Alur Admin - Peminjaman
**Penguji**: Staff Perpustakaan

| Langkah | Aksi | Expected | Aktual | Status |
|---------|------|----------|--------|--------|
| 1 | Buka menu Peminjaman | Daftar tampil | OK | ✅ |
| 2 | Buat peminjaman baru | Pilih anggota & buku | Form OK | ✅ |
| 3 | Simpan peminjaman | Data tersimpan | Sukses | ✅ |
| 4 | Proses pengembalian | Hitung denda otomatis | Kalkulasi benar | ✅ |

### Skenario 3: Alur Member
**Penguji**: Mahasiswa

| Langkah | Aksi | Expected | Aktual | Status |
|---------|------|----------|--------|--------|
| 1 | Login sebagai member | Dashboard tampil | OK | ✅ |
| 2 | Cari buku di OPAC | Hasil pencarian | Relevan | ✅ |
| 3 | Lihat detail buku | Ketersediaan | Info lengkap | ✅ |
| 4 | Lihat riwayat pinjam | Data peminjaman | Akurat | ✅ |

## Hasil Kuesioner UAT

**Pertanyaan** (Skala 1-5):

| No | Pertanyaan | Rata-rata |
|----|-----------|-----------|
| 1 | Kemudahan penggunaan | 4.6 |
| 2 | Kecepatan sistem | 4.4 |
| 3 | Tampilan antarmuka | 4.5 |
| 4 | Kelengkapan fitur | 4.7 |
| 5 | Keakuratan data | 4.8 |
| **Total** | | **4.6/5** |

## Kesimpulan UAT
Sistem SIPERPUS telah memenuhi semua kebutuhan pengguna dengan skor kepuasan 4.6/5. Sistem dinyatakan **DITERIMA** oleh pengguna.

---
*Kelompok 6 - Tugas Manajemen Proyek SI*
