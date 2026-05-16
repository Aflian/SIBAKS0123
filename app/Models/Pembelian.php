<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemasok_id',
        'bahan_baku_id',
        'jumlah',
        'tgl_beli',
        'harga',
    ];

    protected $casts = [
        'tgl_beli' => 'date',
    ];

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class);
    }

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }

    protected static function booted()
    {
        static::created(function ($pembelian) {
            $bahan = $pembelian->bahanBaku;
            if ($bahan) {
                $stokSebelum = $bahan->stok;
                $bahan->increment('stok', $pembelian->jumlah);
                $stokSesudah = $bahan->fresh()->stok;

                StokLog::create([
                    'bahan_baku_id' => $bahan->id,
                    'user_id' => auth()->id(),
                    'jenis' => 'masuk',
                    'jumlah' => $pembelian->jumlah,
                    'stok_sebelum' => $stokSebelum,
                    'stok_sesudah' => $stokSesudah,
                ]);
            }
        });
    }
}
