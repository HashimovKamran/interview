<?php

namespace App\Persistence\Repositories;

use App\Application\Services\Repositories\VehicleTypeRepositoryInterface;
use App\Models\VehicleType;

class VehicleTypeRepository extends Repository implements VehicleTypeRepositoryInterface
{
    public function __construct(VehicleType $vehicleType)
    {
        parent::__construct($vehicleType);
    }
}
