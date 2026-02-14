<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('stok_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bahan_baku_id')
                  ->constrained('bahan_bakus')
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->enum('jenis', ['masuk', 'keluar']);

            $table->integer('jumlah');
            $table->integer('stok_sebelum');
            $table->integer('stok_sesudah');

            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_logs');
    }
};
