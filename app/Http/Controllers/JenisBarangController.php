<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    public function index(Request $request)
    {
        $query = JenisBarang::query();

        if ($request->has('search')) {
            // Menggunakan field 'jenis_barang' untuk pencarian
            $query->where('jenis_barang', 'like', '%' . $request->search . '%');
        }

        $jenisBarang = $query->paginate(10);

        if ($jenisBarang->isEmpty() && $request->has('search')) {
            return redirect()->route('JenisBarang.index')
                ->with('error', 'Data tidak ditemukan.');
        }

        // Menggunakan variabel 'jenisBarang' untuk compact
        return view('JenisBarang.index', compact('jenisBarang'));
    }

    public function create()
    {
        return view('JenisBarang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_barang' => 'required', // Menggunakan field 'jenis_barang'
        ]);

        JenisBarang::create($request->all());

        return redirect()->route('JenisBarang.index')
            ->with('success', 'Data jenis barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jenisBarang = JenisBarang::find($id); // Menggunakan variabel 'jenisBarang'
        return view('JenisBarang.edit', compact('jenisBarang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_barang' => 'required', // Menggunakan field 'jenis_barang'
        ]);

        $jenisBarang = JenisBarang::find($id);
        $jenisBarang->update($request->all());

        return redirect()->route('JenisBarang.index')
            ->with('success', 'Data jenis barang berhasil diperbarui');
    }

    public function show(string $id)
    {
        $jenisBarang = JenisBarang::find($id); // Menggunakan variabel 'jenisBarang'

        if (!$jenisBarang) {
            return redirect()->route('JenisBarang.index')->with('error', 'Data jenis barang tidak ditemukan');
        }

        return view('JenisBarang.show', compact('jenisBarang')); // Menggunakan variabel 'jenisBarang'
    }

    public function destroy($id)
    {
        $jenisBarang = JenisBarang::find($id); // Menggunakan variabel 'jenisBarang'
        $jenisBarang->delete();

        return redirect()->route('JenisBarang.index')
            ->with('success', 'Data jenis barang berhasil dihapus');
    }
}
