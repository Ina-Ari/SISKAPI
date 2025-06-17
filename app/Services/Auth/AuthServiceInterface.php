<?php

namespace App\Services\Auth;

interface AuthServiceInterface
{
    public function register(string $credential, string $email, string $type): bool;
    public function accountSetup(string $token, string $password): bool;
    public function login(array $credentials, bool $remember = false): bool;
    public function logout(): void;
    public function forgotPassword(string $email): string;
    public function resetPassword(array $data): string;
}
