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
            $table->string('jaminan')->after('alamat')->nullable();
            $table->decimal('total_harga', 15, 2)->after('tanggal_kembali_rencana')->default(0);
            $table->decimal('total_bayar', 15, 2)->after('total_harga')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyewaan', function (Blueprint $table) {
            $table->dropColumn(['jaminan', 'total_harga', 'total_bayar']);
        });
    }
};
