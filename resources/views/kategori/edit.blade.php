@extends('main')

@section('title', 'Kategori')

@section('section-header')
    <div class="section-header">
        <h1>Kategori Logistik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('master-data/kategori') }}">Kategori</a></div>
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
                        <h4>Edit Data Kategori Logistik</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('master-data/kategori/'.$kategori->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" autocomplete="off">
                                @error('nama_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis Logistik</label>
                                <select class="form-control @error('tipe_logistik') is-invalid @enderror" name="tipe_logistik">
                                    <option value="">-- Pilih --</option>
                                    <option value="Habis Pakai" @if (old('tipe_logistik', $kategori->tipe_logistik) == 'Habis pakai') selected="selected" @endif>Habis Pakai</option>
                                    <option value="Tidak Habis Pakai" @if (old('tipe_logistik', $kategori->tipe_logistik) == 'Tidak habis pakai') selected="selected" @endif>Tidak Habis Pakai</option>
                                </select>
                                @error('tipe_logistik')
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
