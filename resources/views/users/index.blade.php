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
                        <h1 class="m-0">Daftar User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Daftar User</li>
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
                                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">Tambah
                                                User</a>
                                        </div>
                                    </div>

                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 10%;">No</th>
                                                    <th class="text-left" style="width: 20%;">Kode User</th>
                                                    <th class="text-left" style="width: 30%;">Nama User</th>
                                                    <th class="text-left" style="width: 20%;">Username</th>
                                                    <th class="text-left" style="width: 20%;">Role</th>
                                                    <th class="text-center" style="width: 10%;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-left">{{ $user->kode_user }}</td>
                                                        <td class="text-left">{{ $user->nama_user }}</td>
                                                        <td class="text-left">{{ $user->username }}</td>
                                                        <td class="text-left">{{ $user->role->nama_role }}</td>
                                                        <!-- Menampilkan nama role -->
                                                        <td class="text-center">
                                                            <!-- Tombol Edit -->
                                                            <a href="{{ route('users.edit', $user->id_user) }}"
                                                                class="btn btn-warning btn-sm"><i class="fas fa-pen"></i>
                                                                Edit</a>

                                                            <!-- Tombol Hapus -->
                                                            <form action="{{ route('users.destroy', $user->id_user) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->nama_user }}?')">
                                                                    <i class="fas fa-trash-alt"></i> Hapus</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- Pagination -->
        <div class="d-flex justify-content-center my-4">
            {{ $users->links() }} <!-- Menampilkan pagination -->
        </div>
    </div>
@endsection
