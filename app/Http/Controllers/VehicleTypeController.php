<?php

namespace App\Http\Controllers;

use App\Application\Features\VehicleTypes\Queries\GetCalculatedPrice\CalculatePriceQuery;
use App\Http\Requests\VehicleTypes\CalculatePriceRequest;
use App\Http\Resources\TransportPriceCollection;

class VehicleTypeController extends Controller
{
    public function calculate(CalculatePriceRequest $request, CalculatePriceQuery $query)
    {
        $query->set($request->validated());
        $data = $this->mediator->send($query);
        return (new TransportPriceCollection($data['data']))
            ->response()
            ->setStatusCode($data['status']);
    }
}
