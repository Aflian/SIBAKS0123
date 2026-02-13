<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan',
        'jenis_bakso',
        'jumlah',
        'alamat',
        'no_hp',
        'tanggal_ambil',
        'status_pembayaran',
        'status_produksi',
    ];

    protected $casts = [
        'tanggal_ambil' => 'date',
    ];

    // 🔗 Relasi ke Produksi
    public function produksi()
    {
        return $this->hasOne(Produksi::class);
    }
}
