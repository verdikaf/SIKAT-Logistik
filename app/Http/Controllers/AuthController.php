<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Role;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = Pegawai::where('id', $request->id)->first();
        if ($data) {
            if (Hash::check($request->password, $data->password)) {
                $user_information = [
                    "id" => $request->id,
                    "nama" => $data->nama_pegawai,
                    "password" => bcrypt($request->password),
                    "foto" => $data->foto,
                    "role" => $data->role_id,
                ];
                session()->put('berhasil_login', $user_information);
                return redirect('/dashboard');
            } else {
                return redirect('/')->with('message', 'NIP atau Password anda salah.');
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('berhasil_login');
        return redirect('/');
    }
}
