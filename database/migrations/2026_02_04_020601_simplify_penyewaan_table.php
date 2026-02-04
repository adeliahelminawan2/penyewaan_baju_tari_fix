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
        Schema::table('penyewaan', function (Blueprint $table) {
            // Tambahkan kolom identitas pelanggan langsung ke tabel penyewaan
            $table->string('nama_pelanggan')->after('kode_sewa')->nullable();
            $table->string('no_hp')->after('nama_pelanggan')->nullable();
            $table->text('alamat')->after('no_hp')->nullable();
            
            // Hapus foreign key dan kolom id_pelanggan
            $table->dropForeign(['id_pelanggan']);
            $table->dropColumn('id_pelanggan');
        });

        // Hapus tabel pelanggan karena sudah tidak diperlukan
        Schema::dropIfExists('pelanggan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyewaan', function (Blueprint $table) {
            //
        });
    }
};
