@extends('layouts.app')

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
                        <h1 class="m-0">Data Jenis Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Jenis Barang</li>
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
                                            <!-- Ubah justify-content-end ke justify-content-between -->
                                            <!-- Tombol Tambah Data dengan margin kanan -->
                                            <a href="{{ route('JenisBarang.create') }}"
                                                class="btn btn-primary btn-sm">Tambah
                                                Data</a>

                                            <!-- Form Cari dengan margin kiri -->
                                            <form action="{{ route('JenisBarang.index') }}" method="GET"
                                                class="d-flex ms-3">
                                                <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="search" class="form-control float-right"
                                                        placeholder="Cari Jenis Barang" value="{{ request()->search }}">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 10%;">No</th>
                                                    <!-- Pusatkan nomor -->
                                                    <th class="text-left" style="width: 60%;">Nama Jenis Barang</th>
                                                    <!-- Nama Jenis Barang rata kiri -->
                                                    <th class="text-center" style="width: 30%;">Aksi</th>
                                                    <!-- Aksi rata tengah -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($jenisBarang as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <!-- Nomor Urut -->
                                                        <td class="text-left">{{ $item->jenis_barang }}</td>
                                                        <!-- Nama Jenis Barang rata kiri -->
                                                        <td class="text-center">
                                                            <!-- Tombol Edit -->
                                                            <a href="{{ route('JenisBarang.edit', $item->id_jenisbarang) }}"
                                                                class="btn btn-warning btn-sm"> <i class="fas fa-pen">
                                                                </i>Edit</a>

                                                            <!-- Form Hapus -->
                                                            <form
                                                                action="{{ route('JenisBarang.destroy', $item->id_jenisbarang) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data {{ $item->jenis_barang }}?')">
                                                                    <i class="fas fa-trash-alt"> </i> Hapus
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">Data tidak ditemukan.</td>
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

                <!-- Tampilan Pagination -->
                <div class="d-flex justify-content-center my-4">
                    {{ $jenisBarang->links() }}
                </div>
            </div>
        </section>
    </div>
@endsection
