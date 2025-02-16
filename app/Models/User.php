<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Pastikan ini mengarah ke Authenticatable
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    protected $table = 'users';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_user',
        'nama_user',
        'username',
        'password',
        'id_role',
    ];

    // Relasi dengan model Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }


    // Accessor untuk mendapatkan nama role
    public function getRoleNameAttribute()
    {
        return $this->role->nama_role ?? 'No Role';
    }

    public function getAuthIdentifierName()
    {
        return 'username'; // Menggunakan kolom 'username' untuk autentikasi
    }
}
