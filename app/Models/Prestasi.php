<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasis';
    protected $primaryKey = 'id_prestasi';

    public $timestamps = false;

    protected $fillable = [
        'nama_prestasi',
        'slug',
        'deskripsi',
        'foto',
        'tahun_ajaran',
    ];

    /**
     * Accessor untuk URL foto prestasi (default jika kosong)
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path('storage/prestasi/' . $this->foto))) {
            return asset('storage/prestasi/' . $this->foto);
        }

        return asset('images/default-prestasi.jpg');
    }
}