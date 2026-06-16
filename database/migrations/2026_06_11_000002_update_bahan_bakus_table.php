<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bahan_bakus', function (Blueprint $table) {
            $table->enum('jenis', ['bahan_utama', 'bumbu'])->default('bahan_utama')->after('satuan');
        });

        DB::table('bahan_bakus')->where('satuan', 'kg')->update([
            'stok' => DB::raw('stok * 1000'),
            'minimum_stok' => DB::raw('minimum_stok * 1000'),
            'satuan' => 'gram',
        ]);
    }

    public function down(): void
    {
        DB::table('bahan_bakus')->where('satuan', 'gram')->update([
            'stok' => DB::raw('stok / 1000'),
            'minimum_stok' => DB::raw('minimum_stok / 1000'),
            'satuan' => 'kg',
        ]);

        Schema::table('bahan_bakus', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
};
