<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id_siswa = $this->route('siswa')->id_siswa ?? $this->route('siswa');

        return [
            'nisn'          => 'required|string|size:10|unique:siswas,nisn,' . $id_siswa . ',id_siswa',
            'nama_siswa'    => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
        ];
    }
}
