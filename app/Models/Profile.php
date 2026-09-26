<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    // WARNAI / TAMBAHKAN BARIS INI:
    protected $primaryKey = 'id_profile';

    public $timestamps = false; // Ubah ke true jika tabel menggunakan created_at & updated_at

    protected $fillable = [
        'nama_sekolah',
        'kepala_sekolah',
        'foto',
        'logo',
        'npsn',
        'alamat',
        'kontak',
        'visi_misi',
        'tahun_berdiri',
        'deskripsi',
    ];
}
