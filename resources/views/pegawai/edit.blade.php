@extends('main')

@section('title', 'Pegawai')

@section('section-header')
    <div class="section-header">
        <h1>Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/data-pegawai/pegawai') }}">Pegawai</a></div>
            <div class="breadcrumb-item active">Edit Data</div>
        </div>
    </div>
@endsection

@section('section-body')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if ($pegawai->asn == 0)
                    <div class="alert alert-primary alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            [INFO] Setelah memperbarui NIP PNS/PPPK maka NIP yang digunakan untuk login adalah NIP PNS/PPPK.
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('data-pegawai/pegawai/'.$pegawai->id) }}" method="post" enctype='multipart/form-data'>
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Nama Pegawai<i class="text-danger">*</i></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $pegawai->nama_pegawai) }}" placeholder="Masukkan nama pegawai" autofocus autocomplete="off">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nomor Induk Kependudukan (NIK)<i class="text-danger">*</i></label>
                                    <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik', $pegawai->nik) }}" placeholder="Masukkan Nomor Induk Kependudukan" autofocus autocomplete="off">
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    @if ($pegawai->asn == 0)
                                        <label>NIP ASN/PPPK <i class="text-danger">(Diisi jika sudah memiliki NIP PNS/PPPK)</i></label>
                                        <input type="number" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id') }}" placeholder="Masukkan Nomor Induk Kepegawaian" autocomplete="off">
                                        @error('id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
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
                                    <label>Jabatan<i class="text-danger">*</i></label>
                                    <select class="form-control select2 @error('role_id') is-invalid @enderror" name="role_id">
                                        <option value="">-- Pilih Jabatan --</option>
                                        @foreach ($role as $item)
                                            <option value="{{ $item->id }}" {{ old('role_id', $pegawai->role_id) == $item->id ? 'selected' : null }}>{{ $item->nama_role }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                            </div>
                            <div class="form-group">
                                <label>Alamat<i class="text-danger">*</i></label>
                                <textarea id="textarea" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan alamat lengkap">{{ old('alamat', $pegawai->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <i class="text-danger">*) Wajib Diisi</i><br><br>
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
