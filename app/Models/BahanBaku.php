<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StokLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BahanBaku extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bahan',
        'stok',
        'satuan',
        'jenis',
        'minimum_stok',
    ];

    // 🔗 Relasi ke Produksi Detail
    public function produksiDetails()
    {
        return $this->hasMany(ProduksiDetail::class);
    }

    // 🔔 Cek stok menipis
    public function isLowStock()
    {
        return $this->stok <= $this->minimum_stok;
    }

    public function tambahStok($jumlah)
{
    $stokSebelum = $this->stok;

    $this->increment('stok', $jumlah);

    StokLog::create([
        'bahan_baku_id' => $this->id,
        'user_id' => auth()->id(),
        'jenis' => 'masuk',
        'jumlah' => $jumlah,
        'stok_sebelum' => $stokSebelum,
        'stok_sesudah' => $this->fresh()->stok,
    ]);
}

}
