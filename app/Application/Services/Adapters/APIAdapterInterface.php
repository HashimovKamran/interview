<?php

namespace App\Application\Services\Adapters;

interface APIAdapterInterface
{
    public function calculateTotalDistance(array $addresses): float;
}
