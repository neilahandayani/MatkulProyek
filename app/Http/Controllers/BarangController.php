<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();

        if ($request->has('search')) {
            // Filter pencarian jika ada
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // Eager load relasi jenisBarang dan satuan
        $barang = $query->with(['jenisBarang', 'satuan'])->paginate(10);
        return view('Barang.index', compact('barang'));
    }

    public function create()
    {
        // Mengambil semua jenis barang dan satuan untuk dropdown
        $jenisBarang = JenisBarang::all();
        $satuan = Satuan::all();

        // Generate kode barang baru
        $lastKode = Barang::where('kode_barang', 'LIKE', 'B%')
            ->orderByDesc('kode_barang')
            ->first();
        $lastNumber = $lastKode ? (int)substr($lastKode->kode_barang, 1) : 0;
        $nextNumber = $lastNumber + 1;
        $kodeBarang = 'B' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Kirim kode_barang ke view
        return view('Barang.create', compact('jenisBarang', 'satuan', 'kodeBarang'));
    }

    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'kode_barang' => 'required|string|max:50', // Menambahkan validasi untuk kode barang
            'nama_barang' => 'required|string|max:50',
            'id_jenisbarang' => 'required|exists:jenis_barang,id_jenisbarang',
            'id_satuan' => 'required|exists:satuan,id_satuan',
            'catatan' => 'nullable|string|max:100',
        ]);

        // Membuat data barang baru
        Barang::create($request->only([
            'kode_barang',
            'nama_barang',
            'id_jenisbarang',
            'id_satuan',
            'catatan',
        ]));

        return redirect()->route('Barang.index')
            ->with('success', 'Data Barang berhasil ditambahkan');
    }

    // public function edit($id)
    // {
    // Menampilkan halaman edit barang berdasarkan ID
    //    $barang = Barang::with(['jenisBarang', 'satuan'])->findOrFail($id);  // Eager loading relasi
    //   ($barang->satuan);
    //   $jenisBarang = JenisBarang::all();
    //  $satuan = Satuan::all();
    //  return view('Barang.edit', compact('barang', 'jenisBarang', 'satuan'));
    // }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $jenisBarang = JenisBarang::all(); // Ambil data jenis barang untuk pilihan
        $satuan = Satuan::all(); // Ambil semua data satuan untuk pilihan

        return view('Barang.edit', compact('barang', 'jenisBarang', 'satuan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input data
        $request->validate([
            'nama_barang' => 'required|string|max:50',
            'id_jenisbarang' => 'required|exists:jenis_barang,id_jenisbarang',
            'id_satuan' => 'required|exists:satuan,id_satuan',
            'catatan' => 'nullable|string|max:100',
        ]);

        // Update data barang
        $barang = Barang::findOrFail($id);
        $barang->update($request->only([
            'nama_barang',
            'id_jenisbarang',
            'id_satuan',
            'catatan',
        ]));

        return redirect()->route('Barang.index')
            ->with('success', 'Data Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Menghapus data barang
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('Barang.index')
            ->with('success', 'Data Barang berhasil dihapus');
    }

    public function show($id)
    {
        // Ambil data barang beserta relasi jenis barang dan satuan
        $barang = Barang::with(['jenisBarang', 'satuan'])->findOrFail($id);

        return view('Barang.show', compact('barang'));
    }

    public function getStok($id)
    {
        // Fetch the current stock from barangmasuk based on the item ID
        $stok = DB::table('barangmasuk')
            ->where('id_barang', $id)
            ->sum('stok_saat_ini'); // Assuming stok_saat_ini stores the quantity

        return response()->json([
            'stok' => $stok ?? 0, // Default to 0 if no stock found
        ]);
    }
}
