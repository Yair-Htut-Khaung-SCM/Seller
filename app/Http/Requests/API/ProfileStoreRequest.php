<?php

namespace App\Http\Requests\API;

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
            'image' => 'nullable|file|mimes:jpg,jpeg,png',
            'name' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]{8,15})$/',
            'address' => 'nullable|string|max:1000',
            'description' => 'nullable|string|max:1000',
        ];
    }
    public function messages()
    {
        return [
            'file' => ':attribute file type must be jpg,jpeg,png',
            'required' => ':attribute is required',
            'email' => 'Input Format must be Email',
            'max' => ':attribute should not be more than ' . ':max' . ' words',
            'regex' => 'The :attribute format is invalid.'
        ];
    }
}
