@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-10">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $jumlahBarang }}</h3>

                                <p>Data Barang</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-cube"></i>
                            </div>
                            <a href="{{ route('Barang.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-10">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>

                                <p>Data Barang Masuk</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box nav-icon"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-10">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>

                                <p>Data Barang Keluar</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box-open nav-icon"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Stok Barang</h3>
                                <div class="card-tools">
                                    <form action="{{ route('dashboard') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="search" class="form-control float-right"
                                                placeholder="Search" value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 10%;">No</th>
                                            <th class="text-left" style="width: 20%;">Kode Barang</th>
                                            <th class="text-left" style="width: 25%;">Nama Barang</th>
                                            <th class="text-left" style="width: 20%;">Jenis Barang</th>
                                            <th class="text-left" style="width: 10%;">Stok</th>
                                            <th class="text-center" style="width: 15%;">Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($barang as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-left">{{ $item->kode_barang }}</td>
                                                <td class="text-left">{{ $item->nama_barang }}</td>
                                                <td class="text-left">{{ $item->jenisBarang->jenis_barang }}</td>
                                                <td class="text-left">{{ $item->stok }}</td>
                                                <!-- Misalkan field stok ada di tabel barang -->
                                                <td class="text-left">{{ $item->satuan->nama_satuan }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
