<?php

namespace App\Services\User;

use App\Models\User;

interface UserServiceInterface
{
    public function create(array $data): User;
    public function getCurrent(): User;
    public function findUserFromDatabase(array $column, bool $withTrashed = false): User|null;
    public function updateCurrent(array $data): User;
    public function updateUserEmail(User $user, string $email): User;
    public function delete(string $userId): bool;
}
