<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'type' => 'sometimes|in:car,motorcycle',
        'brand' => 'sometimes|string',
        'model' => 'sometimes|string',
        'year' => 'sometimes|integer|min:2000',
        'price' => 'sometimes|numeric|min:0.01',
        'color' => 'sometimes|string',
        'mileage' => 'sometimes|integer|min:0',
    ];
}
}
