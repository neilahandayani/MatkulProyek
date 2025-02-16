<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'satuan';
    protected $primaryKey = 'id_satuan';
    protected $fillable = ['nama_satuan'];
}
