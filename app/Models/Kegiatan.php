<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nim',
        'id_poin',
        'nama_kegiatan',
        'kegiatan_name',
        'tanggal_kegiatan',
        'sertifikat',
        'status_sertif',
        'akurasi',
        'status',
    ];

    // Relasi dengan model Posisi

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'user_id');
    }

    public function poin()
    {
        return $this->belongsTo(Poin::class, 'id_poin');
    }

}
