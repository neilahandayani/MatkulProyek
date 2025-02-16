<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function barangKeluar()
    {
        return view('Laporan.barangKeluar');
    }

    public function barangMasuk()
    {
        return view('Laporan.barangMasuk');
    }

    public function stok()
    {
        return view('Laporan.stok');
    }
}
