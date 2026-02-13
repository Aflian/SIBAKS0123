<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('jenis_bakso');
            $table->integer('jumlah');
            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->date('tanggal_ambil');

            $table->enum('status_pembayaran', ['belum_lunas', 'lunas'])
                  ->default('belum_lunas');

            $table->enum('status_produksi', ['menunggu', 'diproduksi', 'selesai'])
                  ->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
