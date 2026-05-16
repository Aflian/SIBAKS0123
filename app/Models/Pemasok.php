<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemasok extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_toko',
        'alamat',
        'nohp',
    ];

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class);
    }
}
