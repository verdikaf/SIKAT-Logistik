@extends('main')

@section('title', 'Pegawai')

@section('section-header')
    <div class="section-header">
        <h1>Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Pegawai</div>
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
                        <a class="btn btn-warning" href="{{ url('/data-pegawai/pegawai/create') }}">Tambah</a>
                        &nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ url('/data-pegawai/pegawai') }}"><i class="fas fa-sync"></i></a>
                        &nbsp;&nbsp;
                        <h4>Data Pegawai</h4>
                        <div class="card-header-form">
                            <form action="{{ url('data-pegawai/pegawai') }}" method="GET" role="search" style="width: 300px">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari NIP / Nama Pegawai / Jabatan" autocomplete="off" required>
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
                                    <th scope="col">NIP</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">No. Telepon</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Info</th>
                                </tr>
                                @foreach ($pegawai as $key => $item)
                                <tr>
                                    <td>{{ $pegawai->FirstItem() + $key }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_pegawai }}</td>
                                    <td>{{ $item->role->nama_role }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <div class="badge badge-success">Aktif</div>
                                        @else
                                            <div class="badge badge-danger">Non-Aktif</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/data-pegawai/pegawai/'.$item->id) }}" class="btn btn-icon icon-left btn-warning fas fa-info-circle"></a>
                                        <a href="{{ url('/data-pegawai/pegawai/'.$item->id.'/edit') }}" class="btn btn-icon icon-left btn-primary far fa-edit"></a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <div class="card-body">
                                {{ $pegawai->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
