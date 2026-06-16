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

        Auth::login($karyawan);

        $tepung = BahanBaku::create([
            'nama_bahan' => 'Tepung Terigu',
            'stok' => 50000,
            'satuan' => 'gram',
            'jenis' => 'bahan_utama',
            'minimum_stok' => 10000,
        ]);

        $daging = BahanBaku::create([
            'nama_bahan' => 'Daging Ayam',
            'stok' => 40000,
            'satuan' => 'gram',
            'jenis' => 'bahan_utama',
            'minimum_stok' => 8000,
        ]);

        $bumbu = BahanBaku::create([
            'nama_bahan' => 'Bumbu Halus',
            'stok' => 20000,
            'satuan' => 'gram',
            'jenis' => 'bumbu',
            'minimum_stok' => 5000,
        ]);

        $telur = BahanBaku::create([
            'nama_bahan' => 'Telur',
            'stok' => 50,
            'satuan' => 'butir',
            'jenis' => 'bahan_utama',
            'minimum_stok' => 10,
        ]);

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

        Pembelian::create([
            'pemasok_id' => $pemasok1->id,
            'bahan_baku_id' => $tepung->id,
            'jumlah' => 10000,
            'tgl_beli' => now(),
            'harga' => 150000,
        ]);

        Pembelian::create([
            'pemasok_id' => $pemasok2->id,
            'bahan_baku_id' => $daging->id,
            'jumlah' => 8000,
            'tgl_beli' => now(),
            'harga' => 320000,
        ]);

        $pelanggan1 = Pelanggan::create([
            'nama' => 'Andi',
            'alamat' => 'Bangkinang',
            'nohp' => '081234567890',
        ]);

        $pelanggan2 = Pelanggan::create([
            'nama' => 'Siti',
            'alamat' => 'Bangkinang Kota',
            'nohp' => '081234567891',
        ]);

        $pesanan1 = Pesanan::create([
            'pelanggan_id' => $pelanggan1->id,
            'jumlah' => 100,
            'satuan' => 'pcs',
            'alamat' => 'Bangkinang',
            'no_hp' => '081234567890',
            'tanggal_ambil' => now()->addDay(),
            'status_pembayaran' => 'lunas',
            'status_produksi' => 'menunggu',
        ]);

        $pesanan2 = Pesanan::create([
            'pelanggan_id' => $pelanggan2->id,
            'jumlah' => 5,
            'satuan' => 'kg',
            'alamat' => 'Bangkinang Kota',
            'no_hp' => '081234567891',
            'tanggal_ambil' => now()->addDay(),
            'status_pembayaran' => 'belum_lunas',
            'status_produksi' => 'menunggu',
        ]);

        $produksi = Produksi::create([
            'user_id' => $karyawan->id,
            'tanggal_produksi' => now(),
            'jumlah_produksi' => 125,
            'total_berat' => 25000,
            'keterangan' => 'Produksi pagi hari',
        ]);

        $produksi->pesanans()->attach($pesanan1->id);
        $produksi->pesanans()->attach($pesanan2->id);

        $pesanan1->update(['status_produksi' => 'diproduksi']);
        $pesanan2->update(['status_produksi' => 'diproduksi']);

        ProduksiDetail::create([
            'produksi_id' => $produksi->id,
            'bahan_baku_id' => $tepung->id,
            'jumlah_digunakan' => 5000,
        ]);

        ProduksiDetail::create([
            'produksi_id' => $produksi->id,
            'bahan_baku_id' => $daging->id,
            'jumlah_digunakan' => 7000,
        ]);

        ProduksiDetail::create([
            'produksi_id' => $produksi->id,
            'bahan_baku_id' => $bumbu->id,
            'jumlah_digunakan' => 2000,
        ]);

        Auth::logout();
    }
}
