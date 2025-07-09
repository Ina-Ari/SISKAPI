<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_prodi';
    protected $table = 'prodi';
    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'prodi_name',
        'kode_jurusan'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan', 'kode_jurusan');
    }

    public function formSkpi()
    {
        return $this->hasOne(FormKaprodi::class, 'kode_prodi', 'kode_prodi');
    }
}
