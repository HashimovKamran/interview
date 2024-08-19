<?php

namespace App\Http\Controllers;

use App\Application\Features\Auth\Commands\Login\LoginCommand;
use App\Application\Features\Auth\Commands\Register\RegisterCommand;
use App\Http\Requests\Auth\{LoginRequest, RegisterRequest};
use App\Http\Resources\AuthResource;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterCommand $command)
    {
        $command->set($request->validated());
        $data = $this->mediator->send($command);
        return (new AuthResource($data['data']))
            ->response()
            ->setStatusCode($data['status']);
    }

    public function login(LoginRequest $request, LoginCommand $command)
    {
        $command->set($request->validated());
        $data = $this->mediator->send($command);
        return (new AuthResource($data['data']))
            ->response()
            ->setStatusCode($data['status']);
    }
}
