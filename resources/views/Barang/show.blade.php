@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('Barang.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Detail Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Barang</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang:</label>
                            <p>{{ $barang->kode_barang }}</p>
                        </div>

                        <div class="form-group">
                            <label for="nama_barang">Nama Barang:</label>
                            <p>{{ $barang->nama_barang }}</p>
                        </div>

                        <div class="form-group">
                            <label for="jenis_barang">Jenis Barang:</label>
                            <p>{{ $barang->jenisBarang->jenis_barang }}</p>
                        </div>

                        <div class="form-group">
                            <label for="nama_satuan">Satuan:</label>
                            <p>{{ $barang->satuan->nama_satuan }}</p>
                        </div>

                        <div class="form-group">
                            <label for="catatan">Catatan:</label>
                            <p>{{ $barang->catatan }}</p>
                        </div>

                        <a href="{{ route('Barang.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
