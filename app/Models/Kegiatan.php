<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'Nim',
        'Nama_kegiatan',
        'tanggal_kegiatan',
        'id_posisi',
        'idtingkat_kegiatan',
        'idjenis_kegiatan',
        'sertifikat',
        'id_poin',
        'verifsertif',
        'verif',
    ];

    public $timestamps = false; // Menonaktifkan timestamps

    // Relasi dengan model Posisi
    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'id_posisi');
    }

    // Relasi dengan model TingkatKegiatan
    public function tingkatKegiatan()
    {
        return $this->belongsTo(TingkatKegiatan::class, 'idtingkat_kegiatan');
    }

    // Relasi dengan model JenisKegiatan
    public function jenisKegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'idjenis_kegiatan');
    }
}
