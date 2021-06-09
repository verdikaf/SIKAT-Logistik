@extends('main')

@section('title', 'Kategori')

@section('section-header')
    <div class="section-header">
        <h1>Kategori Logistik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Kategori</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-warning" href="{{ url('master-data/kategori/create') }}">Tambah</a>
                        &nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ url('master-data/kategori') }}"><i class="fas fa-sync"></i></a>
                        &nbsp;&nbsp;
                        <h4>Data Kategori Logistik</h4>
                        <div class="card-header-form">
                            <form action="{{ url('master-data/kategori') }}" method="GET" role="search">
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
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Jenis Logistik</th>
                                    <th scope="col">Info</th>
                                </tr>
                                @foreach ($kategori as $key => $item)
                                <tr>
                                    <td>{{ $kategori->FirstItem() + $key }}</td>
                                    <td>{{ $item->nama_kategori }}</td>
                                    <td>{{ $item->tipe_logistik }}</td>
                                    <td>
                                        <a href="{{ url('master-data/kategori/'.$item->id.'/edit') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <div class="card-body">
                                {{ $kategori->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
