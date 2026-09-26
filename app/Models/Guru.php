<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';
    protected $primaryKey = 'id_guru';
    public $timestamps = false; // Set true jika tabel Anda memiliki created_at & updated_at

    protected $fillable = [
        'nama_guru',
        'nip',
        'mapel',
        'foto',
    ];
}
