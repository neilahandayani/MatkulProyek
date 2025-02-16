@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Satuan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Satuan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
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

                                <form action="{{ route('satuan.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_satuan">Nama Satuan:</label>
                                        <input type="text" name="nama_satuan" class="form-control"
                                            placeholder="Masukkan nama satuan" value="{{ old('nama_satuan') }}">

                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="{{ route('satuan.index') }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
