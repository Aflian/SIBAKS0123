<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produksis', function (Blueprint $table) {
            $table->dropForeign(['pesanan_id']);
            $table->dropColumn('pesanan_id');
        });

        Schema::table('produksis', function (Blueprint $table) {
            $table->integer('total_berat')->nullable()->after('jumlah_produksi');
        });
    }

    public function down(): void
    {
        Schema::table('produksis', function (Blueprint $table) {
            $table->dropColumn('total_berat');
        });

        Schema::table('produksis', function (Blueprint $table) {
            $table->foreignId('pesanan_id')->nullable()->constrained('pesanans')->cascadeOnDelete();
        });
    }
};
