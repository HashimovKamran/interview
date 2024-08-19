<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use ReflectionClass;
use ReflectionMethod;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAuthAndRoles
{
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
            if ($this->authenticate($request)) return response()->json(['error' => 'Forbidden'], 403);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $next($request);
    }

    private function authenticate($request): bool
    {
        $controllerAction = $request->route()->getActionName();
        [$controller, $method] = explode('@', $controllerAction);
        $reflection = new ReflectionMethod($controller, $method);
        $parameters = $reflection->getParameters();

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            $typeName = $type ? $type->getName() : 'no type';

            if (str_contains($typeName, 'Command') || str_contains($typeName, 'Query')) {
                $reflectionClass = new ReflectionClass($typeName);
                $class = $reflectionClass->newInstance();
                return empty(array_intersect($this->getRolesFromClaims(), $class->getRoles()));
            }
        }
        return true;
    }

    private function getRolesFromClaims(): array
    {
        $token = JWTAuth::getToken();
        $payload = JWTAuth::setToken($token)->getPayload();
        return $payload->get('roles');
    }
}
