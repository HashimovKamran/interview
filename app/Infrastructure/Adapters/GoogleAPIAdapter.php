<?php

namespace App\Infrastructure\Adapters;

use App\Application\Services\Adapters\APIAdapterInterface;
use Illuminate\Support\Facades\Http;

class GoogleAPIAdapter implements APIAdapterInterface
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google.api_key');
    }

    public function calculateTotalDistance(array $addresses): float
    {
        $origin = "{$addresses[0]['name']},{$addresses[0]['country']}";
        $destination = "{$addresses[count($addresses) - 1]['name']},{$addresses[count($addresses) - 1]['country']}";
        $waypoints = array_map(function ($address) {
            return "{$address['name']},{$address['country']}";
        }, array_slice($addresses, 1, -1));

        $url = "https://maps.googleapis.com/maps/api/directions/json?origin={$origin}&destination={$destination}&waypoints=" . implode('|', $waypoints) . "&key={$this->apiKey}";

        $response = Http::get($url);
        $data = $response->json();

        $totalDistance = 0;
        if (isset($data['routes'][0]['legs']))
            foreach ($data['routes'][0]['legs'] as $leg)
                $totalDistance += $leg['distance']['value'];

        return $totalDistance / 1000;
    }
}
