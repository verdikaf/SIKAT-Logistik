@extends('main')

@section('title', 'Laporan')

@section('section-header')
    <div class="section-header">
        <h1>Laporan Transaksi Logistik Keluar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Laporan Transaksi Keluar</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-secondary" href="{{ url('/laporan/log_keluar') }}"><i class="fas fa-sync"></i></a>
                        &nbsp;&nbsp;
                        <h4>Laporan Transaksi Logistik Keluar</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/laporan/log_keluar') }}" method="get" role="search">
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
                                    <form action="{{ url('laporan/log_keluar/print') }}" method="get" target="_blank">
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
                                        <th scope="col">No. Transaksi</th>
                                        <th scope="col" style="width: 15%">Tanggal Transaksi</th>
                                        <th scope="col">Lokasi Distribusi</th>
                                        <th scope="col" style="width: 20%">Nama Logistik</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    @foreach ($transaksiKeluar as $key => $item)
                                        @foreach ($item->logistik as $log)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ date("d-m-Y", strtotime($item->tanggal)) }}</td>
                                                <td>{{ $item->lokasi }}</td>
                                                <td>{{ $log->pivot->nama_logistik }}</td>
                                                <td>{{ $log->pivot->jumlah.' '.$log->pivot->satuan }}</td>
                                                <td>
                                                    @if ($log->pivot->status == 1 || $log->pivot->status == 2)
                                                        Sukses
                                                    @elseif ($log->pivot->status == 3)
                                                        Gagal
                                                    @elseif ($log->pivot->status == 4)
                                                        Belum Kembali
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </table>
                                <div class="card-body">
                                    {{ $transaksiKeluar->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
