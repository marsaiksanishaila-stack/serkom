<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumen';
    protected $primaryKey = 'id_pengumuman';

    // Tambahkan jika migration kamu tidak memakai $table->timestamps()
    // public $timestamps = false;

    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'status',
        'id_user',
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}