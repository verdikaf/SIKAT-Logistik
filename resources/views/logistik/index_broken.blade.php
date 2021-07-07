@extends('main')

@section('title', 'Logistik Rusak')

@section('section-header')
    <div class="section-header">
        <h1>Logistik Rusak</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Logistik Rusak</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-secondary" href="{{ url('/master-data/logistik_rusak') }}"><i class="fas fa-sync"></i></a>
                        &nbsp;&nbsp;
                        <h4>Data Logistik Rusak</h4>
                        <div class="card-header-form">
                            <form action="{{ url('master-data/logistik_rusak') }}" method="GET" role="search" style="width: 300px">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari Nama Logistik" autocomplete="off" required>
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
                                    <th scope="col">ID Logistik</th>
                                    <th scope="col">Nama Logistik</th>
                                    <th scope="col">Jumlah Logistik Rusak</th>
                                </tr>
                                @foreach ($logistik as $key => $item)
                                <tr>
                                    <td>{{ $logistik->FirstItem() + $key }}</td>
                                    <td>{{ $item->logistik_id }}</td>
                                    <td>{{ $item->logistik->nama_logistik }}</td>
                                    <td>{{ $item->jumlah }}</td>
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
