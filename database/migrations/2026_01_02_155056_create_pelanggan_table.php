<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan'); // Primary Key
            $table->string('nama_pelanggan'); // Pastikan ini 'nama_pelanggan', bukan 'nama'
            $table->string('no_hp');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
