<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::orderBy('id_siswa', 'desc')->paginate(10);
        return view('admin.siswa', compact('siswas'));
    }

    public function store(StoreSiswaRequest $request)
    {
        Siswa::create($request->validated());

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $siswa->update($request->validated());

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
