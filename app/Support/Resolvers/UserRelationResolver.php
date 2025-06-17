<?php

namespace App\Support\Resolvers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserRelationResolver
{
    protected static function resolveRelationName(User $user): ?string
    {
        return match ($user->role->nama) {
            Role::MAHASISWA => 'mahasiswa',
            Role::KEPALA_PRODI => 'kepalaProdi',
            Role::BAAK => 'baak',
            Role::UPAPKK => 'upapkk',
            default => null,
        };
    }

    public static function getRelationObject(User $user): HasOne|null
    {
        $relation = self::resolveRelationName($user);
        return $relation ? $user->$relation() : null;
    }

    public static function getUserWithRelation(User $user): User|null
    {
        $relation = self::resolveRelationName($user);
        return $relation ? $user->with($relation)->first() : null;
    }

    public static function getRelationData(User $user)
    {
        $relation = self::resolveRelationName($user);
        return $relation ? $user->$relation : null;
    }
}
