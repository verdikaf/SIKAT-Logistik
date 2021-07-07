@extends('main')

@section('title', 'Transaksi Kembali')

@section('section-header')
    <div class="section-header">
        <h1>Logistik Kembali</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/transaksi/t_kembali') }}">Transaksi Logistik Kembali</a></div>
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
                        <h4>Data Logistik Kembali</h4>
                        <div class="card-header-form">
                            @if ($transaksiKembali->implode('status') == 5 || $transaksiKembali->implode('status') == 6)
                                <a href="{{ url('/transaksi/t_keluar/'.$transaksiKembali->implode('id').'/cetak') }}" target="_blank" class="btn btn-primary">Cetak Invoice</a>
                            @endif
                            <a href="{{ url('transaksi/t_kembali') }}" class="btn btn-secondary" type="button">Kembali ke Halaman Utama</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($transaksiKembali as $key => $item)
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
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Invoice Transaksi Logistik</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">jumlah</th>
                                        <th scope="col">Info</th>
                                    </tr>
                                    @foreach ($cart as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->nama_logistik }}</td>
                                        <td>{{ $item->jumlah.' '.$item->satuan }}</td>
                                        @if ($pegawai->role_id == 3 && $item->status == 2)
                                        <td>
                                            <button type="button" id="kembali" data-transaksi="{{ $item->transaksi_keluar_id }}" data-logistik="{{ $item->logistik_id }}" class="btn btn-icon icon-left btn-warning"><i class="far fa-calendar-check"></i> Kembali</button>
                                        </td>
                                        @elseif ($pegawai->role_id == 1 && $item->status == 2)
                                            <td><div class="badge badge-warning">Belum Kembali</div></td>
                                        @elseif ($item->status == 1)
                                            <td><div class="badge badge-info">Habis Pakai</div></td>
                                        @elseif ($item->status == 3)
                                            <td><div class="badge badge-danger">Gagal Verifikasi</div></td>
                                        @elseif ($item->status == 4)
                                            <td><div class="badge badge-success">Sudah Kembali</div></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    @if ($transaksiKembali->implode('status') == 4 && $pegawai->role_id == 3)
                    <br>
                    <div class="col text-center">
                        <a href="{{ url('transaksi/t_kembali/logistik_kembali/'.$transaksiKembali->implode('id')) }}" class="btn btn-icon icon-left btn-primary">Submit logistik kembali</a>
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
            } {

            }
        })
        $(document).ready(function(){
            $('#kembali').on('click', function(e){
                $.ajax({
                    url: '/logistikKembali/'+$(this).data('transaksi')+'/'+$(this).data('logistik'),
                    method: 'GET'
                }).then(function(data){
                    console.log(data);
                    location.reload();
                    return false;
                });
            });
        })
    </script>
@endpush
