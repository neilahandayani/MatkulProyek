@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- Perbaiki route home -->
                            <li class="breadcrumb-item"><a href="{{ route('Barang.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">



                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Form Edit Barang -->
                                <form action="{{ route('Barang.update', $barang->id_barang) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Kode Barang (readonly) -->
                                    <div class="form-group">
                                        <label for="kode_barang">Kode Barang:</label>
                                        <input type="text" name="kode_barang" class="form-control"
                                            value="{{ $barang->kode_barang }}" readonly>
                                    </div>

                                    <!-- Nama Barang -->
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang:</label>
                                        <input type="text" name="nama_barang" class="form-control"
                                            value="{{ old('nama_barang', $barang->nama_barang) }}"
                                            placeholder="Masukkan Nama Barang" required>
                                    </div>

                                    <!-- Jenis Barang -->
                                    <div class="form-group">
                                        <label for="id_jenisbarang">Jenis Barang:</label>
                                        <select name="id_jenisbarang" class="form-control" required>
                                            @foreach ($jenisBarang as $jenis)
                                                <option value="{{ $jenis->id_jenisbarang }}"
                                                    {{ $barang->id_jenisbarang == $jenis->id_jenisbarang ? 'selected' : '' }}>
                                                    {{ $jenis->jenis_barang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Satuan -->
                                    <div class="form-group">
                                        <label for="id_satuan">Satuan:</label>
                                        <select name="id_satuan" class="form-control" required>
                                            @foreach ($satuan as $s)
                                                <option value="{{ $s->id_satuan }}"
                                                    {{ old('id_satuan', $barang->id_satuan) == $s->id_satuan ? 'selected' : '' }}>
                                                    {{ $s->nama_satuan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Catatan -->
                                    <div class="form-group">
                                        <label for="catatan">Catatan:</label>
                                        <textarea name="catatan" class="form-control" placeholder="Masukkan catatan">{{ old('catatan', $barang->catatan) }}</textarea>
                                    </div>

                                    <!-- Tombol Update dan Cancel -->
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ route('Barang.index') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
