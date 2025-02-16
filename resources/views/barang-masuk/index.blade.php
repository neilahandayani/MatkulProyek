@extends('layouts.app')

@section('title', 'Transaksi Barang Masuk')

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
                            <li class="breadcrumb-item"><a href="{{ route('Barang.index') }}">Data Barang</a></li>
                            <li class="breadcrumb-item active">Transaksi Barang Masuk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card untuk tabel dan tombol -->
        <div class="card">
            <div class="card-body">
                <!-- Pesan Sukses -->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Pesan Error -->
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Tambah Data
                        </a>

                        <!-- Form Pencarian -->
                        <form action="{{ route('barang-masuk.index') }}" method="GET" class="d-flex ms-3">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right"
                                    placeholder="Cari Transaksi" value="{{ request()->search }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Tabel Data Barang Masuk -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode Transaksi Masuk</th>
                                <th class="text-center">Tanggal Masuk</th>
                                <th class="text-center">Barang</th>
                                <th class="text-center">Jumlah Masuk</th>
                                <th class="text-center">Aksi</th> <!-- Kolom untuk aksi -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksiMasuk as $transaksi)
                                @foreach ($transaksi->barangMasuk as $barangMasuk)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->kode_transaksi_masuk }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d M Y') }}</td>
                                        <td>{{ $barangMasuk->barang->nama_barang }}</td>
                                        <td class="text-center">{{ $barangMasuk->jumlah_masuk }}</td>
                                        <td class="text-center">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('barang-masuk.edit', $barangMasuk->id_barangmasuk) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
