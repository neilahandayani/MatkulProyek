<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jenis_barang', function (Blueprint $table) {
            $table->id('id_jenisbarang'); // ID sebagai primary key, auto increment
            $table->string('jenis_barang', 50)->unique(); // Kolom jenis_barang dengan batas 50 karakter dan unik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_barang');
    }
};
