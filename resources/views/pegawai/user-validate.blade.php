<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>User Validate &mdash; SIKAT BPBD</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ url('/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('/assets/css/components.css') }}">
  <link rel="shortcut icon" href="{{ url('/assets/img/bpbdmalangkab.png') }}" />
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container">
                <div class="section-header">
                    <h1>Validasi Informasi Pegawai</h1>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                @if ($pegawai->status == 1)
                                    <div class="card-header">
                                        <h4>Detail {{ $pegawai->nama_pegawai }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ $pegawai->role->nama_role }}</div></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th scope="col">Nomor Kepegawaian</th>
                                                    <td>{{ $pegawai->id }}</td>
                                                    <th scope="col">NIK</th>
                                                    <td>{{ $pegawai->nik }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Nama Pegawai</th>
                                                    <td>{{ $pegawai->nama_pegawai }}</td>
                                                    <th scope="col">Tempat, Tanggal Lahir</th>
                                                    <td>{{ $pegawai->tempat_lahir .", ". date("d-m-Y", strtotime($pegawai->tgl_lahir)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Jenis Kelamin</th>
                                                    <td>{{ $pegawai->jenis_kelamin }}</td>
                                                    <th scope="col">Agama</th>
                                                    <td>{{ $pegawai->agama }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">No. Telepon</th>
                                                    <td>{{ $pegawai->no_telp }}</td>
                                                    <th scope="col">Alamat</th>
                                                    <td>{{ $pegawai->alamat }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Jabatan</th>
                                                    <td>{{ $pegawai->role->nama_role }}</td>
                                                    <th scope="col">Status Kepegawaian</th>
                                                    <td>Aktif</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Foto</th>
                                                    <td><img src="/images/{{ $pegawai->foto }}" alt="foto" style="width: 100px"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="card-header">
                                        <h4>Status Kepegawaian <b class="text-danger">{{ $pegawai->nama_pegawai }}</b> sudah tidak aktif.</h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; 2021 <div class="bullet"></div> Development By Verdika Fajar Saputra
                    </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="{{ url('/assets/js/stisla.js') }}"></script>
    <script src="{{ url('/assets/js/scripts.js') }}"></script>
    <script src="{{ url('/assets/js/custom.js') }}"></script>

</body>
</html>
