<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikulers';
    protected $primaryKey = 'id_ekskul';

    // Tambahkan jika migration tidak menggunakan $table->timestamps()
    // public $timestamps = false;

    protected $fillable = [
        'nama_ekskul',
        'slug',
        'pembina',
        'jadwal_latihan',
        'deskripsi',
        'gambar',
    ];

    /**
     * Accessor untuk mendapatkan URL lengkap gambar ekstrakurikuler.
     * Jika gambar kosong, akan menampilkan gambar placeholder default.
     */
    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && file_exists(public_path('storage/ekskul/' . $this->gambar))) {
            return asset('storage/ekskul/' . $this->gambar);
        }

        return asset('images/default-ekskul.jpg');
    }
}