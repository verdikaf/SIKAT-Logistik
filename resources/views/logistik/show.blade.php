@extends('main')

@section('title', 'Logistik')

@section('section-header')
    <div class="section-header">
        <h1>Detail Logistik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/master-data/logistik') }}">Logistik</a></div>
            <div class="breadcrumb-item">Detail Logistik</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                <div class="card-header">
                    <a class="btn btn-warning" href="{{ url()->previous() }}">Kembali</a>
                    &nbsp;&nbsp;
                    <h4>Detail {{ $logistik->nama_logistik }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th scope="col">Nama Logistik</th>
                                <td>{{ $logistik->nama_logistik }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Stok</th>
                                <td>{{ $logistik->stok ." ". $logistik->satuan->nama_satuan }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Kategori</th>
                                <td>{{ $logistik->kategori->nama_kategori }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Deskripsi Produk</th>
                                <td>{{ $logistik->deskripsi }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
