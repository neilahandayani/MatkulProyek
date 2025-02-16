@extends('layouts.app')

@section('title', 'Transaksi Barang Masuk')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Barang Masuk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Barang Masuk</li>
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
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="card-body">

                                            <div class="container">
                                                <h1>Buat Transaksi Baru</h1>

                                                <form action="{{ route('transaksi-masuk.store') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="kode_transaksi_masuk">Kode Transaksi</label>
                                                        <input type="text" name="kode_transaksi_masuk"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="tanggal_masuk">Tanggal Masuk</label>
                                                        <input type="date" name="tanggal_masuk" class="form-control"
                                                            required>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </form>
                                            </div>
                                        @endsection
