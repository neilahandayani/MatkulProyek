@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Data Role</a></li>
                            <li class="breadcrumb-item active">Tambah Role</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Tambah Role -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <form action="{{ route('role.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="kode_role">Kode Role</label>
                                        <input type="text" class="form-control" id="kode_role" name="kode_role"
                                            value="{{ $kode_role }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_role">Nama Role</label>
                                        <input type="text" class="form-control @error('nama_role') is-invalid @enderror"
                                            id="nama_role" name="nama_role" value="{{ old('nama_role') }}" required>
                                        @error('nama_role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="{{ route('role.index') }}" class="btn btn-secondary">Batal</a>
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
