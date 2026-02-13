<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BahanBaku extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bahan',
        'stok',
        'satuan',
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
}
