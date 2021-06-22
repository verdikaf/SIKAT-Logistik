@extends('main')

@section('title', 'Logistik')

@section('section-header')
    <div class="section-header">
        <h1>Logistik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/master-data/logistik') }}">Logistik</a></div>
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
                        <h4>Edit Data Logistik</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('master-data/logistik/'.$logistik->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Nama Logistik</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $logistik->nama_logistik) }}" autocomplete="off">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Kategori logistik</label>
                                    <select class="form-control select2 @error('kategori_id') is-invalid @enderror" name="kategori_id">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}" {{ old('kategori_id', $logistik->kategori_id) == $item->id ? 'selected' : null }}>{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Satuan</label>
                                    <select class="form-control select2 @error('satuan_id') is-invalid @enderror" name="satuan_id">
                                        <option value="">-- Pilih Satuan --</option>
                                        @foreach ($satuan as $item)
                                            <option value="{{ $item->id }}" {{ old('satuan_id', $logistik->satuan_id) == $item->id ? 'selected' : null }}>{{ $item->nama_satuan }}</option>
                                        @endforeach
                                    </select>
                                    @error('satuan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Logistik</label>
                                <textarea id="textarea" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi">{{ old('deskripsi', $logistik->deskripsi) }}</textarea>
                                @error('deskripsi')
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
