<?php

namespace App\Application\Mediator;

use App\Application\Mediator\MediatorInterface;
use Illuminate\Container\Container;

class Mediator implements MediatorInterface
{
    public function __construct(private Container $container) {}

    public function send($entity)
    {
        $handlerClass = $this->getHandlerClass($entity);
        $handler = $this->container->make($handlerClass);
        return $handler->handle($entity);
    }

    private function getHandlerClass($request)
    {
        return str_replace('Requests', 'Handlers', get_class($request)) . 'Handler';
    }
}
