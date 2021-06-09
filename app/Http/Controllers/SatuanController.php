<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;

class SatuanController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->input('search'))) {
            $satuan = Satuan::where('nama_satuan','like',"%".$request->search."%")->orderBy('nama_satuan', 'asc')->paginate(10);
        } else {
            $satuan = Satuan::orderBy('nama_satuan', 'asc')->paginate(10);
        }
        return view('satuan.index', compact('satuan'));
    }

    public function create()
    {
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_satuan' => 'required|min:3',
        ], [
            'nama_satuan.required' => 'Satuan harus diisi.',
            'nama_satuan.min' => 'Satuan harus lebih dari 3 karakter.',
        ]);

        $cekSatuan = Satuan::where('nama_satuan', 'like', $request->nama_satuan)->get();

        if (is_null($cekSatuan)) {
            return redirect()->back()->with('error', 'Data sudah tersedia.');
        } else {
            $satuan = new Satuan;
            $satuan->nama_satuan = $request->nama_satuan;
            $satuan->save();

            return redirect('/master-data/satuan');
        }
    }

    public function show(Satuan $satuan)
    {
        //
    }

    public function edit(Satuan $satuan)
    {
        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, Satuan $satuan)
    {
        $request->validate([
            'nama_satuan' => 'required|min:3',
        ], [
            'nama_satuan.required' => 'Satuan harus diisi.',
            'nama_satuan.min' => 'Satuan harus lebih dari 3 karakter.',
        ]);

        $satuan->nama_satuan = $request->nama_satuan;
        $satuan->save();

        return redirect('/master-data/satuan');
    }

    public function destroy(Satuan $satuan)
    {
        //
    }
}
