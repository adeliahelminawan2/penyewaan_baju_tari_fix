<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id('id_penyewaan'); // Primary Key tabel ini
            $table->string('kode_sewa')->unique();

            // Perbaikan di sini:
            $table->foreignId('id_pelanggan') // Nama kolom di tabel ini
                ->references('id_pelanggan') // Merujuk ke Primary Key di tabel pelanggan
                ->on('pelanggan')
                ->onDelete('cascade');

            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali_rencana');
            $table->enum('status', ['disewa', 'dikembalikan'])->default('disewa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewaan');
    }
};
