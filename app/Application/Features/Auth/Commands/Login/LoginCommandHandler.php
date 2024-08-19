<?php

namespace App\Application\Features\Auth\Commands\Login;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginCommandHandler
{
    public function handle(LoginCommand $command)
    {
        try {
            if (!$token = JWTAuth::attempt($command->get())) {
                return [
                    'data' => [
                        'error' => 'Invalid credentials',
                    ],
                    'status' => 401
                ];
            }
        } catch (JWTException $e) {
            return [
                'data' => [
                    'error' => 'Invalid credentials',
                ],
                'status' => 500
            ];
        }

        return [
            'data' => [
                'message' => 'User logged in successfully',
                'token' => $token,
            ],
            'status' => 200
        ];
    }
}
