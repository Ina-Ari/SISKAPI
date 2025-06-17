<?php

namespace App\Support\Helpers;

class TokenHelper
{
    /**
     * Get default token length from config.
     *
     * @return int
     */
    public static function getDefaultTokenLength(): int
    {
        return config('auth.registration_token.length', 32);
    }

    /**
     * Generate a random uppercase hexadecimal token.
     *
     * @param int|null $length Length of the token to generate. If null, will use config value.
     * @return string
     */
    public static function generateToken(?int $length = null): string
    {
        $length = $length ?? self::getDefaultTokenLength();

        if ($length % 2 !== 0) {
            throw new \InvalidArgumentException('Token length must be an even number.');
        }

        return strtoupper(bin2hex(random_bytes($length / 2)));
    }

    /**
     * Validate if a token is a valid uppercase hexadecimal string with even length.
     *
     * @param string $token
     * @return bool
     */
    public static function validateToken(string $token): bool
    {
        return ctype_xdigit($token) && strlen($token) % 2 === 0;
    }
}
