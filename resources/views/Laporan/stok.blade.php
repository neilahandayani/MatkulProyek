@extends('layouts.app')

@section('title', 'Laporan Stok')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan Stok Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Barang</li>
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
                                            <div class="form-group">
                                                <label for="kategori_stok">Stok Barang</label>
                                                <select class="form-control" id="kategori_stok" name="kategori_stok">
                                                    <option value="">Cari Stok Barang</option>
                                                    <option value="kategori1">Kode Barang</option>
                                                    <option value="kategori2">Nama Barang</option>
                                                </select>
                                            </div>

                                            <button id="tampilkanData" class="btn btn-primary">
                                                <i class="fas fa-eye"></i> Tampilkan Data
                                            </button>
                                            <button id="cetakLaporan" class="btn btn-success">
                                                <i class="fas fa-print"></i> Cetak Laporan
                                            </button>

                                            <!-- Awalnya tabel disembunyikan -->
                                            <table class="table table-bordered table-hover table-striped mt-3"
                                                id="tableStok" style="display: none;">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Jenis Barang</th>
                                                        <th>Satuan</th>
                                                        <th>Stok</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Data akan ditambahkan di sini melalui JavaScript -->
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Event listener untuk tombol Tampilkan Data
                                        document.getElementById('tampilkanData').addEventListener('click', function() {
                                            var kategoriId = document.getElementById('kategori_stok').value;
                                            if (kategoriId) {
                                                // Simulasikan pemuatan data berdasarkan kategori
                                                var data = getDataByKategori(kategoriId);
                                                // Perbarui tabel dengan data yang diterima
                                                updateTable(data);

                                                // Tampilkan tabel setelah data dipilih
                                                document.getElementById('tableStok').style.display = 'table';
                                            } else {
                                                alert('Pilih kategori terlebih dahulu.');
                                                document.getElementById('tableStok').style.display = 'none';
                                            }
                                        });

                                        // Event listener untuk tombol Cetak Laporan

                                        document.getElementById('cetakLaporan').addEventListener('click', function() {
                                            var kategoriId = document.getElementById('kategori_stok').value;
                                            if (kategoriId) {
                                                // Simulasikan proses pencetakan laporan
                                                printReport(kategoriId);
                                            } else {
                                                alert('Pilih kategori terlebih dahulu.');
                                            }
                                        });
                                    });

                                    // Fungsi untuk mendapatkan data berdasarkan kategori (simulasi)
                                    function getDataByKategori(kategoriId) {
                                        // Data simulasi
                                        var data = {
                                            kategori1: [{
                                                    kode_barang: 'B001',
                                                    nama_barang: 'Barang A',
                                                    jenis_barang: 'Jenis 1',
                                                    nama_satuan: 'PCS',
                                                    stok: 100
                                                },
                                                {
                                                    kode_barang: 'B002',
                                                    nama_barang: 'Barang B',
                                                    jenis_barang: 'Jenis 1',
                                                    nama_satuan: 'PCS',
                                                    stok: 150
                                                }
                                            ],
                                            kategori2: [{
                                                    kode_barang: 'B003',
                                                    nama_barang: 'Barang C',
                                                    jenis_barang: 'Jenis 2',
                                                    nama_satuan: 'PCS',
                                                    stok: 200
                                                },
                                                {
                                                    kode_barang: 'B004',
                                                    nama_barang: 'Barang D',
                                                    jenis_barang: 'Jenis 2',
                                                    nama_satuan: 'PCS',
                                                    stok: 250
                                                }
                                            ],
                                            kategori3: [{
                                                    kode_barang: 'B005',
                                                    nama_barang: 'Barang E',
                                                    jenis_barang: 'Jenis 3',
                                                    nama_satuan: 'PCS',
                                                    stok: 300
                                                },
                                                {
                                                    kode_barang: 'B006',
                                                    nama_barang: 'Barang F',
                                                    jenis_barang: 'Jenis 3',
                                                    nama_satuan: 'PCS',
                                                    stok: 350
                                                }
                                            ]
                                        };
                                        return data[kategoriId] || [];
                                    }

                                    // Fungsi untuk memperbarui tabel dengan data baru
                                    function updateTable(data) {
                                        var tbody = document.querySelector('table tbody');
                                        tbody.innerHTML = ''; // Kosongkan tabel sebelum menambahkan data baru
                                        data.forEach(function(item) {
                                            var row = document.createElement('tr');
                                            row.innerHTML = `
                                                                                            <td>${item.kode_barang}</td>
                                                <td>${item.nama_barang}</td>
                                                <td>${item.jenis_barang}</td>
                                                <td>${item.nama_satuan}</td>
                                                <td>${item.stok}</td>
                                            `;
                                            tbody.appendChild(row);
                                        });
                                    }

                                    // Fungsi untuk proses pencetakan laporan (simulasi)
                                    function printReport(kategoriId) {
                                        var data = getDataByKategori(kategoriId);
                                        var printWindow = window.open('', '', 'height=600,width=800');
                                        printWindow.document.write('<html><head><title>Laporan Stok Barang</title>');
                                        // Menambahkan CSS untuk mencetak dengan style yang lebih rapi

                                        printWindow.document.write(`
                                            <style>
                                                                body { font-family: Arial, sans-serif; }
                                                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                                                th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                                                th { background-color: #f2f2f2; }
                                                                                            </style>
                                        `);
                                        printWindow.document.write('</head><body>');
                                        printWindow.document.write(`
    <html>
        <head>
            <title>Laporan Stok Barang</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center; /* Memusatkan teks secara horizontal */
                }
                .header {
                    margin: 0 auto;
                    width: 80%; /* Sesuaikan lebar sesuai kebutuhan */
                    text-align: center; /* Memusatkan teks dalam div */
                }
                h3 {
                    margin: 0;
                }
                p {
                    margin: 5px 0;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h3>StokMate - Laporan Stok Barang</h3>
                <p>Alamat: Kebun Jeruk, Jakarta Barat, Jakarta</p>
                <p>Nomor Telp: 08232525445</p>
                <p>Email: stokmate.app@gmail.com | Website: www.stokmate.co.id</p>
            </div>
            <!-- Konten lainnya -->
        </body>
    </html>
`);


                                        printWindow.document.write(
                                            '<table><thead><tr><th>Kode Barang</th><th>Nama Barang</th><th>Jenis Barang</th><th>Satuan</th><th>Stok</th></tr></thead><tbody>'
                                        );
                                        data.forEach(function(item) {
                                            printWindow.document.write(`
                                                <tr>
                                                    <td>${item.kode_barang}</td>
                                                    <td>${item.nama_barang}</td>
                                                    <td>${item.jenis_barang}</td>
                                                    <td>${item.nama_satuan}</td>
                                                    <td>${item.stok}</td>
                                                </tr>
                                            `);
                                        });
                                        printWindow.document.write('</tbody></table>');
                                        printWindow.document.write('</body></html>');
                                        printWindow.document.close();
                                        printWindow.print();
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
    </div>
@endsection
