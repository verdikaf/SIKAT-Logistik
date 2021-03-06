@extends('main')

@section('title', 'Transaksi Kembali')

@section('section-header')
    <div class="section-header">
        <h1>Transaksi Logistik Kembali</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Transaksi Logistik Kembali</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-secondary" href="{{ url('/transaksi/t_kembali') }}"><i class="fas fa-sync"></i></a>
                        &nbsp;&nbsp;
                        <h4>Data Transaksi Logistik Kembali</h4>
                        <div class="card-header-form">
                            <form action="{{ url('transaksi/t_kembali') }}" method="GET" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari No. Transaksi" autocomplete="off" required>
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
                                    <th scope="col">Nomor Transaksi</th>
                                    <th scope="col" style="width: 25%">Lokasi</th>
                                    <th scope="col" style="width: 15%">Tanggal Transaksi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Info</th>
                                </tr>
                                @foreach ($transaksi as $key => $item)
                                    <tr>
                                        <td>{{ $transaksi->FirstItem() + $key }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->lokasi }}</td>
                                        <td>{{ date("d-m-Y", strtotime($item->tanggal)) }}</td>
                                        <td>
                                            @if ($item->status == 5)
                                                <div class="badge badge-success">Sudah Kembali</div>
                                            @elseif ($item->status == 6)
                                                <div class="badge badge-success">Sudah Kembali</div>
                                            @elseif ($item->status == 4)
                                                <div class="badge badge-info">Belum Kembali</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/transaksi/t_kembali/'.$item->id.'/cart') }}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                            @if ($item->status == 5 || $item->status == 6)
                                                <a href="{{ url('/transaksi/t_keluar/'.$item->id.'/cetak') }}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="card-body">
                                {{ $transaksi->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
