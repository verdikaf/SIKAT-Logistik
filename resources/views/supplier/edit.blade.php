@extends('main')

@section('title', 'Supplier')

@section('section-header')
    <div class="section-header">
        <h1>Supplier & Donatur Logistik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('master-data/supplier') }}">Supplier & Donatur</a></div>
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
                        <h4>Edit Data Supplier / Donatur Logistik</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('master-data/supplier/'.$supplier->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Nama Supplier / Donatur</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $supplier->nama_supplier) }}" autocomplete="off">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat Supplier / Donatur</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat">{{ old('alamat', $supplier->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-warning">Simpan Perbaruan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
