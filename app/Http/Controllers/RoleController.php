<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->input('search'))) {
            $role = Role::where('nama_role','like',"%".$request->search."%")->paginate(5);
        } else {
            $role = Role::paginate(5);
        }
        return view('role.index', compact('role'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required',
        ], [
            'nama_role.required' => 'Role harus diisi.',
        ]);

        $role = new Role;
        $role->nama_role = $request->nama_role;
        $role->save();

        return redirect('/data-pegawai/role')->with('success', 'Data Berhasil Ditambahkan.');
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'nama_role' => 'required',
        ], [
            'nama_role.required' => 'Role harus diisi.',
        ]);

        $role->nama_role = $request->nama_role;
        $role->save();

        return redirect('/data-pegawai/role')->with('success', 'Data Berhasil Diperbarui.');
    }

    public function destroy(Role $role)
    {
        //
    }
}
