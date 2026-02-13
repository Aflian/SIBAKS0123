<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProduksiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'produksi_id',
        'bahan_baku_id',
        'jumlah_digunakan',
    ];

    // 🔗 Relasi
    public function produksi()
    {
        return $this->belongsTo(Produksi::class);
    }

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }

    // 🔥 Kurangi stok otomatis saat bahan dipakai
    protected static function booted()
    {
        static::created(function ($detail) {
            $detail->bahanBaku->decrement('stok', $detail->jumlah_digunakan);
        });
    }
}
