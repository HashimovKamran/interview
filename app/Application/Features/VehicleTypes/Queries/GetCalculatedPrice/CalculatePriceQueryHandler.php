<?php

namespace App\Application\Features\VehicleTypes\Queries\GetCalculatedPrice;

use App\Application\Features\VehicleTypes\Queries\GetCalculatedPrice\CalculatePriceQuery;
use App\Application\Services\Adapters\APIAdapterInterface;
use App\Application\Services\Repositories\{VehicleTypeRepositoryInterface, CityRepositoryInterface};

class CalculatePriceQueryHandler
{
    public function __construct(private APIAdapterInterface $apiAdapter, private VehicleTypeRepositoryInterface $vehicleTypeRepository, private CityRepositoryInterface $cityRepository) {}

    public function handle(CalculatePriceQuery $query)
    {
        $cities = $this->cityRepository->getWhere($query->get());
        $distance = $this->apiAdapter->calculateTotalDistance($cities);
        $vehicleTypes = $this->vehicleTypeRepository->all();

        $prices = [];
        foreach ($vehicleTypes as $vehicle) {
            $price = $distance * $vehicle->cost_km;
            if ($price < $vehicle->minimum) $price = $vehicle->minimum;
            $prices[] = [
                'vehicle_type' => $vehicle['number'],
                'price' => $price,
            ];
        }
        return [
            'data' => $prices,
            'status' => 200
        ];
    }
}
