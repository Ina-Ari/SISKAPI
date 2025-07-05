<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nim',
        'telepon',
        'angkatan',
        'kode_prodi',
        'is_active',
    ];

    protected $attributes = [
        'telepon' => null,
        'is_active' => 0
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'kode_prodi', 'kode_prodi');
    }

    public function kegiatan(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'nim', 'user_id');
    }
}
