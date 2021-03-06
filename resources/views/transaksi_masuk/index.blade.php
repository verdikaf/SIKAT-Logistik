@extends('main')

@section('title', 'Transaksi Masuk')

@section('section-header')
    <div class="section-header">
        <h1>Transaksi Logistik Masuk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Transaksi Logistik Masuk</div>
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
                        @if (session('berhasil_login')['role'] == 1)
                        <a class="btn btn-warning" href="{{ url('transaksi/t_masuk/create') }}">Tambah</a>
                        &nbsp;&nbsp;
                        @endif
                        <a class="btn btn-secondary" href="{{ url('/transaksi/t_masuk') }}"><i class="fas fa-sync"></i></a>
                        &nbsp;&nbsp;
                        <h4>Data Transaksi Logistik Masuk</h4>
                        <div class="card-header-form">
                            <form action="{{ url('transaksi/t_masuk') }}" method="GET" role="search" style="width: 300px">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari No. Transaksi / Nama Supplier" autocomplete="off" required>
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
                                    <th scope="col">Nama Supplier</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Info</th>
                                </tr>
                                @foreach ($transaksi as $key => $item)
                                <tr>
                                    <td>{{ $transaksi->FirstItem() + $key }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->supplier->implode('nama_supplier') }}</td>
                                    <td>{{ date("d-m-Y", strtotime($item->tanggal)) }}</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <div class="badge badge-warning">Pending</div>
                                        @elseif ($item->status == 1)
                                            <div class="badge badge-info">Dalam Proses</div>
                                        @elseif ($item->status == 2)
                                            <div class="badge badge-success">Selesai</div>
                                            <div class="badge badge-danger">Dengan catatan</div>
                                        @elseif ($item->status == 3)
                                            <div class="badge badge-success">Selesai</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/transaksi/t_masuk/'.$item->id.'/cart') }}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                        @if ($item->status == 2 || $item->status == 3)
                                            <a href="{{ url('/transaksi/t_masuk/'.$item->id.'/cetak') }}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i></a>
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
