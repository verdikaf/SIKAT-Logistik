@extends('main')

@section('title', 'Satuan')

@section('section-header')
    <div class="section-header">
        <h1>Satuan Logistik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/master-data/satuan') }}">Satuan</a></div>
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
                        <h4>Edit Data Satuan Logistik</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('master-data/satuan/'.$satuan->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Nama Satuan</label>
                                <input type="text" class="form-control @error('nama_satuan') is-invalid @enderror" name="nama_satuan" value="{{ old('nama_satuan', $satuan->nama_satuan) }}" placeholder="Masukkan nama satuan" autocomplete="off">
                                @error('nama_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
