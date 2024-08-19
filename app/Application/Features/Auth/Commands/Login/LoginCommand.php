<?php

namespace App\Application\Features\Auth\Commands\Login;

class LoginCommand
{
    private array $data;

    public function get(): array
    {
        return $this->data;
    }

    public function set($validatedData): void
    {
        $this->data = $validatedData;
    }
}
