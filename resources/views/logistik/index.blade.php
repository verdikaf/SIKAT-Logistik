@extends('main')

@section('title', 'Logistik')

@section('section-header')
    <div class="section-header">
        <h1>Logistik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Logistik</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-warning" href="{{ url('master-data/logistik/create') }}">Tambah</a>
                        &nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ url('/master-data/logistik') }}"><i class="fas fa-sync"></i></a>
                        &nbsp;&nbsp;
                        <h4>Data Logistik</h4>
                        <div class="card-header-form">
                            <form action="{{ url('master-data/logistik') }}" method="GET" role="search">
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Info</th>
                                </tr>
                                @foreach ($logistik as $key => $item)
                                <tr>
                                    <td>{{ $logistik->FirstItem() + $key }}</td>
                                    <td>{{ $item->nama_logistik }}</td>
                                    <td>{{ $item->stok ." ". $item->satuan->nama_satuan }}</td>
                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                    <td>
                                        <a href="{{ url('/master-data/logistik/'.$item->id) }}" class="btn btn-icon icon-left btn-warning"><i class="fas fa-info-circle"></i> Detail</a>
                                        <a href="{{ url('/master-data/logistik/'.$item->id.'/edit') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <div class="card-body">
                                {{ $logistik->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
