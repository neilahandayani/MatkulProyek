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
        // Membuat tabel transaksi_keluar untuk menyimpan data transaksi keluar
        Schema::create('transaksi_keluar', function (Blueprint $table) {
            $table->id('id_transaksi_keluar');
            $table->char('kode_transaksi_keluar', 10)->unique();
            $table->date('tanggal_keluar');
            $table->timestamps();
        });

        // Membuat tabel barang_keluar untuk menyimpan item barang yang keluar dalam transaksi
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id('id_barangkeluar');
            $table->unsignedBigInteger('id_transaksi_keluar');  // Referensi ke transaksi_keluar
            $table->unsignedBigInteger('id_barang');           // Referensi ke barang
            $table->integer('jumlah_keluar');                    // Jumlah barang yang keluar
            $table->timestamps();

            // Menambahkan foreign key untuk id_barang yang merujuk ke tabel barang
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');

            // Menambahkan foreign key untuk id_transaksi_keluar yang merujuk ke tabel transaksi_keluar
            $table->foreign('id_transaksi_keluar')->references('id_transaksi_keluar')->on('transaksi_keluar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Menghapus tabel barang_keluar dan transaksi_keluar
        Schema::dropIfExists('barang_keluar');
        Schema::dropIfExists('transaksi_keluar');
    }
};
