<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_produksi',
        'jumlah_produksi',
        'total_berat',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_produksi' => 'date',
    ];

    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class, 'produksi_pesanan');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produksiDetails()
    {
        return $this->hasMany(ProduksiDetail::class);
    }

    protected static function booted()
    {
        static::created(function ($produksi) {
            if ($produksi->pesanans()->exists()) {
                $produksi->pesanans()->each(function ($pesanan) {
                    if ($pesanan->status_produksi === 'menunggu') {
                        $pesanan->update(['status_produksi' => 'diproduksi']);
                    }
                });
            }
        });
    }
}
