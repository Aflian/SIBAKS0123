<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StokLog;
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

        $bahan = $detail->bahanBaku;

        $stokSebelum = $bahan->stok;

        $bahan->decrement('stok', $detail->jumlah_digunakan);

        $stokSesudah = $bahan->fresh()->stok;

        StokLog::create([
            'bahan_baku_id' => $bahan->id,
            'user_id' => auth()->id(),
            'jenis' => 'keluar',
            'jumlah' => $detail->jumlah_digunakan,
            'stok_sebelum' => $stokSebelum,
            'stok_sesudah' => $stokSesudah,
        ]);
    });
}

}
