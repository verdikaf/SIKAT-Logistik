<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Role;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->input('search'))) {
            $pegawai = Pegawai::orderBy('nama_pegawai', 'asc')->with('role')
            ->where('nama_pegawai','like',"%".$request->search."%")->paginate(5);
        } else {
            $pegawai = Pegawai::orderBy('nama_pegawai', 'asc')->with('role')->paginate(5);
        }
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        $role = Role::all();
        return view('pegawai.create', compact('role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:2',
            'nik' => 'required|min:16|numeric',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required|min:4',
            'tgl_lahir' => 'required',
            'no_telp' => 'required|numeric',
            'alamat' => 'required|min:5',
            'password' => 'required|min:8',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role_id' => 'required',
        ], [
            'nama.required' => 'Nama pegawai harus diisi.',
            'nama.min' => 'Nama pegawai harus lebih dari 2 karakter.',
            'nik.required' => 'NIK harus diisi.',
            'nik.min' => 'NIK harus berisi 16 Angka.',
            'nik.numeric' => 'NIK berupa angka.',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
            'agama.required' => 'Agama harus diisi.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tempat_lahir.min' => 'Tempat lahir harus lebih dari 4 karakter.',
            'tgl_lahir.required' => 'Tanggal lahir harus diisi.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.numeric' => 'Nomor telepon berupa angka.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.min' => 'Alamat harus lebih dari 5 karakter.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus lebih dari 8 karakter.',
            'foto.image' => 'File harus berformat jpeg, png, jpg, gif, svg.',
            'foto.mimes' => 'File harus berformat jpeg, png, jpg, gif, svg.',
            'foto.max' => 'Ukuran foto terlalu besar.',
            'role_id.required' => 'Jabatan harus diisi.',
        ]);

        if (!empty($request->id)) {
            $request->validate([
                'id' => 'min:18',
            ], [
                'id.min' => 'NIP harus berisi 18 angka.',
            ]);
            $id = $request->id;
            $asn = 1;
        } else {
            $kode = Pegawai::count() + 1;
            $lahir = preg_replace("/[^0-9]/", "", $request->tgl_lahir);
            $fzeropadded = sprintf("%02d", $kode);
            $id = (int) $request->role_id . $lahir . $fzeropadded;
            $asn = 0;
        }

        if (!empty($request->foto)) {
            $file = $request->file('foto');
            $uniqueFileName = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $uniqueFileName);
        } else {
            $uniqueFileName = "default-ava.png";
        }

        $pegawai = new Pegawai;
        $pegawai->id = $id;
        $pegawai->nik = $request->nik;
        $pegawai->nama_pegawai = $request->nama;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->agama = $request->agama;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->no_telp = $request->no_telp;
        $pegawai->alamat = $request->alamat;
        $pegawai->password = Hash::make($request->password);
        $pegawai->foto = $uniqueFileName;
        $pegawai->role_id = $request->role_id;
        $pegawai->status = 1;
        $pegawai->asn = $asn;
        $pegawai->save();

        return redirect('/data-pegawai/pegawai')->with('success', 'Data Berhasil Ditambahkan.');
    }

    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        $role = Role::all();
        return view('pegawai.edit', compact('pegawai', 'role'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama' => 'required|min:2',
            'nik' => 'required|min:16|numeric',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required|min:4',
            'tgl_lahir' => 'required',
            'no_telp' => 'required|numeric',
            'alamat' => 'required|min:5',
            'role_id' => 'required',
        ], [
            'nama.required' => 'Nama pegawai harus diisi.',
            'nama.min' => 'Nama pegawai harus lebih dari 2 karakter.',
            'nik.required' => 'NIK harus diisi.',
            'nik.min' => 'NIK harus berisi 16 Angka.',
            'nik.numeric' => 'NIK berupa angka.',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
            'agama.required' => 'Agama harus diisi.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tempat_lahir.min' => 'Tempat lahir harus lebih dari 4 karakter.',
            'tgl_lahir.required' => 'Tanggal lahir harus diisi.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.numeric' => 'Nomor telepon berupa angka.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.min' => 'Alamat harus lebih dari 5 karakter.',
            'role_id.required' => 'Jabatan harus diisi.',
        ]);

        if (!empty($request->foto)) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [
                'foto.image' => 'File harus berformat jpeg, png, jpg, gif, svg.',
                'foto.mimes' => 'File harus berformat jpeg, png, jpg, gif, svg.',
                'foto.max' => 'Ukuran foto terlalu besar.',
            ]);
            $imageName = $request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            $pegawai->foto = $imageName;
        }
        if (!empty($request->password)) {
            $request->validate([
                'password' => 'min:8',
            ], [
                'password.min' => 'Password harus lebih dari 8 karakter.',
            ]);
            $pegawai->password = Hash::make($request->password);
        }
        if (!empty($request->id)) {
            $request->validate([
                'id' => 'min:18',
            ], [
                'id.min' => 'NIP harus berisi 18 angka.',
            ]);
            $pegawai->id = $request->id;
            $pegawai->asn = 1;
        }
        $pegawai->nama_pegawai = $request->nama;
        $pegawai->nik = $request->nik;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->agama = $request->agama;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->no_telp = $request->no_telp;
        $pegawai->alamat = $request->alamat;
        $pegawai->role_id = $request->role_id;
        $pegawai->save();

        return redirect('/data-pegawai/pegawai')->with('success', 'Data Berhasil Diperbarui.');
    }

    public function profil()
    {
        $user_id = (int)session('berhasil_login')['id'];
        $pegawai = Pegawai::find($user_id);
        return view('profil', compact('pegawai'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:2',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required|min:4',
            'tgl_lahir' => 'required',
            'no_telp' => 'required|numeric',
            'alamat' => 'required|min:5',
        ], [
            'nama.required' => 'Nama pegawai harus diisi.',
            'nama.min' => 'Nama pegawai harus lebih dari 2 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
            'agama.required' => 'Agama harus diisi.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tempat_lahir.min' => 'Tempat lahir harus lebih dari 4 karakter.',
            'tgl_lahir.required' => 'Tanggal lahir harus diisi.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.numeric' => 'Nomor telepon berupa angka.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.min' => 'Alamat harus lebih dari 5 karakter.',
        ]);

        if (!empty($request->foto)) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [
                'foto.image' => 'File harus berformat jpeg, png, jpg, gif, svg.',
                'foto.mimes' => 'File harus berformat jpeg, png, jpg, gif, svg.',
                'foto.max' => 'Ukuran foto terlalu besar.',
            ]);
            $imageName = $request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            Pegawai::where('id', $request->id)
                    ->update(['foto' => $imageName]);
        }
        if (!empty($request->password)) {
            $request->validate([
                'password' => 'min:8',
            ], [
                'password.min' => 'Password harus lebih dari 8 karakter.',
            ]);

            Pegawai::where('id', $request->id)
                    ->update(['password' => Hash::make($request->password)]);
        }

        Pegawai::where('id', $request->id)
                ->update(['nama_pegawai' => $request->nama,
                            'jenis_kelamin' => $request->jenis_kelamin,
                            'agama' => $request->agama,
                            'tempat_lahir' => $request->tempat_lahir,
                            'tgl_lahir' => $request->tgl_lahir,
                            'no_telp' => $request->no_telp,
                            'alamat' => $request->alamat]);

        // $pegawai->nama_pegawai = $request->nama;
        // $pegawai->nik = $request->nik;
        // $pegawai->jenis_kelamin = $request->jenis_kelamin;
        // $pegawai->agama = $request->agama;
        // $pegawai->tempat_lahir = $request->tempat_lahir;
        // $pegawai->tgl_lahir = $request->tgl_lahir;
        // $pegawai->no_telp = $request->no_telp;
        // $pegawai->alamat = $request->alamat;
        // $pegawai->save();

        return redirect('/profil')->with('success', 'Data Berhasil Diperbarui.');
    }

    public function destroy($id)
    {
        //
    }
}
