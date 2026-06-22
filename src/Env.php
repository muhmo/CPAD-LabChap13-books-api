<?php
namespace App;

final class Env
{
    public static function get(string $key, ?string $default = null): ?string
    {
        if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
            return (string) $_ENV[$key];
        }
        $value = getenv($key);
        if ($value !== false && $value !== '') {
            return (string) $value;
        }
        return $default;
    }
}
