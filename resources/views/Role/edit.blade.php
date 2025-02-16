@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Data Role</a></li>
                            <li class="breadcrumb-item active">Edit Role</li>
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
                                <form action="{{ route('role.update', $role->id_role) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Kode Role yang tidak bisa diubah (readonly) -->
                                    <div class="form-group">
                                        <label for="kode_role">Kode Role</label>
                                        <input type="text" class="form-control" id="kode_role" name="kode_role"
                                            value="{{ $role->kode_role }}" readonly>
                                    </div>

                                    <!-- Nama Role yang bisa diubah -->
                                    <div class="form-group">
                                        <label for="nama_role">Nama Role</label>
                                        <input type="text" class="form-control" name="nama_role" id="nama_role"
                                            value="{{ $role->nama_role }}" required>
                                    </div>

                                    <!-- Tombol Update dan Batal -->
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ route('role.index') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
