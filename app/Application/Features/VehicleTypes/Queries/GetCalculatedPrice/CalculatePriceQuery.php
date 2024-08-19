<?php

namespace App\Application\Features\VehicleTypes\Queries\GetCalculatedPrice;

class CalculatePriceQuery
{
    private static array $roles = ['Admin'];
    private array $data;

    public function get(): array
    {
        return $this->data;
    }

    public function set($validatedData): void
    {
        $this->data = array_map(function ($address) {
            return [
                "country" => $address['country'],
                "zipCode" => $address['zip'],
                "name" => $address['city']
            ];
        }, $validatedData['addresses']);
    }

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
