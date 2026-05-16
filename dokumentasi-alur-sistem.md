# SIBAKSO — Dokumentasi Alur Sistem

**Bakso Ayam 234** — Bangkinang, Kampar, Riau

---

## 1. Arsitektur Aplikasi

| Komponen | Detail |
|----------|--------|
| Framework | Laravel 12 |
| Admin Panel | Filament 3 |
| Frontend | Tailwind CSS 4 + Vite |
| Database | MySQL (production) / SQLite `:memory:` (testing) |
| Testing | Pest 4 |
| Queue/Cache/Session | Database |

### Dua Panel

| Panel | Path | Role | Middleware |
|-------|------|------|-----------|
| Admin | `/admin` | `admin` | `Authenticate` + `adminCheck` |
| Karyawan | `/karyawan` | `karyawan` | `Authenticate` |

---

## 2. Struktur Tabel

| Tabel | Kolom Penting |
|-------|--------------|
| `users` | id, name, email, password, role (admin/karyawan) |
| `pelanggans` | id, nama, alamat, nohp |
| `pesanans` | id, pelanggan_id (FK), nama_pelanggan, jenis_bakso, jumlah, alamat, no_hp, tanggal_ambil, status_pembayaran, status_produksi |
| `produksis` | id, pesanan_id (FK), user_id (FK), tanggal_produksi, jumlah_produksi, keterangan |
| `bahan_bakus` | id, nama_bahan, stok, satuan, minimum_stok |
| `produksi_details` | id, produksi_id (FK), bahan_baku_id (FK), jumlah_digunakan |
| `stok_logs` | id, bahan_baku_id (FK), user_id (FK), jenis (masuk/keluar), jumlah, stok_sebelum, stok_sesudah |
| `pemasoks` | id, nama_toko, alamat, nohp |
| `pembelians` | id, pemasok_id (FK), bahan_baku_id (FK), jumlah, tgl_beli, harga |

---

## 3. Alur Bisnis Lengkap

### A. Alur Pelanggan & Pesanan

```
1. Admin buka menu Data Pelanggan → Tambah Pelanggan
     (isi: nama, alamat, nohp)

2. Admin buka menu Manajemen Pesanan → Tambah Pesanan
     - Pilih Pelanggan dari dropdown (data sudah tersimpan)
     - Isi: jenis bakso, jumlah, tanggal ambil, status pembayaran
     - Status produksi otomatis: "menunggu"

   Status Pesanan: menunggu → diproduksi → selesai
```

### B. Alur Produksi (Karyawan)

```
1. Karyawan login ke panel /karyawan

2. Buka halaman Ambil Pesanan
     - Lihat daftar pesanan dengan status "menunggu"
     - Klik "Ambil Produksi" pada salah satu pesanan
     - Sistem otomatis membuat Produksi baru
     - Status pesanan berubah menjadi "diproduksi"

3. Buka halaman Produksi Saya
     - Lihat daftar produksi yang sedang dikerjakan
     - Input bahan baku yang digunakan (nama bahan + jumlah)
     - SETIAP kali input: stok bahan baku OTOMATIS BERKURANG
     - Dicatat di StokLog dengan jenis "keluar"

4. Klik "Selesaikan Produksi"
     - Status pesanan berubah menjadi "selesai"
     - Produksi selesai dan siap diambil pelanggan
```

### C. Alur Pengadaan & Stok

```
1. Admin buka menu Data Pemasok → Tambah Pemasok
     (isi: nama_toko, alamat, nohp)

2. Admin buka menu Data Pembelian → Tambah Pembelian
     - Pilih Pemasok (dari data yang sudah tersimpan)
     - Pilih Bahan Baku (dari data yang sudah tersimpan)
     - Isi: jumlah, tanggal beli, harga

3. SETELAH pembelian disimpan:
     - Stok Bahan Baku OTOMATIS BERTAMBAH sesuai jumlah
     - Tercatat di StokLog dengan jenis "masuk"
```

### Ringkasan Mutasi Stok

| Aksi | Efek Stok | Tercatat di |
|------|-----------|-------------|
| Pembelian (baru) | **+** (bertambah) | StokLog `masuk` |
| ProduksiDetail (baru) | **−** (berkurang) | StokLog `keluar` |
| BahanBaku.tambahStok() | **+** (bertambah) | StokLog `masuk` |
| Stok Menipis | Peringatan | `stok <= minimum_stok` |

---

## 4. Relasi Antar Tabel

```
User (admin|karyawan)  ─── hasMany ───→ Produksi
Pelanggan              ─── hasMany ───→ Pesanan
Pesanan                ─── hasOne  ───→ Produksi
Pesanan                ─── belongsTo ─→ Pelanggan
Produksi               ─── belongsTo ─→ Pesanan, User
Produksi               ─── hasMany  ─→ ProduksiDetail
BahanBaku              ─── hasMany  ─→ ProduksiDetail, Pembelian
StokLog                ─── belongsTo ─→ BahanBaku, User
Pemasok                ─── hasMany  ─→ Pembelian
Pembelian              ─── belongsTo ─→ Pemasok, BahanBaku
```

---

## 5. Navigasi Menu Admin

| Menu | Group | Status | Tombol New |
|------|-------|--------|------------|
| Data Pelanggan | Order | **BARU** | Ada |
| Manajemen Pesanan | Order | Diupdate | Ada |
| Manajemen Bahan Baku | Produksi | Diupdate | **DIHAPUS** |
| Manajemen Produksi | Produksi | Diupdate | **DIHAPUS** |
| Man. Detail Produksi | Produksi | Diupdate | **DIHAPUS** |
| Data Pemasok | **Pengadaan** | **BARU** | Ada |
| Data Pembelian | **Pengadaan** | **BARU** | Ada |

---

## 6. Perubahan yang Dilakukan

1. **Bahan Baku**: Tombol "New" dihapus, label stok diubah jadi "Stok Tersedia"
2. **Produksi Detail**: Tombol "New" dihapus (hanya bisa dari form Produksi)
3. **Produksi Admin**: Tombol "New" dihapus, ditambah field edit alamat (tersimpan ke `pesanan.alamat`)
4. **Tabel baru**: `Pemasok` (nama_toko, alamat, nohp) + Filament Resource
5. **Tabel baru**: `Pembelian` (pemasok_id, bahan_baku_id, jumlah, tgl_beli, harga)
   - Stok otomatis bertambah saat pembelian dibuat (via `Pembelian::booted()`)
6. **Tabel baru**: `Pelanggan` (nama, alamat, nohp) + Filament Resource
7. **Pesanan**: Sekarang memiliki relasi `belongsTo(Pelanggan)`, form pake select Pelanggan
8. **Halaman utama** (`welcome.blade.php`): Ditambahkan gambar bakso dari Unsplash

---

## 7. Perintah Cepat

```bash
composer setup           # Install pertama kali
composer dev             # Jalankan dev server + queue + logs + Vite
composer test            # Jalankan semua test (Pest)
php artisan test ...     # Jalankan test file tertentu
vendor/bin/pint          # Format kode (Laravel Pint)
npm run build            # Build Vite production
```

---

*Dokumen ini digenerate otomatis dari sistem SIBAKSO*
*Bakso Ayam 234 — Bangkinang, Kampar, Riau*
