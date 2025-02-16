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
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');  // ID barang sebagai auto-increment
            $table->char('kode_barang', 10)->unique();
            $table->string('nama_barang', 50);
            $table->unsignedBigInteger('id_jenisbarang');
            $table->foreign('id_jenisbarang')->references('id_jenisbarang')->on('jenis_barang');
            $table->unsignedBigInteger('id_satuan');
            $table->foreign('id_satuan')->references('id_satuan')->on('satuan');
            $table->string('catatan', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
