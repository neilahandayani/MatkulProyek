<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index(Request $request)
    {
        $query = Satuan::query();

        if ($request->has('search')) {
            $query->where('nama_satuan', 'like', '%' . $request->search . '%');
        }

        $satuan = $query->paginate(10);

        return view('satuan.index', compact('satuan'));
    }

    public function create()
    {
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_satuan' => 'required',
        ]);

        Satuan::create($request->all());

        return redirect()->route('satuan.index')
            ->with('success', 'Data satuan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $satuan = Satuan::find($id);
        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_satuan' => 'required',
        ]);

        $satuan = Satuan::find($id);
        $satuan->update($request->all());

        return redirect()->route('satuan.index')
            ->with('success', 'Data satuan berhasil diperbarui');
    }

    // public function show(string $id)
    // {
    //     $satuan = Satuan::find($id);

    //      if (!$satuan) {
    //         return redirect()->route('satuan.index')->with('error', 'Data satuan tidak ditemukan');
    //     }

    //     return view('satuan.show', compact('satuan'));
    // }


    public function destroy($id)
    {
        $satuan = Satuan::find($id);
        $satuan->delete();

        return redirect()->route('satuan.index')
            ->with('success', 'Data satuan berhasil dihapus');
    }
}
