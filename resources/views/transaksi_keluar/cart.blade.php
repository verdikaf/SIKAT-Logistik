@extends('main')

@section('title', 'Transaksi Keluar')

@section('section-header')
    <div class="section-header">
        <h1>Logistik Keluar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/transaksi/t_keluar') }}">Transaksi Logistik Keluar</a></div>
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
                        <h4>Data Logistik Keluar</h4>
                        <div class="card-header-form">
                            @if ($transaksiKeluar->implode('status') == 2 || $transaksiKeluar->implode('status') == 3 || $transaksiKeluar->implode('status') == 4)
                                <a href="{{ url('/transaksi/t_keluar/'.$transaksiKeluar->implode('id').'/cetak') }}" target="_blank" class="btn btn-primary">Cetak Invoice</a>
                            @endif
                            <a href="{{ url('transaksi/t_keluar') }}" class="btn btn-secondary" type="button">Kembali ke Halaman Utama</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($transaksiKeluar as $key => $item)
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
                                <label>Lokasi Distribusi</label><br>
                                {{ $item->lokasi }}
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
                        @if ($transaksiKeluar->implode('status') == 0)
                        <form action="{{ url('transaksi/t_keluar/cart') }}" method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" class="form-control" name="id" value="{{ $transaksiKeluar->implode('id') }}">
                                <div class="form-group col-md-4">
                                    <label>Nama logistik</label>
                                    <select class="form-control select2 @error('logistik_id') is-invalid @enderror" id="logistik" name="logistik_id">
                                        <option value="">-- Pilih Nama Logistik --</option>
                                        @foreach ($logistik as $item)
                                            <option id="log-{{ $item->id }}" value="{{ $item->id }}"
                                                data-stok="{{ $item->stok }}"
                                                data-satuan="{{ $item->satuan->nama_satuan }}">{{ $item->nama_logistik }}</option>
                                        @endforeach
                                    </select>
                                    @error('logistik_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Jumlah logistik</label>
                                    <input type="number" onkeyup="test()" data-id="jumlah" class="form-control test @error('jumlah') is-invalid @enderror" name="jumlah" placeholder="Masukkan jumlah berdasarkan satuan" autocomplete="off" id="jumlah">
                                    @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Stok logistik</label>
                                    <input type="text" onkeyup="test()" data-id="stok" class="form-control-plaintext test" name="stok" id="stok" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Satuan logistik</label>
                                    <input type="text" class="form-control-plaintext" name="satuan" id="satuan" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
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
                                        @if ($transaksiKeluar->implode('status') == 0)
                                        <th scope="col">Info</th>
                                        @elseif ($transaksiKeluar->implode('status') == 1 && $pegawai->role_id == 3)
                                        <th scope="col">Info</th>
                                        @endif
                                    </tr>
                                    @foreach ($cart as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->nama_logistik }}</td>
                                        <td>{{ $item->jumlah.' '.$item->satuan }}</td>
                                        <td>
                                            @if ($transaksiKeluar->implode('status') == 0)
                                                <a href="{{ url('transaksi/t_keluar/cart/'.$item->transaksi_keluar_id.'/'.$item->logistik_id) }}" class="btn btn-icon icon-left btn-danger"><i class="far fa-trash-alt"></i> Hapus</a>
                                            @elseif ($transaksiKeluar->implode('status') == 1 && $pegawai->role_id == 3 && $item->status == 0)
                                                <a href="{{ url('verifikasiCartKeluar/'.$item->transaksi_keluar_id.'/'.$item->logistik_id) }}" class="btn btn-icon icon-left btn-success"><i class="far fa-check-circle"></i> Verifikasi</a>
                                                <a href="{{ url('verifikasiCartKeluar/false/'.$item->transaksi_keluar_id.'/'.$item->logistik_id) }}" class="btn btn-icon icon-left btn-danger"><i class="far fa-times-circle"></i> Barang Tidak Tersedia</a>
                                            @elseif ($transaksiKeluar->implode('status') == 1 && $pegawai->role_id == 1)
                                                <div class="badge badge-warning">Proses Verifikasi</div>
                                            @elseif ($transaksiKeluar->implode('status') != 0 && $item->status == 3)
                                                <div class="badge badge-danger">Gagal Verifikasi</div>
                                            @elseif ($transaksiKeluar->implode('status') != 0 && $item->status == 1)
                                                <div class="badge badge-success">Berhasil Verifikasi</div>
                                            @elseif ($transaksiKeluar->implode('status') != 0 && $item->status == 2)
                                                <div class="badge badge-success">Berhasil Verifikasi</div>
                                                <div class="badge badge-warning">Barang Belum Kembali</div>
                                            @elseif ($transaksiKeluar->implode('status') != 0 && $item->status == 4)
                                                <div class="badge badge-info">Barang Sudah Kembali</div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    @if ($transaksiKeluar->implode('status') == 0)
                    <br>
                    <div class="col text-center">
                        <a href="{{ url('transaksi/t_keluar/cart/'.$transaksiKeluar->implode('id')) }}" class="btn btn-icon icon-left btn-primary">Submit Transaksi Logistik Keluar</a>
                    </div>
                    <br>
                    @elseif ($transaksiKeluar->implode('status') == 1 && $pegawai->role_id == 3)
                    <br>
                    <div class="col text-center">
                        <a href="{{ url('transaksi/t_keluar/verifikasiAll/'.$transaksiKeluar->implode('id')) }}" class="btn btn-icon icon-left btn-primary">Submit Verifikasi Data</a>
                    </div>
                    <br>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $("#logistik").change(function () {
            var ambilStok = $("#log-"+this.value).data('stok');
            var ambilSatuan = $("#log-"+this.value).data('satuan');
            console.log(ambilStok);
            console.log(ambilSatuan);
            $("#stok").val(ambilStok);
            $("#satuan").val(ambilSatuan);
            $("#jumlah").attr({
                "max" : ambilStok
            });
        });
        $(".test").on('keyup', function() {
            var stok = $('#stok').val();
            var jumlah = $('#jumlah').val();

            var num_stok = parseInt(stok);
            var num_jumlah = parseInt(jumlah);

            if (num_jumlah > num_stok){
                alert("Jumlah melebihi stok tersedia");
                $('#jumlah').val(0);
            }
        });
        // $(document).ready(function(){
        //     $('#verifikasi').on('click', function(e){
        //         $.ajax({
        //             url: '/verifikasiCartKeluar/'+$(this).data('transaksi')+'/'+$(this).data('logistik'),
        //             method: 'GET'
        //         }).then(function(data){
        //             console.log(data);
        //             location.reload();
        //             return false;
        //         });
        //     });
        // });
        // $(document).ready(function(){
        //     $('#nonVerifikasi').on('click', function(e){
        //         $.ajax({
        //             url: '/batalCartKeluar/'+$(this).data('transaksi')+'/'+$(this).data('logistik'),
        //             method: 'GET'
        //         }).then(function(data){
        //             console.log(data);
        //             location.reload();
        //             return false;
        //         });
        //     });
        // });
    </script>
@endpush
