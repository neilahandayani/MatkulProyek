<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk';

    protected $fillable = ['id_transaksi_masuk', 'id_barang', 'jumlah_masuk'];

    // Relasi dengan barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function transaksiMasuk()
    {
        return $this->belongsTo(TransaksiMasuk::class, 'id_transaksi_masuk');
    }
}
