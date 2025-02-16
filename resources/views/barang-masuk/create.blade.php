@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Transaksi Barang Masuk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('barang-masuk.index') }}">Transaksi Masuk</a></li>
                            <li class="breadcrumb-item active">Tambah Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">Form Transaksi Barang Masuk</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Menampilkan Pesan Error jika ada error -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Form Input Transaksi -->
                                <form action="{{ route('barang-masuk.store') }}" method="POST">
                                    @csrf
                                    <!-- Input Transaksi Masuk (Kode & Tanggal Masuk) -->
                                    <div class="form-group">
                                        <label for="kode_transaksi_masuk">Kode Transaksi Masuk</label>
                                        <input type="text" class="form-control" id="kode_transaksi_masuk"
                                            name="kode_transaksi_masuk" value="{{ $kodeTransaksi }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_masuk">Tanggal Masuk</label>
                                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk"
                                            required>
                                    </div>

                                    <hr>

                                    <h5>Tambah Barang</h5>
                                    <!-- Form untuk memilih barang dan jumlah barang masuk -->
                                    <div class="form-group">
                                        <label for="id_barang">Pilih Barang:</label>
                                        <select name="id_barang" id="id_barang" class="form-control" required>
                                            <option value="">-- Pilih Barang --</option>
                                            @foreach ($barang as $item)
                                                <option value="{{ $item->id_barang }}">{{ $item->nama_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah_masuk">Jumlah Masuk:</label>
                                        <input type="number" class="form-control" id="jumlah_masuk" name="jumlah_masuk"
                                            required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Tambah Barang</button>
                                </form>

                                <hr>

                                @if (session('barang_masuk'))
                                    <h5>Daftar Barang Masuk</h5>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Jumlah Masuk</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (session('barang_masuk') as $index => $barang)
                                                <tr>
                                                    <td>{{ $barang['nama_barang'] }}</td>
                                                    <td>{{ $barang['jumlah_masuk'] }}</td>
                                                    <td>
                                                        <a href="{{ route('barang-masuk.removeBarang', $index) }}"
                                                            class="btn btn-danger btn-sm">Hapus</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                <hr>

                                <!-- Tombol untuk menyimpan transaksi -->
                                <button type="submit" class="btn btn-success">Simpan Transaksi</button>
                                <button type="submit" class="btn btn-success">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
