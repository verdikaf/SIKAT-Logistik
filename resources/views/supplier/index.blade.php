@extends('main')

@section('title', 'Supplier')

@section('section-header')
    <div class="section-header">
        <h1>Supplier & Donatur Logistik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Supplier & Donatur</div>
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
                        <a class="btn btn-warning" href="{{ url('master-data/supplier/create') }}">Tambah</a>
                        &nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ url('/master-data/supplier') }}"><i class="fas fa-sync"></i></a>
                        &nbsp;&nbsp;
                        <h4>Data Supplier & Donatur Logistik</h4>
                        <div class="card-header-form">
                            <form action="{{ url('master-data/supplier') }}" method="GET" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari Nama Supplier" autocomplete="off" required>
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
                                    <th scope="col">No. Telepon</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Info</th>
                                </tr>
                                @foreach ($supplier as $key => $item)
                                <tr>
                                    <td>{{ $supplier->firstItem() + $key }}</td>
                                    <td>{{ $item->nama_supplier }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>
                                        <a href="{{ url('/master-data/supplier/'.$item->id.'/edit') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Edit</a>
                                    </td>
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
