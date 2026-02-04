<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baju', function (Blueprint $table) {
            $table->id('id_baju'); 
            $table->string('nama_baju');
            $table->integer('stok');
            $table->decimal('harga_sewa', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baju');
    }
};
