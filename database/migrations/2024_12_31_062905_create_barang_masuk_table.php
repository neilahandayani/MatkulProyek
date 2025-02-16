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
        // Membuat tabel transaksi_masuk untuk menyimpan data transaksi masuk
        Schema::create('transaksi_masuk', function (Blueprint $table) {
            $table->id('id_transaksi_masuk');
            $table->char('kode_transaksi_masuk', 15)->unique();
            $table->date('tanggal_masuk');
            $table->timestamps();
        });

        // Membuat tabel barang_masuk untuk menyimpan item barang yang masuk dalam transaksi
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id('id_barangmasuk');
            $table->unsignedBigInteger('id_transaksi_masuk');  // Referensi ke transaksi_masuk
            $table->unsignedBigInteger('id_barang');           // Referensi ke barang
            $table->integer('jumlah_masuk');                    // Jumlah barang yang masuk
            $table->timestamps();

            // Menambahkan foreign key untuk id_barang yang merujuk ke tabel barang
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');

            // Menambahkan foreign key untuk id_transaksi_masuk yang merujuk ke tabel transaksi_masuk
            $table->foreign('id_transaksi_masuk')->references('id_transaksi_masuk')->on('transaksi_masuk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Menghapus tabel barang_masuk dan transaksi_masuk
        Schema::dropIfExists('barang_masuk');
        Schema::dropIfExists('transaksi_masuk');
    }
};
