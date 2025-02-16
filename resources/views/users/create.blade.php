@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah User Baru</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Data User</a></li>
                            <li class="breadcrumb-item active">Tambah User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Tambah User -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('users.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="kode_user">Kode User</label>
                                        <input type="text" class="form-control" id="kode_user" name="kode_user"
                                            value="{{ $kode_user }}" readonly>

                                    </div>

                                    <div class="form-group">
                                        <label for="nama_user">Nama User</label>
                                        <input type="text" class="form-control @error('nama_user') is-invalid @enderror"
                                            id="nama_user" name="nama_user" value="{{ old('nama_user') }}" required
                                            maxlength="30">
                                        @error('nama_user')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username" value="{{ old('username') }}" required
                                            maxlength="30">
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="password_confirmation" name="password_confirmation" required>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="id_role">Role</label>
                                        <select name="id_role" class="form-control @error('id_role') is-invalid @enderror"
                                            required>
                                            <option value="">Pilih Role</option>
                                            @foreach ($role as $role)
                                                <option value="{{ $role->id_role }}"
                                                    {{ old('id_role') == $role->id_role ? 'selected' : '' }}>
                                                    {{ $role->nama_role }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
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
