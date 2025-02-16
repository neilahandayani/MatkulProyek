@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

                <!-- Pesan Sukses -->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <!-- Pesan Error -->
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif



                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('Barang.create') }}" class="btn btn-primary btn-sm">Tambah
                                                Data</a>

                                            <form action="{{ route('Barang.index') }}" method="GET" class="d-flex ms-3">
                                                <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="search" class="form-control float-right"
                                                        placeholder="Cari Barang" value="{{ request()->search }}">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 10%;">No</th>
                                                    <th class="text-left" style="width: 20%;">Kode Barang</th>
                                                    <th class="text-left" style="width: 30%;">Nama Barang</th>
                                                    <th class="text-left" style="width: 20%;">Jenis Barang</th>
                                                    <th class="text-left" style="width: 20%;">Nama Satuan</th>
                                                    <th class="text-center" style="width: 30%;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($barang as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-left">{{ $item->kode_barang }}</td>
                                                        <td class="text-left">{{ $item->nama_barang }}</td>
                                                        <td class="text-left">{{ $item->jenisBarang->jenis_barang }}</td>
                                                        <td class="text-left">{{ $item->satuan->nama_satuan }}</td>
                                                        <td class="text-center">

                                                            <!-- Tombol Detail -->
                                                            <a href="{{ route('Barang.show', $item->id_barang) }}"
                                                                class="btn btn-info btn-sm">
                                                                <i class="fas fa-eye"></i> Detail
                                                            </a>

                                                            <!-- Tombol Edit -->
                                                            <a href="{{ route('Barang.edit', $item->id_barang) }}"
                                                                class="btn btn-warning btn-sm"> <i class="fas fa-pen"></i>
                                                                Edit</a>

                                                            <!-- Form Hapus -->
                                                            <form action="{{ route('Barang.destroy', $item->id_barang) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus barang {{ $item->nama_barang }}?')">
                                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                                                        <!-- Perbaikan colspan menjadi 6 -->
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Tampilan Pagination -->
        <div class="d-flex justify-content-center my-4">
            {{ $barang->links() }}
        </div>
    </div>
@endsection
