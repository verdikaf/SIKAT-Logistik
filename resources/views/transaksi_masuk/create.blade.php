@extends('main')

@section('title', 'Transaksi Masuk')

@section('section-header')
    <div class="section-header">
        <h1>Transaksi Logistik Masuk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dasboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/transaksi/t_masuk') }}">Transaksi Logistik Masuk</a></div>
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
                        <form action="{{ url('transaksi/t_masuk') }}" method="post">
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
                                    <label>Supplier / Donatur Logistik <a data-toggle="modal" href="#supplierModal"> (Tambahkan supplier / donatur baru)</a></label>
                                    <select class="form-control select2 @error('supplier_id') is-invalid @enderror" id="supplier" name="supplier_id">
                                        <option value="">-- Pilih Supplier / Donatur --</option>
                                        @foreach ($supplier as $id => $nama)
                                            <option value="{{ $id }}">{{ $nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group text-center">
                                <a href="{{ url('transaksi/t_masuk') }}" type="button" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Lanjutkan ke Detail Transaksi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal_supplier')
    <div class="modal fade" tabindex="-1" role="dialog" id="supplierModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Supplier / Donatur Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('addSupplier') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Supplier / Donatur</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama supplier / donatur" autofocus autocomplete="off">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <input type="number" class="form-control phone-number @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" placeholder="Masukkan nomor telepon" autocomplete="off">
                                @error('no_telp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat Supplier / Donatur</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan alamat supplier / donatur">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-warning">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
