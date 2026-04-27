# LAMPIRAN F - LAPORAN PENGUJIAN

## Informasi Pengujian
- **Penguji**: Riphan Romadlon (QA & Dokumentasi)
- **Tanggal**: 22-25 Maret 2025
- **Versi Aplikasi**: 1.0.0

## Test Cases

### TC-01: Login Admin
| Field | Value |
|-------|-------|
| **Input** | email: admin@siperpus.test, password: admin123 |
| **Expected** | Redirect ke /admin/dashboard |
| **Result** | ✅ PASS |

### TC-02: Login Member
| Field | Value |
|-------|-------|
| **Input** | email: member@siperpus.test, password: member123 |
| **Expected** | Redirect ke /member/dashboard |
| **Result** | ✅ PASS |

### TC-03: Login Gagal
| Field | Value |
|-------|-------|
| **Input** | email: wrong@test.com, password: wrongpass |
| **Expected** | Menampilkan pesan error |
| **Result** | ✅ PASS |

### TC-04: Akses Admin oleh Member
| Field | Value |
|-------|-------|
| **Input** | Member mencoba akses /admin/dashboard |
| **Expected** | Error 403 - Access Denied |
| **Result** | ✅ PASS |

### TC-05: Tambah Buku
| Field | Value |
|-------|-------|
| **Input** | Data buku lengkap |
| **Expected** | Buku tersimpan di database |
| **Result** | ✅ PASS |

### TC-06: Buat Peminjaman
| Field | Value |
|-------|-------|
| **Input** | Pilih anggota dan buku |
| **Expected** | Peminjaman dibuat, stok berkurang |
| **Result** | ✅ PASS |

### TC-07: Proses Pengembalian - Tepat Waktu
| Field | Value |
|-------|-------|
| **Input** | Tanggal kembali <= due date |
| **Expected** | Fine = 0, status = returned |
| **Result** | ✅ PASS |

### TC-08: Proses Pengembalian - Terlambat
| Field | Value |
|-------|-------|
| **Input** | Tanggal kembali 3 hari setelah due date |
| **Expected** | Fine = 3 x 1000 = Rp 3.000 |
| **Result** | ✅ PASS |

### TC-09: OPAC Pencarian Buku
| Field | Value |
|-------|-------|
| **Input** | Kata kunci "Laskar" |
| **Expected** | Menampilkan buku "Laskar Pelangi" |
| **Result** | ✅ PASS |

### TC-10: Upload E-Resource
| Field | Value |
|-------|-------|
| **Input** | File PDF atau URL link |
| **Expected** | E-Resource tersimpan |
| **Result** | ✅ PASS |

## Summary
| Total Test Cases | Pass | Fail | Pass Rate |
|-----------------|------|------|-----------|
| 10 | 10 | 0 | 100% |

---
*Kelompok 6 - Tugas Manajemen Proyek SI*
