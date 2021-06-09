@extends('main')

@section('title', 'Profil')

@section('section-header')
    <div class="section-header">
        <h1>Profil</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Profil</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <h2 class="section-title">Hi, {{ $pegawai->nama_pegawai }}!</h2>
        <p class="section-lead">
            Ubah informasi data diri anda pada halaman ini.
        </p>
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
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="/images/{{ $pegawai->foto }}" class="rounded-circle profile-widget-picture">
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name">{{ $pegawai->nama_pegawai }}<div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ $pegawai->role->nama_role }}</div></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th scope="col">Nomor Kepegawaian</th>
                                <td>{{ $pegawai->id }}</td>
                            </tr>
                            <tr>
                                <th scope="col">NIK</th>
                                <td>{{ $pegawai->nik }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Tempat dan Tanggal Lahir</th>
                                <td>{{ $pegawai->tempat_lahir .", ". date('d-m-Y', strtotime($pegawai->tgl_lahir)) }}</td>
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
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form action="{{ url('profil/'.$pegawai->id) }}" method="post" enctype='multipart/form-data'>
                        @method('PUT')
                        @csrf
                        <div class="card-header">
                            <h4>Edit Profil</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" class="form-control" name="id" value="{{ $pegawai->id }}">
                            <div class="form-group">
                                <label>Nama Pegawai<i class="text-danger">*</i></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $pegawai->nama_pegawai) }}" placeholder="Masukkan nama pegawai" autofocus autocomplete="off">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Tempat Lahir<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}" placeholder="Masukkan tempat lahir" autocomplete="off">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tanggal Lahir<i class="text-danger">*</i></label>
                                    <input type="date" class="form-control datepicker @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{ old('tgl_lahir', $pegawai->tgl_lahir) }}">
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Jenis Kelamin<i class="text-danger">*</i></label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" @if (old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Laki-laki') selected="selected" @endif>Laki-laki</option>
                                        <option value="Perempuan" @if (old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Perempuan') selected="selected" @endif>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Agama<i class="text-danger">*</i></label>
                                    <select class="form-control @error('agama') is-invalid @enderror" name="agama">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam" @if (old('agama', $pegawai->agama) == 'Islam') selected="selected" @endif>Islam</option>
                                        <option value="Protestan" @if (old('agama', $pegawai->agama) == 'Protestan') selected="selected" @endif>Protestan</option>
                                        <option value="Katolik" @if (old('agama', $pegawai->agama) == 'Katolik') selected="selected" @endif>Katolik</option>
                                        <option value="Hindu" @if (old('agama', $pegawai->agama) == 'Hindu') selected="selected" @endif>Hindu</option>
                                        <option value="Buddha" @if (old('agama', $pegawai->agama) == 'Buddha') selected="selected" @endif>Buddha</option>
                                        <option value="Konghucu" @if (old('agama', $pegawai->agama) == 'Konghucu') selected="selected" @endif>Konghucu</option>
                                    </select>
                                    @error('agama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nomor Telepon<i class="text-danger">*</i></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control phone-number @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp', $pegawai->no_telp) }}" placeholder="Masukkan nomor telepon" autocomplete="off">
                                        @error('no_telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Foto Profil Baru <i class="text-danger">(Jika ingin diganti)</i></label>
                                    <div class="custom-file">
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password Baru <i class="text-danger">(Jika ingin diganti)</i></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password baru jika ingin merubah password." autocomplete="off">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat<i class="text-danger">*</i></label>
                                <textarea id="textarea" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan alamat lengkap">{{ old('alamat', $pegawai->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <i class="text-danger">*) Wajib Diisi</i><br><br>
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection