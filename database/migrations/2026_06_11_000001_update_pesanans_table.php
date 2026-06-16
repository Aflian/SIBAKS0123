<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn(['nama_pelanggan', 'jenis_bakso']);
        });

        Schema::table('pesanans', function (Blueprint $table) {
            $table->enum('satuan', ['kg', 'pcs'])->default('pcs')->after('jumlah');
        });
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('satuan');
        });

        Schema::table('pesanans', function (Blueprint $table) {
            $table->string('nama_pelanggan')->after('pelanggan_id');
            $table->string('jenis_bakso')->after('nama_pelanggan');
        });
    }
};
