@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Transaksi Masuk</h1>

        <a href="{{ route('transaksi-masuk.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksiMasuk as $transaksi)
                    <tr>
                        <td>{{ $transaksi->id_transaksi_masuk }}</td>
                        <td>{{ $transaksi->kode_transaksi_masuk }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('transaksi-masuk.show', $transaksi->id_transaksi_masuk) }}"
                                class="btn btn-info">Lihat</a>
                            <!-- Tombol edit dan hapus bisa ditambahkan di sini -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Navigasi pagination -->
        {{ $transaksiMasuk->links() }}
    </div>
@endsection
