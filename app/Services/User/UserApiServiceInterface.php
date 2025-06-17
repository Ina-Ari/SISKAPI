<?php

namespace App\Services\User;

use App\Models\User;

interface UserApiServiceInterface
{
    public function getMahasiswa(array $column): array|null;
    public function getDosen(array $column): array|null;
    public function getPegawai(array $column): array|null;
    public function getUserByRoleName(string $roleName, array $column): array|null;
}
