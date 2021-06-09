@extends('main')

@section('title', 'Transaksi Masuk')

@section('section-header')
    <div class="section-header">
        <h1>Logistik Masuk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/transaksi/t_masuk') }}">Transaksi Logistik Masuk</a></div>
            <div class="breadcrumb-item">Tambah Data</div>
            <div class="breadcrumb-item active">Detail Data</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Logistik Masuk</h4>
                        <div class="card-header-form">
                            @if ($transaksiMasuk->implode('status') == 2 || $transaksiMasuk->implode('status') == 3)
                                <a href="{{ url('/transaksi/t_masuk/'.$transaksiMasuk->implode('id').'/cetak') }}" target="_blank" class="btn btn-primary">Cetak Invoice</a>
                            @endif
                            <a href="{{ url('transaksi/t_masuk') }}" class="btn btn-secondary" type="button">Kembali ke Halaman Utama</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($transaksiMasuk as $key => $item)
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Nomor transaksi</label>
                                <input type="text" class="form-control-plaintext" name="id" value="{{ $item->id }}" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Petugas</label><br>
                                @foreach ($item->pegawai as $as)
                                    @if ($as->pivot->action == 1)
                                        <i class="fas fa-check-circle"> Diajukan oleh</i><br> {{ $as->nama_pegawai }} <br>
                                    @elseif ($as->pivot->action == 2)
                                        <i class="fas fa-check-circle"> Diverifikasi oleh</i><br> {{ $as->nama_pegawai }} <br>
                                    @elseif ($as->pivot->action == 3)
                                        <i class="fas fa-check-circle"> Petugas Pengembalian</i><br> {{ $as->nama_pegawai }}
                                    @endif
                                @endforeach
                            </div>
                            <div class="form-group col-md-3">
                                <label>Supplier / Donatur logistik</label>
                                <input type="text" class="form-control-plaintext" name="supplier_nama" value="{{ $item->supplier->implode('nama_supplier') }}" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Tanggal</label>
                                <input type="text" class="form-control-plaintext" name="tanggal" value="{{ date("d-m-Y", strtotime($item->tanggal)) }}" readonly>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Invoice Transaksi Logistik</h4>
                    </div>
                    <div class="card-body">
                        @if ($transaksiMasuk->implode('status') == 0)
                        <form action="{{ url('transaksi/t_masuk/cart') }}" method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" class="form-control" name="id" value="{{ $transaksiMasuk->implode('id') }}">
                                <div class="form-group col-md-8">
                                    <label>Nama logistik <a data-toggle="modal" href="#logistikModal"> (Tambahkan Logistik Baru)</a></label>
                                    <select class="form-control select2 @error('logistik_id') is-invalid @enderror" id="logistik" name="logistik_id">
                                        <option value="">-- Pilih Nama Logistik --</option>
                                        @foreach ($logistik as $item)
                                            <option id="log-{{ $item->id }}" value="{{ $item->id }}"
                                                data-satuan="{{ $item->satuan->nama_satuan }}">{{ $item->nama_logistik }}</option>
                                        @endforeach
                                    </select>
                                    @error('logistik_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Masa Pakai Logistik</label>
                                    <input type="date" class="form-control datepicker @error('expired') is-invalid @enderror" name="expired">
                                    @error('expired')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Jumlah logistik</label>
                                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" placeholder="Masukkan jumlah berdasarkan satuan" autocomplete="off">
                                    @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Satuan logistik</label>
                                    <input type="text" class="form-control" name="satuan" id="satuan" readonly>
                                </div>
                                <div class="form-group col-md-4 mt-4 pt-1">
                                    <button type="submit" class="btn btn-warning">Tambahkan ke invoice</button>
                                </div>
                            </div>
                        </form>
                        @endif
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">jumlah</th>
                                        <th scope="col">Tgl. Kedaluwarsa</th>
                                        <th scope="col">Info</th>
                                    </tr>
                                    @foreach ($cart as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->nama_logistik }}</td>
                                        <td>{{ $item->jumlah.' '.$item->satuan }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->expired)) }}</td>
                                        @if ($transaksiMasuk->implode('status') == 0)
                                            <td>
                                                <a href="{{ url('transaksi/t_masuk/cart/'.$item->transaksi_masuk_id.'/'.$item->logistik_id) }}" class="btn btn-icon icon-left btn-danger"><i class="far fa-trash-alt"></i> Hapus</a>
                                            </td>
                                        @elseif ($transaksiMasuk->implode('status') == 1 && $pegawai->role_id == 1)
                                            <td><div class="badge badge-warning">Proses Verifikasi</div></td>
                                        @elseif ($transaksiMasuk->implode('status') != 0 && $item->status == 2)
                                            <td><div class="badge badge-danger">Gagal Verifikasi</div></td>
                                        @elseif ($transaksiMasuk->implode('status') != 0 && $item->status == 1)
                                            <td><div class="badge badge-success">Berhasil Verifikasi</div></td>
                                        @elseif ($transaksiMasuk->implode('status') == 1 && $pegawai->role_id == 3 && $item->status == 0)
                                            <td>
                                                <a href="{{ url('verifikasiCartMasuk/'.$item->transaksi_masuk_id.'/'.$item->logistik_id.'/'.$item->expired) }}" class="btn btn-icon icon-left btn-success"><i class="far fa-check-circle"></i> Verifikasi</a>
                                                <a href="{{ url('verifikasiCartMasuk/false/'.$item->transaksi_masuk_id.'/'.$item->logistik_id.'/'.$item->expired) }}" class="btn btn-icon icon-left btn-danger"><i class="far fa-times-circle"></i> Barang Tidak Sesuai</a>
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    @if ($transaksiMasuk->implode('status') == 0)
                    <br>
                    <div class="col text-center">
                        <a href="{{ url('transaksi/t_masuk/cart/'.$transaksiMasuk->implode('id')) }}" class="btn btn-icon icon-left btn-primary">Submit Transaksi Logistik Masuk</a>
                    </div>
                    <br>
                    @elseif ($transaksiMasuk->implode('status') == 1 && $pegawai->role_id == 3)
                    <br>
                    <div class="col text-center">
                        <a href="{{ url('transaksi/t_masuk/verifikasiAll/'.$transaksiMasuk->implode('id')) }}" class="btn btn-icon icon-left btn-primary">Submit Verifikasi Data</a>
                    </div>
                    <br>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal_logistik')
    <div class="modal fade" tabindex="-1" role="dialog" id="logistikModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Logistik Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('addLogistik') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Nomor Logistik</label>
                                <input type="number" id="id_serial" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id') }}" placeholder="Masukkan nomor logistik" autofocus autocomplete="off">
                                @error('id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 mt-4 pt-1">
                                <input type="button" class="btn btn-warning btn-lg" onclick="Random();" value="Generate">
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
                        <div class="form-group">
                            <label>Deskripsi Logistik</label>
                            <textarea id="textarea" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" placeholder="Masukkan deskripsi logistik">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
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

@push('scripts')
    <script type="text/javascript">
        function Random() {
            var rnd = Math.floor(10000 + Math.random() * 90000);
            var today = new Date();
            today = String(today.getDate()).padStart(2, '0') + String(today.getMonth() + 1).padStart(2, '0') + today.getFullYear() + String(today.getMinutes()).padStart(2, '0') + String(today.getSeconds()).padStart(2, '0');
            console.log(today);
            document.getElementById('id_serial').value = `${rnd}${today}`;
        }
        $("#logistik").change(function () {
            var ambilSatuan = $("#log-"+this.value).data('satuan');
            console.log(ambilSatuan);
            $("#satuan").val(ambilSatuan);
        });
    </script>
@endpush
