<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
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

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function produksi()
    {
        return $this->hasOne(Produksi::class);
    }
}
