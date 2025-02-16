@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Data User</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
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
                                <form action="{{ route('users.update', $user->id_user) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Kode User yang tidak bisa diubah (readonly) -->
                                    <div class="form-group">
                                        <label for="kode_user">Kode User</label>
                                        <input type="text" class="form-control" id="kode_user" name="kode_user"
                                            value="{{ $user->kode_user }}" readonly>
                                    </div>

                                    <!-- Nama User yang bisa diubah -->
                                    <div class="form-group">
                                        <label for="nama_user">Nama User</label>
                                        <input type="text" class="form-control @error('nama_user') is-invalid @enderror"
                                            name="nama_user" id="nama_user" value="{{ old('nama_user', $user->nama_user) }}"
                                            required>
                                        @error('nama_user')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Username yang bisa diubah -->
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            name="username" id="username" value="{{ old('username', $user->username) }}"
                                            required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password (optional) -->
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password"
                                            placeholder="Kosongkan password jika tidak dirubah">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password Confirmation (optional) -->
                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" id="password_confirmation"
                                            placeholder="Kosongkan password jika tidak dirubah">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Role yang bisa diubah -->
                                    <div class="form-group">
                                        <label for="id_role">Role</label>
                                        <select name="id_role" class="form-control @error('id_role') is-invalid @enderror"
                                            required>
                                            @foreach ($role as $role)
                                                <option value="{{ $role->id_role }}"
                                                    {{ $role->id_role == old('id_role', $user->id_role) ? 'selected' : '' }}>
                                                    {{ $role->nama_role }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Tombol Update dan Batal -->
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
