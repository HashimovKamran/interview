<?php

namespace App\Application\Features\Auth\Commands\Register;

use App\Application\Features\Auth\Commands\Register\RegisterCommand;
use App\Models\User;

class RegisterCommandHandler
{
    public function handle(RegisterCommand $command)
    {
        $data = $command->get();
        $exists = User::where('email', $data['email'])->exists();
        if ($exists) {
            return [
                'data' => [
                    'message' => 'Email must be unique'
                ],
                'status' => 422
            ];
        }
        return [
            'data' => User::create($data),
            'status' => 201
        ];
    }
}
