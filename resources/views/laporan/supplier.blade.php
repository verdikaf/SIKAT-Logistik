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
                        <a class="btn btn-secondary" href="{{ url('/laporan/supplier') }}"><i class="fas fa-home"></i></a>
                        &nbsp;&nbsp;
                        <h4>Laporan Data Supplier & Donatur Logistik</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/laporan/supplier') }}" method="get" role="search">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Tanggal Awal</label>
                                    <input type="date" class="form-control datepicker @error('date_start') is-invalid @enderror" name="date_start" id="date_start" value="{{ $date_start }}" required>
                                    @error('date_start')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" class="form-control datepicker @error('date_end') is-invalid @enderror" name="date_end" id="date_end" value="{{ $date_end }}" required>
                                    @error('date_end')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2 mt-4 pt-1">
                                    <button class="btn btn-warning"><i class="fa fa-search"></i> Pencarian Data</button>
                                </div>
                        </form>
                                <div class="form-group col-md-2 mt-4 pt-1 pl-0">
                                    <form action="{{ url('laporan/supplier/print') }}" method="get" target="_blank">
                                        @csrf
                                        <input type="hidden" class="form-control datepicker" name="date_start" value="{{ $date_start }}">
                                        <input type="hidden" class="form-control datepicker" name="date_end" value="{{ $date_end }}">
                                        <button class="btn btn-primary"><i class="fa fa-print"></i> Cetak Data</button>
                                    </form>
                                </div>
                            </div>
                        <div class="row">
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
    </div>
@endsection
