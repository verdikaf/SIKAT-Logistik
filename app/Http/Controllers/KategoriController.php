<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->input('search'))) {
            $kategori = Kategori::where('nama_kategori','like',"%".$request->search."%")->orderBy('nama_kategori', 'asc')->paginate(10);
        } else {
            $kategori = Kategori::orderBy('nama_kategori', 'asc')->paginate(10);
        }
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|min:3',
            'tipe_logistik' => 'required',
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi.',
            'nama_kategori.min' => 'Nama kategori harus lebih dari 3 karakter.',
            'tipe_logistik.required' => 'Jenis logistik harus diisi.',
        ]);

        $kategori = new Kategori;
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->tipe_logistik = $request->tipe_logistik;
        $kategori->save();

        return redirect('/master-data/kategori');
    }

    public function show(Kategori $kategori)
    {
        //
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|min:3',
            'tipe_logistik' => 'required',
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi.',
            'nama_kategori.min' => 'Nama harus lebih dari 3 karakter.',
            'tipe_logistik.required' => 'Jenis logistik harus diisi.',
        ]);

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->tipe_logistik = $request->tipe_logistik;
        $kategori->save();

        return redirect('/master-data/kategori');
    }

    public function destroy(Kategori $kategori)
    {
        //
    }
}
