<?php

namespace App\Http\Controllers;

use App\Models\TransaksiMasuk;
use Illuminate\Http\Request;

class TransaksiMasukController extends Controller
{
    public function index()
    {
        $transaksiMasuk = TransaksiMasuk::all();
        return view('transaksi-masuk.index', compact('transaksiMasuk'));
    }

    public function create()
    {
        return view('transaksi-masuk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi_masuk' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        TransaksiMasuk::create($request->all());

        return redirect()->route('transaksi-masuk.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
