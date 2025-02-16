<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    use HasFactory;

    // Jika kamu tidak ingin menggunakan timestamps
    public $timestamps = false;

    // Menentukan tabel dan primary key
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    // Kolom-kolom yang dapat diisi
    protected $fillable = [
        //'kode_barang',
        'nama_barang',
        'id_jenisbarang',
        'id_satuan',
        'catatan',
    ];

    // Relasi ke tabel jenis barang
    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'id_jenisbarang', 'id_jenisbarang');
    }

    // Relasi ke tabel satuan
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan');
    }

    // Event untuk mengisi kode_barang otomatis
    public static function boot()
    {
        parent::boot();

        static::creating(function ($barang) {
            // Mengambil kode_barang terakhir menggunakan Eloquent
            $lastKode = Barang::where('kode_barang', 'LIKE', 'B%')
                ->orderByDesc('kode_barang')
                ->first();

            // Mengambil nomor urut terakhir dan menambahkannya untuk kode barang baru
            $lastNumber = $lastKode ? (int)substr($lastKode->kode_barang, 1) : 0;
            $nextNumber = $lastNumber + 1;

            // Menetapkan kode barang baru dengan format B0001, B0002, dll.
            $barang->kode_barang = 'B' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        });
    }
}
