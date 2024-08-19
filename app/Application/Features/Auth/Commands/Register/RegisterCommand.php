<?php

namespace App\Application\Features\Auth\Commands\Register;

class RegisterCommand
{
    private static array $roles = ['Admin'];
    private array $data;

    public function get(): array
    {
        return $this->data;
    }

    public function set($validatedData): void
    {
        $this->data = $validatedData;
    }

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
