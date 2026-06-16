<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'jumlah',
        'satuan',
        'harga',
        'alamat',
        'no_hp',
        'tanggal_ambil',
        'status_pembayaran',
        'status_produksi',
    ];

    protected $casts = [
        'tanggal_ambil' => 'date',
        'harga' => 'decimal:2',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function produksis()
    {
        return $this->belongsToMany(Produksi::class, 'produksi_pesanan');
    }

    public function getBeratTotalGramAttribute(): int
    {
        if ($this->satuan === 'kg') {
            return $this->jumlah * 1000;
        }

        return $this->jumlah * 200;
    }
}
