<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{

    public function index(Request $request)
    {
        if (!empty($request->input('search'))) {
            $supplier = Supplier::where('nama_supplier','like',"%".$request->search."%")->orderBy('nama_supplier', 'asc')->paginate(10);
        } else {
            $supplier = Supplier::orderBy('nama_supplier', 'asc')->paginate(10);
        }
        return view('supplier.index', compact('supplier'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'alamat' => 'required|min:5',
        ], [
            'nama.required' => 'Nama supplier harus diisi.',
            'nama.min' => 'Nama harus lebih dari 3 karakter.',
            'alamat.required' => 'Alamat supplier harus diisi.',
            'alamat.min' => 'Alamat harus lebih dari 5 karakter.',
        ]);

        $supplier = new Supplier;
        $supplier->nama_supplier = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->save();

        return redirect('/master-data/supplier')->with('success', 'Data Berhasil Ditambahkan.');
    }

    public function show(Supplier $supplier)
    {
        //
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'alamat' => 'required|min:5',
        ], [
            'nama.required' => 'Nama supplier harus diisi.',
            'nama.min' => 'Nama harus lebih dari 3 karakter.',
            'alamat.required' => 'Alamat supplier harus diisi.',
            'alamat.min' => 'Alamat harus lebih dari 5 karakter.',
        ]);

        $supplier->nama_supplier = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->save();

        return redirect('/master-data/supplier')->with('success', 'Data Berhasil Diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        //
    }
}
