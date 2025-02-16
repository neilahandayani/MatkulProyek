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
                        <h1 class="m-0">Data Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Role</li>
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
                                            <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm">Tambah
                                                Data</a>


                                        </div>
                                    </div>

                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 10%;">No</th>
                                                    <th class="text-left" style="width: 20%;">Kode Role</th>
                                                    <th class="text-left" style="width: 40%;">Nama Role</th>
                                                    <th class="text-center" style="width: 30%;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($roles as $role)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-left">{{ $role->kode_role }}</td>
                                                        <td class="text-left">{{ $role->nama_role }}</td>
                                                        <td class="text-center">
                                                            <!-- Tombol Edit -->
                                                            <a href="{{ route('role.edit', $role->id_role) }}"
                                                                class="btn btn-warning btn-sm">
                                                                <i class="fas fa-pen"></i> Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">Data tidak ditemukan.</td>
                                                    </tr>
                                                @endforelse
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

        <!-- Tampilan Pagination -->
        <div class="d-flex justify-content-center my-4">
            {{ $roles->links() }}
        </div>
    </div>
@endsection
