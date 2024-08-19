<?php

namespace App\Application\Services\Repositories;

use App\Application\Services\Repositories\RepositoryInterface;

interface CityRepositoryInterface extends RepositoryInterface
{
    public function getWhere(array $cities): array;
}
