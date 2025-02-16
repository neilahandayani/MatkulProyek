<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        // Menghitung jumlah barang
        $jumlahBarang = Barang::count();

        // Membuat query untuk mengambil data barang
        $query = Barang::with(['jenisBarang', 'satuan']);

        // Jika ada parameter pencarian
        if ($request->has('search') && $request->search != '') {
            // Menambahkan filter pencarian berdasarkan beberapa kolom
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('kode_barang', 'like', '%' . $searchTerm . '%')
                    ->orWhere('nama_barang', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('jenisBarang', function ($q) use ($searchTerm) {
                        $q->where('jenis_barang', 'like', '%' . $searchTerm . '%');
                    })
                    ->orWhereHas('satuan', function ($q) use ($searchTerm) {
                        $q->where('nama_satuan', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Mengambil data barang yang sudah difilter
        $barang = $query->get();

        // Mengirimkan jumlahBarang dan barang ke view dashboard
        return view('dashboard', compact('jumlahBarang', 'barang'));
    }
}
