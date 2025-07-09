<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_jurusan';
    protected $table = 'jurusan';
    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan',
        'jurusan_name',
    ];


    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'kode_jurusan');
    }
}
