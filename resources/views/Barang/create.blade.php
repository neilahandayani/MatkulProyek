@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('Barang.index') }}">Data Barang</a></li>
                            <li class="breadcrumb-item active">Tambah Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
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

                <!-- Card untuk memberikan latar belakang putih seperti kertas -->
                <div class="card">
                    <div class="card-body">
                        <!-- Form Tambah Barang -->
                        <form action="{{ route('Barang.store') }}" method="POST">
                            @csrf

                            <!-- Input Kode Barang (Read-Only) -->
                            <div class="form-group">
                                <label for="kode_barang">Kode Barang</label>
                                <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                    value="{{ old('kode_barang', $kodeBarang) }}" readonly>
                            </div>



                            <div class="form-group">
                                <label for="nama_barang">Nama Barang:</label>
                                <input type="text" name="nama_barang"
                                    class="form-control @error('nama_barang') is-invalid @enderror"
                                    placeholder="Masukkan Nama Barang" value="{{ old('nama_barang') }}" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_jenisbarang">Jenis Barang:</label>
                                <select name="id_jenisbarang" class="form-control">
                                    <option value="">Pilih Jenis Barang</option>
                                    @foreach ($jenisBarang as $jenis)
                                        <option value="{{ $jenis->id_jenisbarang }}"
                                            {{ old('id_jenisbarang') == $jenis->id_jenisbarang ? 'selected' : '' }}>
                                            {{ $jenis->jenis_barang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_satuan">Satuan:</label>
                                <select name="id_satuan" class="form-control">
                                    <option value="">Pilih Satuan</option>
                                    @foreach ($satuan as $s)
                                        <option value="{{ $s->id_satuan }}"
                                            {{ old('id_satuan') == $s->id_satuan ? 'selected' : '' }}>
                                            {{ $s->nama_satuan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="catatan">Catatan:</label>
                                <textarea name="catatan" class="form-control" placeholder="Masukkan Catatan">{{ old('catatan') }}</textarea>
                            </div>

                            <!-- Tombol Simpan dan Batal -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('Barang.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
