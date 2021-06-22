@extends('main')

@section('title', 'Pegawai')

@section('section-header')
    <div class="section-header">
        <h1>Detail Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/data-pegawai/pegawai') }}">Pegawai</a></div>
            <div class="breadcrumb-item active">Detail Pegawai</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                <div class="card-header">
                    <a class="btn btn-warning" href="{{ url()->previous() }}">Kembali</a>
                    &nbsp;&nbsp;
                    <h4>Detail {{ $pegawai->nama_pegawai }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ $pegawai->role->nama_role }}</div></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th scope="col">Nomor Kepegawaian</th>
                                <td>{{ $pegawai->id }}</td>
                            </tr>
                            <tr>
                                <th scope="col">NIK</th>
                                <td>{{ $pegawai->nik }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Nama Pegawai</th>
                                <td>{{ $pegawai->nama_pegawai }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Tempat, Tanggal Lahir</th>
                                <td>{{ $pegawai->tempat_lahir .", ". date("d-m-Y", strtotime($pegawai->tgl_lahir)) }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Jenis Kelamin</th>
                                <td>{{ $pegawai->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Agama</th>
                                <td>{{ $pegawai->agama }}</td>
                            </tr>
                            <tr>
                                <th scope="col">No. Telepon</th>
                                <td>{{ $pegawai->no_telp }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Alamat</th>
                                <td>{{ $pegawai->alamat }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Foto</th>
                                <td><img src="/images/{{ $pegawai->foto }}" alt="foto" style="width: 100px"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
