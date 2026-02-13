<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'user_id',
        'tanggal_produksi',
        'jumlah_produksi',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_produksi' => 'date',
    ];

    // 🔗 Relasi
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produksiDetails()
    {
        return $this->hasMany(ProduksiDetail::class);
    }

    // 🔥 Auto update status pesanan saat produksi dibuat
    protected static function booted()
    {
        static::created(function ($produksi) {
            $produksi->pesanan->update([
                'status_produksi' => 'diproduksi'
            ]);
        });
    }
}
