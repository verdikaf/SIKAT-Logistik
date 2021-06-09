@extends('main')

@section('title', 'Logistik')

@section('section-header')
    <div class="section-header">
        <h1>Logistik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/master-data/logistik') }}">Logistik</a></div>
            <div class="breadcrumb-item active">Tambah Data</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Data Logistik</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('master-data/logistik') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label>Nomor Logistik</label>
                                    <input type="number" id="id_serial" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id') }}" placeholder="Masukkan nomor logistik" autofocus autocomplete="off">
                                    @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 mt-4 pt-1">
                                    <input type="button" class="btn btn-warning btn-lg" onclick="Random();" value="Generate Nomor Logistik.">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Logistik</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama logistik" autofocus autocomplete="off">
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
                                            <option value="{{ $item->id }}" {{ old('kategori_id') == $item->id ? 'selected' : null }}>{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Satuan Logistik</label>
                                    <select class="form-control select2 @error('satuan_id') is-invalid @enderror" name="satuan_id">
                                        <option value="">-- Pilih Satuan --</option>
                                        @foreach ($satuan as $item)
                                            <option value="{{ $item->id }}" {{ old('satuan_id') == $item->id ? 'selected' : null }}>{{ $item->nama_satuan }}</option>
                                        @endforeach
                                    </select>
                                    @error('satuan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Kondisi Logistik</label>
                                    <select class="form-control @error('kondisi') is-invalid @enderror" name="kondisi">
                                        <option value="">-- Pilih Kondisi Logistik --</option>
                                        <option value="Baik" @if (old('kondisi') == 'Baik') selected="selected" @endif>Baik</option>
                                        <option value="Rusak" @if (old('kondisi') == 'Rusak') selected="selected" @endif>Rusak</option>
                                    </select>
                                    @error('kondisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Masa Pakai Logistik</label>
                                    <input type="date" class="form-control datepicker @error('expired') is-invalid @enderror" name="expired" value="{{ old('expired') }}">
                                    @error('expired')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
                            {{-- <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Supplier Logistik</label>
                                    <select class="form-control select2 @error('supplier_id') is-invalid @enderror" name="supplier_id">
                                        <option value="">-- Pilih Supplier --</option>
                                        @foreach ($supplier as $item)
                                            <option value="{{ $item->id }}" {{ old('supplier_id') == $item->id ? 'selected' : null }}>{{ $item->nama_supplier }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label>Deskripsi Logistik</label>
                                <textarea id="textarea" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" placeholder="Masukkan deskripsi logistik">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-warning">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function Random() {
            var rnd = Math.floor(10000 + Math.random() * 90000);
            var today = new Date();
            today = String(today.getDate()).padStart(2, '0') + String(today.getMonth() + 1).padStart(2, '0') + today.getFullYear() + String(today.getMinutes()).padStart(2, '0') + String(today.getSeconds()).padStart(2, '0');
            console.log(today);
            document.getElementById('id_serial').value = `${rnd}${today}`;
        }
    </script>
@endpush
