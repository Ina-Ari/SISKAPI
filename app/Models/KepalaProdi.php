<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KepalaProdi extends Model
{
    protected $table = 'kepala_prodi';
    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'nip',
        'nidn',
        'angkatan',
        'telepon',
        'is_active',
        'kode_prodi',
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

    public function skpis(): HasMany
    {
        return $this->hasMany(Skpi::class, 'kepala_prodi_id', 'user_id');
    }
}
