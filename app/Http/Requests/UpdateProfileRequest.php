<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Pastikan ini true
    }

    public function rules(): array
    {
        return [
            'nama_sekolah'   => 'required|string|max:255',
            'kepala_sekolah' => 'required|string|max:255',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Maks 5MB
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'npsn'           => 'nullable|string|max:50',
            'alamat'         => 'nullable|string',
            'kontak'         => 'nullable|string|max:50',
            'visi_misi'      => 'nullable|string',
            'tahun_berdiri'  => 'nullable|numeric',
            'deskripsi'      => 'nullable|string',
        ];
    }
}
