<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BahanBaku;
use App\Models\Pesanan;
use App\Models\Produksi;
use App\Models\ProduksiDetail;
use App\Models\Pemasok;
use App\Models\Pembelian;
use App\Models\Pelanggan;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =============================
        // 1️⃣ USER
        // =============================

        $admin = User::create([
            'name' => 'Admin Bakso',
            'email' => 'admin234@bakso.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $karyawan = User::create([
            'name' => 'Budi Produksi',
            'email' => 'karyawan@bakso.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);

        // 🔥 SIMULASI LOGIN KARYAWAN
        Auth::login($karyawan);

        // =============================
        // 2️⃣ BAHAN BAKU
        // =============================

        $tepung = BahanBaku::create([
            'nama_bahan' => 'Tepung',
            'stok' => 50,
            'satuan' => 'kg',
            'minimum_stok' => 10,
        ]);

        $daging = BahanBaku::create([
            'nama_bahan' => 'Daging Ayam',
            'stok' => 40,
            'satuan' => 'kg',
            'minimum_stok' => 8,
        ]);

        $bumbu = BahanBaku::create([
            'nama_bahan' => 'Bumbu',
            'stok' => 20,
            'satuan' => 'kg',
            'minimum_stok' => 5,
        ]);

        // =============================
        // 3️⃣ PEMASOK
        // =============================

        $pemasok1 = Pemasok::create([
            'nama_toko' => 'Toko Tepung Sejahtera',
            'alamat' => 'Jl. Industri No. 10, Bangkinang',
            'nohp' => '081276543210',
        ]);

        $pemasok2 = Pemasok::create([
            'nama_toko' => 'Supplier Daging Ayam',
            'alamat' => 'Jl. Peternakan No. 5, Bangkinang',
            'nohp' => '081298765432',
        ]);

        // =============================
        // 4️⃣ PEMBELIAN (otomatis nambah stok)
        // =============================

        Pembelian::create([
            'pemasok_id' => $pemasok1->id,
            'bahan_baku_id' => $tepung->id,
            'jumlah' => 10,
            'tgl_beli' => now(),
            'harga' => 150000,
        ]);

        Pembelian::create([
            'pemasok_id' => $pemasok2->id,
            'bahan_baku_id' => $daging->id,
            'jumlah' => 8,
            'tgl_beli' => now(),
            'harga' => 320000,
        ]);

        // =============================
        // 5️⃣ PELANGGAN
        // =============================

        $pelanggan = Pelanggan::create([
            'nama' => 'Andi',
            'alamat' => 'Bangkinang',
            'nohp' => '081234567890',
        ]);

        // =============================
        // 6️⃣ PESANAN
        // =============================

        $pesanan = Pesanan::create([
            'pelanggan_id' => $pelanggan->id,
            'nama_pelanggan' => 'Andi',
            'jenis_bakso' => 'Bakso Ayam Besar',
            'jumlah' => 100,
            'alamat' => 'Bangkinang',
            'no_hp' => '081234567890',
            'tanggal_ambil' => now()->addDay(),
            'status_pembayaran' => 'lunas',
            'status_produksi' => 'diproduksi',
        ]);

        // =============================
        // 7️⃣ PRODUKSI
        // =============================

        $produksi = Produksi::create([
            'pesanan_id' => $pesanan->id,
            'user_id' => $karyawan->id,
            'tanggal_produksi' => now(),
            'jumlah_produksi' => 100,
            'keterangan' => 'Produksi pagi hari',
        ]);

        // =============================
        // 8️⃣ PRODUKSI DETAIL
        // =============================

        ProduksiDetail::create([
            'produksi_id' => $produksi->id,
            'bahan_baku_id' => $tepung->id,
            'jumlah_digunakan' => 5,
        ]);

        ProduksiDetail::create([
            'produksi_id' => $produksi->id,
            'bahan_baku_id' => $daging->id,
            'jumlah_digunakan' => 7,
        ]);

        ProduksiDetail::create([
            'produksi_id' => $produksi->id,
            'bahan_baku_id' => $bumbu->id,
            'jumlah_digunakan' => 2,
        ]);

        // Logout setelah selesai
        Auth::logout();
    }
}
