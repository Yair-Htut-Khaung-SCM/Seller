<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'images' => 'array',
            'images.*' => 'file|mimes:jpg,jpeg,png|max:2000',

            'manufacturer_id' => 'required|integer|max:62',
            'condition' => 'nullable|string|max:30',
            'car_model' => 'required|string|max:30',
            'year' => 'required|integer|max:3000',
            'price' => 'required|integer|max:10000',
            'build_type_id' => 'required|integer|max:9',
            'trim_name' => 'nullable|string|max:20',
            'engine_power' => 'required|integer|max:8000',
            'steering_position' => 'nullable|string|max:20',
            'transmission' => 'nullable|string|max:20',
            'gear' => 'nullable|string|max:10',
            'fuel_type' => 'nullable|string|max:20',
            'color' => 'nullable|string|max:30',
            'vin' => 'nullable|string|max:19',
            'plate_number' => 'nullable|string|regex:/^([1-9][A-Z][\s\-\/\*\\\\][1-9]\d{3})$/',
            'licence_status' => 'nullable|string|max:20',
            'plate_color' => 'nullable|string|max:30',
            'plate_division_id' => 'nullable|integer|max:20',
            'seat' => 'nullable|integer|max:100',
            'door' => 'nullable|integer|max:10',
            'mileage' => 'nullable|integer|max:1000000',
            'owner_count' => 'nullable|integer|max:6',
            'description' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]{8,15})$/',
            'address' => 'required|string|max:1000',
        ];
    }
}
