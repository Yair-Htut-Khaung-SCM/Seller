<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileStoreRequest extends FormRequest
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
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2000',

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]{8,15})$/',
            'address' => 'nullable|string|max:1000',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'max' => ':attribute should not be more than ' . ':max' . ' KBs.',
        ];
    }
}