<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\JenisBarangController;
use App\Models\JenisBarang;
use App\Models\Satuan;
use App\Models\Barang;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransaksiMasukController;
use App\Http\Controllers\LaporanController;



//Route::get('/', function () {
//    return view('welcome');
//});

//Dashboard
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


//Satuan
Route::resource('satuan', SatuanController::class);
Route::get('satuan/{id}/edit', [SatuanController::class, 'edit'])->name('satuan.edit');


//Jenis Barang

Route::resource('JenisBarang', JenisBarangController::class);
Route::get('jenis_barang/{id}/edit', [JenisBarangController::class, 'edit'])->name('JenisBarang.edit');

//Jenis Barang

Route::resource('Barang', BarangController::class);
Route::get('barang/{id}/edit', [BarangController::class, 'edit'])->name('Barang.edit');
Route::get('barang/{id}/show', [BarangController::class, 'show'])->name('Barang.show');

//Role
Route::resource('role', RoleController::class);


//mengambil data stok barang
Route::get('/barang/{id}', function ($id) {
    $barang = Barang::findOrFail($id);
    return response()->json(['stok' => $barang->stok]);
});


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});



Route::resource('users', UserController::class);




// Rute resource untuk transaksi masuk (CRUD standar)
Route::resource('transaksi-masuk', TransaksiMasukController::class);

// Rute resource untuk barang masuk (CRUD standar)
Route::resource('barang-masuk', BarangMasukController::class);

// Rute untuk menambah barang sementara ke transaksi barang masuk
Route::post('/barang-masuk/add', [BarangMasukController::class, 'addBarang'])->name('barang-masuk.addBarang');

// Rute untuk menghapus barang sementara dari transaksi
Route::get('/barang-masuk/remove/{index}', [BarangMasukController::class, 'removeBarang'])->name('barang-masuk.removeBarang');

// Rute untuk mengupdate barang sementara (misalnya jika ingin mengganti jumlah barang)
Route::post('/barang-masuk/update/{index}', [BarangMasukController::class, 'updateBarang'])->name('barang-masuk.updateBarang');

//Route::get('/barang-masuk/create', [TransaksiMasukController::class, 'create'])->name('barang-masuk.create');
//Route::post('/barang-masuk/addBarang', [TransaksiMasukController::class, 'addBarang'])->name('barang-masuk.addBarang');
//Route::post('/barang-masuk/store', [TransaksiMasukController::class, 'store'])->name('barang-masuk.store');
//Route::get('/barang-masuk/removeBarang/{index}', [TransaksiMasukController::class, 'removeBarang'])->name('barang-masuk.removeBarang');










// Laporan
Route::get('/laporan/barang-keluar', [LaporanController::class, 'barangKeluar'])->name('laporan.barang-keluar');
Route::get('/laporan/barang-masuk', [LaporanController::class, 'barangMasuk'])->name('laporan.barang-masuk');
Route::get('/laporan/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
