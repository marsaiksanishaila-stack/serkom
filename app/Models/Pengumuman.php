<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumen';
    protected $primaryKey = 'id_pengumuman';

    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'status',
        'id_user',
    ];
}
