<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penyewaan', function (Blueprint $table) {
            $table->id('id_detail');

            // Relasi ke penyewaan
            $table->foreignId('id_penyewaan')->references('id_penyewaan')->on('penyewaan')->onDelete('cascade');

            // Relasi ke baju (BAGIAN INI YANG HARUS TELITI)
            $table->foreignId('id_baju')
                ->references('id_baju') // Harus merujuk ke id_baju
                ->on('baju')            // Di tabel baju
                ->onDelete('cascade');

            $table->integer('jumlah');
            $table->decimal('harga_sewa', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penyewaan');
    }
};
