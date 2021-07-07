<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistik;
use App\Models\Kategori;
use App\Models\LogistikRusak;
use App\Models\Satuan;
use App\Models\Supplier;

class LogistikController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if (!empty($request->input('search'))) {
            $logistik = Logistik::orderBy('nama_logistik', 'asc')->with('kategori', 'satuan')
            ->whereHas('kategori', function($q) use($search){$q->where('nama_kategori', 'like', "%".$search."%");})
            ->orWhere('nama_logistik','like',"%".$search."%")
            ->paginate(10);
        } else {
            $logistik = Logistik::orderBy('nama_logistik', 'asc')->with('kategori', 'satuan')
            ->paginate(10);
        }
        return view('logistik.index', compact('logistik'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        $supplier = Supplier::all();
        return view('logistik.create', compact('kategori', 'satuan', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required|min:3',
            'deskripsi' => 'required|min:5',
            'kategori_id' => 'required',
            'satuan_id' => 'required',
        ], [
            'id.required' => 'ID logistik harus diisi.',
            'nama.required' => 'Nama logistik harus diisi.',
            'nama.min' => 'Nama logistik harus lebih dari 3 karakter.',
            'deskripsi.required' => 'Deskripsi logistik harus diisi.',
            'deskripsi.min' => 'Deskripsi logistik harus lebih dari 5 karakter.',
            'kategori_id.required' => 'Kategori Logistik harus diisi.',
            'satuan_id.required' => 'Satuan harus diisi.',
        ]);

        $logistik = new Logistik;
        $logistik->id = $request->id;
        $logistik->nama_logistik = $request->nama;
        $logistik->stok = 0;
        $logistik->stok_opname = 0;
        $logistik->deskripsi = $request->deskripsi;
        $logistik->kategori_id = $request->kategori_id;
        $logistik->satuan_id = $request->satuan_id;
        $logistik->save();

        return redirect('/master-data/logistik')->with('success', 'Data Berhasil Ditambahkan.');
    }

    public function show(Logistik $logistik)
    {
        return view('logistik.show', compact('logistik'));
    }

    public function edit(Logistik $logistik)
    {
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        return view('logistik.edit', compact('logistik', 'kategori', 'satuan'));
    }

    public function update(Request $request, Logistik $logistik)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'deskripsi' => 'required|min:5',
            'kategori_id' => 'required',
            'satuan_id' => 'required',
        ], [
            'nama.required' => 'Nama logistik harus diisi.',
            'nama.min' => 'Nama logistik harus lebih dari 3 karakter.',
            'deskripsi.required' => 'Deskripsi logistik harus diisi.',
            'deskripsi.min' => 'Deskripsi logistik harus lebih dari 5 karakter.',
            'kategori_id.required' => 'Kategori Logistik harus diisi.',
            'satuan_id.required' => 'Satuan harus diisi.',
        ]);

        $logistik->nama_logistik = $request->nama;
        $logistik->deskripsi = $request->deskripsi;
        $logistik->kategori_id = $request->kategori_id;
        $logistik->satuan_id = $request->satuan_id;
        $logistik->save();

        return redirect('/master-data/logistik')->with('success', 'Data Berhasil Diperbarui.');
    }

    public function log_rusak(Request $request)
    {
        $log_rusak = LogistikRusak::firstOrNew(['logistik_id' => $request->logistik_id]);
        $log_rusak->jumlah = $log_rusak->jumlah + $request->logistik_rusak;
        $log_rusak->save();

        $logistik = Logistik::where('id', $request->logistik_id)->first();
        $logistik->stok = (int) $logistik->stok - (int) $request->logistik_rusak;
        $logistik->stok_opname = (int) $logistik->stok_opname - (int) $request->logistik_rusak;
        $logistik->save();

        return redirect('/master-data/logistik')->with('success', 'Data Berhasil Diperbarui.');
    }

    public function index_broken(Request $request)
    {
        $search = $request->search;
        if (!empty($request->input('search'))) {
            $logistik = LogistikRusak::with('logistik')
            ->whereHas('logistik', function($q) use($search){$q->where('nama_logistik', 'like', "%".$search."%");})
            ->paginate(10);
        } else {
            $logistik = LogistikRusak::paginate(10);
        }
        return view('logistik.index_broken', compact('logistik'));
    }

    public function destroy($id)
    {
        //
    }
}
