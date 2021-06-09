@extends('main')

@section('title', 'Laporan')

@section('section-header')
    <div class="section-header">
        <h1>Laporan Supplier & Donatur Logistik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Laporan Supplier & Donatur</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-warning" href="{{ url('/laporan/supplier/print') }}" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                        &nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ url('/laporan/supplier') }}"><i class="fas fa-home"></i></a>
                        &nbsp;&nbsp;
                        <h4>Laporan Data Supplier & Donatur Logistik</h4>
                        <div class="card-header-form">
                            <form action="{{ url('/laporan/supplier') }}" method="GET" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search" autocomplete="off" required>
                                    <div class="input-group-btn">
                                    <button class="btn btn-warning"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Supplier / Donatur</th>
                                    <th scope="col">Alamat</th>
                                </tr>
                                @foreach ($supplier as $key => $item)
                                <tr>
                                    <td>{{ $supplier->firstItem() + $key }}</td>
                                    <td>{{ $item->nama_supplier }}</td>
                                    <td>{{ $item->alamat }}</td>
                                </tr>
                                @endforeach
                            </table>
                            <div class="card-body">
                                {{ $supplier->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection