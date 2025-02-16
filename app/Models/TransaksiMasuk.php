<?php

// app/Models/TransaksiMasuk.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMasuk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_transaksi_masuk';
    protected $table = 'transaksi_masuk';
    protected $fillable = ['kode_transaksi_masuk', 'tanggal_masuk'];

    // Relasi dengan barang masuk
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_transaksi_masuk');
    }
}
