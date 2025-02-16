@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Satuan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Satuan</li>
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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('satuan.update', $satuan->id_satuan) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="nama_satuan">Nama Satuan:</label>
                                        <input type="text" name="nama_satuan" class="form-control"
                                            value="{{ $satuan->nama_satuan }}">
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ route('satuan.index') }}" class="btn btn-secondary">Batal</a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
    </section>
    </div>
@endsection
