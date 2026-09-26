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
        'deskripsi',
        'foto',
        'tahun_ajaran',
    ];
}
