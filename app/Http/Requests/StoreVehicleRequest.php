<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'type' => 'required|in:car,motorcycle',
        'brand' => 'nullable|string',
        'model' => 'required|string',
        'year' => 'required|integer|min:2000',
        'price' => 'required|numeric|min:0.01',
        'color' => 'required|string',
        'mileage' => 'required|integer|min:0',
    ];
}
}
