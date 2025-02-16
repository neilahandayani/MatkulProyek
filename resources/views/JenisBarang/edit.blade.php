@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Jenis Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Jenis Barang</li>
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

                                <form action="{{ route('JenisBarang.update', $jenisBarang->id_jenisbarang) }}"
                                    method="POST">
                                    <!-- Perbaikan penulisan route dan variabel -->
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="jenis_barang">Nama Jenis Barang:</label>
                                        <input type="text" name="jenis_barang" class="form-control"
                                            value="{{ $jenisBarang->jenis_barang }}"> <!-- Perbaikan variabel -->
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ route('JenisBarang.index') }}" class="btn btn-secondary">Batal</a>
                                    <!-- Perbaikan penulisan route -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
