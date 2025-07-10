<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skpi extends Model
{
    protected $table = 'skpi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'mahasiswa_id',
        'kepala_prodi_id',
        'nomor_skpi',
        'nomor_ijazah',
        'link',
        'status'
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'user_id');
    }

    public function kepalaProdi(): BelongsTo
    {
        return $this->belongsTo(KepalaProdi::class, 'kepala_prodi_id', 'user_id');
    }
}
