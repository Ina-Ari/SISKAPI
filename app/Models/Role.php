<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $table = 'roles';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public const MAHASISWA = 'Mahasiswa';
    public const KEPALA_PRODI = 'Kepala Prodi';
    public const BAAK = 'BAAK';
    public const UPAPKK = 'UPAPKK';

    protected $fillable = [
        'nama'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public static function getId(string $name): string
    {
        return self::where('nama', $name)->first()->id;
    }
}
