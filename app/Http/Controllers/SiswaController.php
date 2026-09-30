<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;

class SiswaController extends Controller
{
    public function index()
    {
        $query = Siswa::query();

        if (request('search')) {
            $search = request('search');

            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'like', '%' . $search . '%')
                  ->orWhere('nisn', 'like', '%' . $search . '%')
                  ->orWhere('jenis_kelamin', 'like', '%' . $search . '%')
                  ->orWhere('tahun_masuk', 'like', '%' . $search . '%');
            });
        }

        $siswas = $query
            ->orderBy('id_siswa', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.siswa', compact('siswas'));
    }

    public function store(StoreSiswaRequest $request)
    {
        Siswa::create($request->validated());

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $siswa->update($request->validated());

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus!');
    }
}

