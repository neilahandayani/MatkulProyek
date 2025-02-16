<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role'; // Pastikan tabelnya sesuai
    protected $primaryKey = 'id_role'; // ID role sebagai primary key
    public $timestamps = false; // Jika tidak ada kolom created_at, updated_at

    // Mengatur kolom yang bisa diisi massal
    protected $fillable = [
        'kode_role',
        'nama_role',
    ];

    // Mengatur nilai default untuk kode_role
    protected static function booted()
    {
        static::creating(function ($role) {
            // Generate kode_role otomatis
            if (empty($role->kode_role)) {
                // Ambil kode_role terakhir, dan ambil angka setelah RO-
                $lastRole = Role::orderBy('id_role', 'desc')->first();
                $lastCode = $lastRole ? (int) substr($lastRole->kode_role, 3) : 0;

                // Set kode_role baru
                $role->kode_role = 'RO-' . str_pad($lastCode + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
