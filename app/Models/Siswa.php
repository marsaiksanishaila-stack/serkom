<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';
    protected $primaryKey = 'id_siswa';
    public $timestamps = false; // Set true jika migration kamu menyertakan $table->timestamps()

    protected $fillable = [
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'tahun_masuk',
    ];
}
