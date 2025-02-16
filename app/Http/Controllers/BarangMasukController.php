<?php

namespace App\Http\Controllers;

use App\Models\TransaksiMasuk;
use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $transaksiMasuk = TransaksiMasuk::with('barangMasuk')->get();
        return view('barang-masuk.index', compact('transaksiMasuk'));
    }

    public function create()
    {
        // Mengambil barang yang ada
        $barang = Barang::all();

        // Menyiapkan kode transaksi otomatis (contoh BM000001, dst)
        $lastTransaksi = TransaksiMasuk::latest()->first();
        $kodeTransaksi = 'BM' . str_pad(($lastTransaksi ? substr($lastTransaksi->kode_transaksi_masuk, 2) + 1 : 1), 6, '0', STR_PAD_LEFT);

        return view('barang-masuk.create', compact('barang', 'kodeTransaksi'));
    }

    // Menambahkan barang ke transaksi sementara
    public function addBarang(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_barang' => 'required',
            'jumlah_masuk' => 'required|integer|min:1',
        ]);

        // Ambil data barang yang dipilih
        $barang = Barang::findOrFail($request->id_barang);

        // Simpan sementara barang yang dipilih ke session
        $barangMasuk = session()->get('barang_masuk', []);
        $barangMasuk[] = [
            'id_barang' => $barang->id_barang,
            'nama_barang' => $barang->nama_barang,
            'jumlah_masuk' => $request->jumlah_masuk,
        ];
        session()->put('barang_masuk', $barangMasuk);

        return redirect()->route('barang-masuk.create');
    }

    // Menyimpan transaksi barang masuk ke database
    public function store(Request $request)
    {
        // Validasi data transaksi masuk
        $request->validate([
            'kode_transaksi_masuk' => 'required|unique:transaksi_masuk,kode_transaksi_masuk',
            'tanggal_masuk' => 'required|date',
        ]);

        // Simpan data transaksi masuk
        $transaksiMasuk = TransaksiMasuk::create([
            'kode_transaksi_masuk' => $request->kode_transaksi_masuk,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        // Menyimpan data barang yang masuk
        $barangMasuk = session()->get('barang_masuk', []);
        foreach ($barangMasuk as $item) {
            $transaksiMasuk->barangMasuk()->create([
                'id_barang' => $item['id_barang'],
                'jumlah_masuk' => $item['jumlah_masuk'],
            ]);
        }

        // Menghapus session setelah transaksi disimpan
        session()->forget('barang_masuk');

        return redirect()->route('barang-masuk.index')->with('success', 'Transaksi barang masuk berhasil disimpan.');
    }

    // Menghapus barang sementara dari session
    public function removeBarang($index)
    {
        $barangMasuk = session()->get('barang_masuk', []);
        unset($barangMasuk[$index]);
        session()->put('barang_masuk', array_values($barangMasuk));

        return redirect()->route('barang-masuk.create');
    }
}
