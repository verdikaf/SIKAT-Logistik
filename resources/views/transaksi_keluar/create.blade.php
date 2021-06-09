@extends('main')

@section('title', 'Transaksi Keluar')

@section('section-header')
    <div class="section-header">
        <h1>Transaksi Logistik Keluar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dasboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/transaksi/t_keluar') }}">Transaksi Logistik Keluar</a></div>
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
                        <h4>Data Nota Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('transaksi/t_keluar') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nomor transaksi</label>
                                    <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id', $inv) }}" readonly>
                                    @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tanggal transaksi</label>
                                    <input type="text" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ date('d-m-Y H:i:s') }}" readonly>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Petugas</label>
                                    <input type="hidden" class="form-control @error('pegawai_id') is-invalid @enderror" name="pegawai_id" value="{{ session('berhasil_login')['id'] }}">
                                    <input type="text" class="form-control @error('pegawai') is-invalid @enderror" name="pegawai" value="{{ session('berhasil_login')['nama'] }}" readonly>
                                    @error('pegawai_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Lokasi Distribusi</label>
                                    <textarea id="textarea" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" placeholder="Masukkan lokasi distribusi" autofocus>{{ old('lokasi') }}</textarea>
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <a href="{{ url('transaksi/t_keluar') }}" type="button" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Lanjutkan ke Detail Transaksi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

