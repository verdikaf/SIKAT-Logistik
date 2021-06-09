@extends('main')

@section('title', 'Jabatan')

@section('section-header')
    <div class="section-header">
        <h1>Jabatan Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/data-pegawai/role') }}">Jabatan</a></div>
            <div class="breadcrumb-item active">Edit Data</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data Jabatan Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('data-pegawai/role/'.$role->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Nama Jabatan</label>
                                <input type="text" class="form-control @error('nama_role') is-invalid @enderror" name="nama_role" value="{{ old('nama_role', $role->nama_role) }}" autocomplete="off">
                                @error('nama_role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
