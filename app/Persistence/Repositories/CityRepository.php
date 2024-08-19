<?php

namespace App\Persistence\Repositories;

use App\Application\Services\Repositories\CityRepositoryInterface;
use App\Models\City;

class CityRepository extends Repository implements CityRepositoryInterface
{
    public function __construct(City $city)
    {
        parent::__construct($city);
    }

    public function getWhere(array $cities): array
    {
        $availableCities = [];
        foreach ($cities as $city)
            if ($this->model->where($city)->exists())
                $availableCities[] = $city;
        return $availableCities;
    }
}
