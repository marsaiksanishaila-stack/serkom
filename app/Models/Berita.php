<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang dihubungkan di database
    protected $table = 'beritas';

    // Menentukan nama kolom Primary Key-nya (karena secara default Laravel mencari kolom bernama 'id')
    protected $primaryKey = 'id_berita';

    // Kolom-kolom tabel yang diizinkan untuk diisi secara langsung (mass assignment)
    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'tanggal',
        'foto',
        'status',
        'id_user',
    ];

    // --- RELASI MODEL ---
    
    // Hubungan relasi balik ke model User (Setiap berita dimiliki oleh 1 pembuat/User)
    public function user()
    {
        // Parameter: Model Tujuan, Foreign Key di tabel 'beritas', Primary Key di tabel 'users'
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}