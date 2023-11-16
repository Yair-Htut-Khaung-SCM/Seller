<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:admin_users'],
            'password' => ['required', 'confirmed'],
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'email' => 'Input Format must be Email',
            'max' => ':attribute should not be more than ' . ':max' . ' words',
            'unique' => 'This :attribute is already registered!',
            'confirmed' => ':attribute does not match',
        ];
    }
}
