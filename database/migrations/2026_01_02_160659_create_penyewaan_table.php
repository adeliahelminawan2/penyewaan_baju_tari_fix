<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id('id_penyewaan'); 
            $table->string('kode_sewa')->unique();

            $table->foreignId('id_pelanggan') 
                ->references('id_pelanggan') 
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
