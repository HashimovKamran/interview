<?php

namespace App\Http\Requests\VehicleTypes;

use Illuminate\Foundation\Http\FormRequest;

class CalculatePriceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'addresses' => 'required|array|min:2',
            'addresses.*.country' => 'required|string|size:2',
            'addresses.*.zip' => 'required|string',
            'addresses.*.city' => 'required|string',
        ];
    }
}
