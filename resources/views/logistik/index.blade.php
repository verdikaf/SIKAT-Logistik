@extends('main')

@section('title', 'Logistik')

@section('section-header')
    <div class="section-header">
        <h1>Logistik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Logistik</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-warning" href="{{ url('master-data/logistik/create') }}">Tambah</a>
                        &nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ url('/master-data/logistik') }}"><i class="fas fa-sync"></i></a>
                        &nbsp;&nbsp;
                        <h4>Data Logistik</h4>
                        <div class="card-header-form">
                            <form action="{{ url('master-data/logistik') }}" method="GET" role="search" style="width: 300px">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari Nama Logistik / Kategori" autocomplete="off" required>
                                    <div class="input-group-btn">
                                    <button class="btn btn-warning"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Logistik</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Info</th>
                                </tr>
                                @foreach ($logistik as $key => $item)
                                <tr>
                                    <td>{{ $logistik->FirstItem() + $key }}</td>
                                    <td>{{ $item->nama_logistik }}</td>
                                    <td>{{ $item->stok ." ". $item->satuan->nama_satuan }}</td>
                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                    <td>
                                        <a href="{{ url('/master-data/logistik/'.$item->id) }}" class="btn btn-icon icon-left btn-warning"><i class="fas fa-info-circle"></i> Detail</a>
                                        <a href="{{ url('/master-data/logistik/'.$item->id.'/edit') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Edit</a>
                                        <a data-toggle="modal" href="#rusakModal" data-logistik="{{ $item->id }}" data-nama="{{ $item->nama_logistik }}" data-stok="{{ $item->stok }}" data-satuan="{{ $item->satuan->nama_satuan }}" class="btn btn-icon icon-left btn-danger"><i class="far fa-window-close"></i> Logistik Rusak</a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <div class="card-body">
                                {{ $logistik->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal_keterangan')
    <div class="modal fade" tabindex="-1" role="dialog" id="rusakModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Jumlah Logistik Rusak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/master-data/logistik/rusak') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="logistik" name="logistik_id">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nama logistik</label>
                                <input type="text" name="nama_logistik" id="nama_logistik" class="form-control-plaintext" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Stok logistik</label>
                                <input type="number" name="stok" id="stok" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Jumlah logistik rusak</label>
                                <input type="number" name="logistik_rusak" onkeyup="broken()" id="logistik_rusak" class="form-control @error('logistik_rusak') is-invalid @enderror broken" placeholder="Masukkan jumlah logistik" value="{{ old('keterangan') }}" autofocus required>
                                @error('logistik_rusak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Dalam satuan</label>
                                <input type="text" name="satuan" id="satuan" class="form-control-plaintext" readonly>
                            </div>
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
        $('#rusakModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var logistik = button.data('logistik')
            var nama = button.data('nama')
            var stok = button.data('stok')
            var satuan = button.data('satuan')
            var modal = $(this)
            modal.find('#logistik').val(logistik)
            modal.find('#nama_logistik').val(nama)
            modal.find('#stok').val(stok)
            modal.find('#satuan').val(satuan)
        })
        $(".broken").on('keyup', function() {
            var stok = $('#stok').val();
            var jumlah = $('#logistik_rusak').val();

            var num_stok = parseInt(stok);
            var num_jumlah = parseInt(jumlah);

            if (num_jumlah > num_stok){
                alert("Jumlah melebihi stok tersedia");
                $('#logistik_rusak').val(null);
            }
        });
    </script>
@endpush
